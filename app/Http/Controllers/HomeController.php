<?php

namespace App\Http\Controllers;

use App\course_model;
use App\Model\Review;
use App\Model\courseEnrollment;
use App\Models\User;
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
        live_stream_model $live_stream, course_model $course_model, Review $review, User $user, courseEnrollment $courseEnrollment
    ){
        $this->middleware('auth',  ['except' => ['clear_cache']]);
        $this->live_stream = $live_stream;
        $this->course_model = $course_model;
        $this->review = $review;
        $this->user = $user;
        $this->courseEnrollment = $courseEnrollment;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $condition = [
            ['deleted_at', null],
            ['status', 'live'],
        ];
        $live_streams = $this->live_stream->get_all($condition);

        $condition = [
            ['status', 'confirmed']
        ];
        $course = $this->course_model->getAllCourse($condition);

        foreach ($course as $each_course){

            $each_course->user;

            $each_course->price;

            $each_course->category;

            $conditions = [
                ['course_unique_id', $each_course->unique_id ]
            ];
            $reviews = $this->review->getAllReviews($conditions);
            $each_course->reviews = $reviews;
            $each_course->count_review = $this->calculateRatings($reviews);

        }

        $condition = [
            ['status', 'active'],
            ['user_type', 'teacher'],
        ];
        $instructors = $this->user->getAllUsers($condition);

        foreach ($instructors as $each_instructors){

            $conditions = [
                ['user_id', $each_instructors->unique_id],
            ];
            $course_model = $this->course_model->getAllCourse($conditions);
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

        $view = [
            'live_streams' => $live_streams,
            'user' => $user,
            'course' => $course,
            'instructors' => $instructors,
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
