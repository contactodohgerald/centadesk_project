<?php

namespace App\Http\Controllers\Course;

use App\course_category_model;
use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\BlogModel;
use App\Model\Like;
use App\Model\Review;
use App\Traits\Generics;
use App\Traits\UsersArray;
use App\Models\User;
use Illuminate\Http\Request;

class CoursesHandlerController extends Controller
{
    //
    use Generics, UsersArray;
    function __construct(
        course_category_model $course_category_model, course_model $course_model, Review $review, Like $like, User $user, BlogModel $blogModel
    ){
        $this->course_category_model = $course_category_model;
        $this->course_model = $course_model;
        $this->review = $review;
        $this->like = $like;
        $this->user = $user;
        $this->blogModel = $blogModel;
    }

    public function homePage(){

        $course_category_model = $this->course_category_model->getAllCategories();
        foreach($course_category_model as $each_course_category_model){

            $each_course_category_model->courses;

            $e_course = $each_course_category_model->courses;

            foreach($e_course as $each_course){
                $each_course->user;
                $each_course->price;

                $each_course->courseEnrollment;

                $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

                $each_course->review;
                $each_course->count_reviews = $this->calculateRatings($each_course->review);

                $each_course->download_url = explode('++', $each_course->course_urls);
            }
        }
       
        $condition = [
            ['status', 'confirmed']
        ];
        $course = $this->course_model->getAllCourseWithLimit($condition);
        $new_course = $this->course_model->getAllCourseWithLimit($condition);

        $query = [
            ['status', 'active'],
            ['user_type', 'teacher'],
            ['yearly_subscription_status', 'yes'],
        ];
        $instructors = $this->user->getAllUsers($query);

        $blogs = $this->blogModel->getAllBlogPost([
            ['status', 'confirmed'],
        ]);
        foreach ($blogs as $each_blog_post){
            $each_blog_post->blogComments;

            $each_blog_post->users;
        }

        $review = $this->review->getAllReviews([
            ['deleted_at', null]
        ]);

        foreach($review as $each_user_review){
            $each_user_review->users;
        }
        //return $course_category_model;

        $view = [
            'course_category_model'=>$course_category_model,
            'course'=>$course,
            'new_course'=>$new_course,
            'instructors'=>$instructors,
            'instructors_count'=>$this->user->getAllUsers([
                ['status', 'active'],
                ['user_type', 'teacher'],
            ]),
            'student_count'=>$this->user->getAllUsers([
                ['status', 'active'],
                ['user_type', 'student'],
            ]),
            'course_count'=>$this->course_model->getAllCourse([
                ['deleted_at', null],
            ]),
            'blogs'=>$blogs,
            'review'=>$review,
        ];
        return view('front_end.index', $view);
    }

    public function getAllInstructorsList(){
        $query = [
            ['status', 'active'],
            ['user_type', 'teacher'],
            ['yearly_subscription_status', 'yes'],
        ];
        $instructors = $this->user->getAllUsers($query);

        return view('front-end.instructors', ['instructors'=>$instructors]);
    }

    public function getInstructorProfile($unique_id = null){

        if ($unique_id != null){
            $query = [
                ['unique_id', $unique_id],
            ];
            $instructors = $this->user->getSingleUser($query);

            $instructors->courses;
            foreach ($instructors->courses as $kk => $each_course){
                $each_course->price;

                $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

                $each_course->review;
                $each_course->count_reviews = $this->calculateRatings($each_course->review);
            }

            $instructors->subscribers;
            foreach ($instructors->subscribers as $s => $each_subscribers){
                $each_subscribers->users;
            }

            return view('front-end.instructor_profile', ['instructors'=>$instructors]);
        }
    }

    public function getAllCategories(){

        $course_category_model = $this->course_category_model->getAllCategories();

        foreach ($course_category_model as $each_category){
            $each_category->courses;
        }

        $view = [
            'course_category_model'=>$course_category_model,
        ];

        return view('front_end.categories', $view);
    }

    public function getAllCourses(){
        $condition = [
            ['status', 'confirmed'],
        ];
        $course = $this->course_model->getCourseByPaginate(20, $condition);
        foreach ($course as $each_course){
            $each_course->user;
            $each_course->price;

            $each_course->courseEnrollment;

            $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

            $each_course->review;
            $each_course->count_reviews = $this->calculateRatings($each_course->review);

            $each_course->download_url = explode('++', $each_course->course_urls);
        }

        $courses_list = $this->course_model->getAllCourseWithLimit($condition);
        foreach ($courses_list as $each_course_list){
            $each_course_list->user;
            $each_course_list->price;

            $each_course_list->courseEnrollment;

            $each_course_list->course_price = $this->getAmountForNotLoggedInUser($each_course_list->price->amount);

            $each_course_list->review;
            $each_course_list->count_reviews = $this->calculateRatings($each_course_list->review);

            $each_course_list->download_url = explode('++', $each_course_list->course_urls);
        }

        $view = [
            'course'=>$course,
            'courses_list'=>$courses_list,
        ];

        return view('front_end.courses', $view);
    }

    public function courseListPage($unique_id = null){

        if ($unique_id != null){

            $condition = [
                ['unique_id', $unique_id]
            ];
            $course_category = $this->course_category_model->getSingleCategories($condition);

            $query = [
                ['category_id', $unique_id],
                ['status', 'confirmed'],
            ];

            $courses_list = $this->course_model->getAllCourseWithLimit($query);
            $course_category->courses_list = $courses_list;
            foreach ($course_category->courses_list as $each_course_list){
                $each_course_list->user;
                $each_course_list->price;

                $each_course_list->courseEnrollment;

                $each_course_list->course_price = $this->getAmountForNotLoggedInUser($each_course_list->price->amount);

                $each_course_list->review;
                $each_course_list->count_reviews = $this->calculateRatings($each_course_list->review);

                $each_course_list->download_url = explode('++', $each_course_list->course_urls);
            }

            $course = $this->course_model->getCourseByPaginate(12, $query);
            $course_category->courses = $course;

            foreach ($course_category->courses as $each_course){
                $each_course->user;
                $each_course->price;

                $each_course->courseEnrollment;

                $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

                $each_course->review;
                $each_course->count_reviews = $this->calculateRatings($each_course->review);

                $each_course->download_url = explode('++', $each_course->course_urls);
            }

           // return $course_category->courses;

            $course_category_model = $this->course_category_model->getAllCategories();

            foreach ($course_category_model as $each_category){
                $each_category->courses;
            }

            $view = [
                'course_category'=>$course_category,
                'course_category_model'=>$course_category_model,
            ];
            return view('front_end.course_list', $view);
        }

    }

    public function teacherCourseListPage($unique_id = null){ 

        if ($unique_id != null){ 

            $condition = [
                ['unique_id', $unique_id]
            ];
            $user = $this->user->getSingleUser($condition);

            $query = [
                ['user_id', $unique_id],
                ['status', 'confirmed'],
            ];

            $course = $this->course_model->getCourseByPaginate(20, $query);

            foreach ($course as $each_course){
                $each_course->user;
                $each_course->price;

                $each_course->courseEnrollment;

                $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

                $each_course->review;
                $each_course->count_reviews = $this->calculateRatings($each_course->review);

                $each_course->download_url = explode('++', $each_course->course_urls);
            }

            $view = [
                'user'=>$user,
                'course'=>$course,
            ];
            return view('front_end.teacher_course_list', $view);
        }

    }

    public function getCourseDetails($unique_id = null){

        if ($unique_id != null){
            $condition = [
                ['unique_id', $unique_id],
            ];
            $course = $this->course_model->getSingleCourse($condition);

            $course->user;

            $course->user->courses;

            $course->user->subscribers;
            
            $course->price;

            $course->category;

            $course->course_price = $this->getAmountForNotLoggedInUser($course->price->amount);

            $course->review;
            $course->count_reviews = $this->calculateRatings($course->review);
            foreach ($course->review as $each_review){
                $each_review->users;
            }

            $course->download_url = explode('++', $course->course_urls);

            $course->courseEnrollment;

            //function that returns an array of users that likes this course and also the course like count
            $likes_array = $this->returnUserArrayForDislikes($course->unique_id);
            $course->likes = $likes_array['like_count'];
            $course->likes_user_array = $likes_array['like_user_array'];

            $query = [
                ['user_id', $course->user_id],
                ['status', 'confirmed'],
            ];
            $related_course = $this->course_model->getCourseByPaginate(12, $query);
            foreach ($related_course as $each_related_course){
                $each_related_course->user;
                $each_related_course->price;

                $each_related_course->courseEnrollment;

                $each_related_course->course_price = $this->getAmountForNotLoggedInUser($each_related_course->price->amount);

                $each_related_course->review;
                $each_related_course->count_reviews = $this->calculateRatings($each_related_course->review);

                $each_related_course->download_url = explode('++', $each_related_course->course_urls);
            }

            $view = [
                'course'=>$course,
                'related_course'=>$related_course,
            ];

            return view('front_end.course-details', $view);
        }
    }
}
