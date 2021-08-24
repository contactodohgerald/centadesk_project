<?php

namespace App\Http\Controllers;

use App\course_model;
use App\Http\Controllers\Course\courseController;
use App\Http\Controllers\Ticket\TicketController;
use App\Model\Review;
use App\Model\courseEnrollment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\live_stream_model;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        live_stream_model $live_stream, course_model $course_model, Review $review, User $user, courseEnrollment $courseEnrollment, courseController $courseController, TicketController $ticketController
    ){
        $this->middleware('auth',  ['except' => ['clear_cache']]);
        $this->live_stream = $live_stream;
        $this->course_model = $course_model;
        $this->review = $review;
        $this->user = $user;
        $this->courseEnrollment = $courseEnrollment;
        $this->courseController = $courseController;
        $this->ticketController = $ticketController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $user = Auth::user();
               
        $course = $this->course_model->getAllCourse([
            ['status', 'confirmed']
        ]);
      
        // return 'null';
        $live_streams = $this->live_stream->get_all([
            ['deleted_at', null],
            ['status', 'live'],
        ]);

        if(count($course) > 0){
            foreach ($course as $each_course){

                $each_course->user;
    
                $each_course->price;
    
                $each_course->category;
    
                $reviews = $this->review->getAllReviews([
                    ['course_unique_id', $each_course->unique_id]
                ]);
                $each_course->reviews = $reviews;
                $each_course->count_review = $this->calculateRatings($reviews);
    
            }
        }
      //  return $course;
        $instructors = $this->user->getAllUsers([
            ['status', 'active'],
            ['user_type', 'teacher'],
        ]);

        foreach ($instructors as $each_instructors){

            $course_model = $this->course_model->getAllCourse([
                ['user_id', $each_instructors->unique_id],
            ]);
            $each_instructors->count_course = $course_model->count();

            $enrolled = $this->courseEnrollment->getAllEnrolls([
                ['course_creator', '=', $each_instructors->unique_id]
            ]);
            $each_instructors->enrolled_users = $enrolled->count();
        }

        $user->courses;

        $user->subscribers;

        $user->enroll_students;

        //return $user;
        $confirmed_courses = $this->courseController->count_confirmed_courses();
        $total_students = $this->user->count_students();
        $total_teachers = $this->user->count_teachers();
        $pending_tickets = $this->ticketController->count_pending_ticket();
        $overview = [
            $confirmed_courses, $total_students, $total_teachers,
            $pending_tickets
        ];

        $view = [
            'live_streams' => $live_streams,
            'user' => $user,
            'course' => $course,
            'instructors' => $instructors,
            'app_overview' => $overview,
        ];

        return view('dashboard.index',$view);
    }
    /**
     * Clear application cache
     *
     * @return void
     */
    public function clear_cache()
    {
        $exitCode = Artisan::call('config:cache');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('route:cache');
    }

    public function showToken()
    {
        return csrf_token();
    }
}
