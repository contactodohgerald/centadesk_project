<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course_model;
use App\Traits\Generics;
use App\Traits\UsersArray;
use App\Models\User;
use App\course_category_model;
use App\Model\BlogModel;

class SearchResultController extends Controller
{
    //
    use Generics, UsersArray;

    function __construct(course_model $course_model,  course_category_model $course_category_model, BlogModel $blogModel){
        $this->middleware('auth',  ['except' => ['searchThroughRecords']]);
        $this->course_model = $course_model;
        $this->course_category_model = $course_category_model;
        $this->blogModel = $blogModel;
    }

    public function searchThroughRecords(Request $request){

        $search = $request->seach_query;

        $query = course_model::query();

        $columns = ['name'];
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        }
        $course = $query->simplePaginate(20);
        foreach ($course as $each_course){
            $each_course->user;
            $each_course->price;

            $each_course->courseEnrollment;

            $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

            $each_course->review;
            $each_course->count_reviews = $this->calculateRatings($each_course->review);

            $each_course->download_url = explode('++', $each_course->course_urls);
        }

        $category_query = course_category_model::query();
        foreach($columns as $column){
            $category_query->orWhere($column, 'LIKE', '%' . $search . '%');
        }
        $course_category_model = $category_query->get();

        $blog_query = BlogModel::query();
        $blog_title = ['blog_title'];
        foreach($blog_title as $blog_titles){
            $blog_query->orWhere($blog_titles, 'LIKE', '%' . $search . '%');
        }
        $blogs = $blog_query->simplePaginate(20);

        $user_query = User::query();
        $users = ['name', 'last_name', 'email'];
        foreach($users as $each_users){
            $user_query->orWhere($each_users, 'LIKE', '%' . $search . '%')->where('user_type', 'teacher');
        }
        $instructors = $user_query->get();

        foreach($instructors as $each_instructors){
            $each_instructors->courses;

            $each_instructors->subscribers;
        }

        //return $instructors;

        $view = [
            'search'=>$search,
            'course'=>$course,
            'course_category_model'=>$course_category_model,
            'blogs'=>$blogs,
            'instructors'=>$instructors,
        ];

        return view('front_end.search_result', $view);
    }

    public function searchThroughRecordsForBackview(Request $request){
        $search = $request->search_result;

        $query = course_model::query();

        $columns = ['name'];
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        }
        $course = $query->simplePaginate(20);
        foreach ($course as $each_course){
            $each_course->user;
            $each_course->price;

            $each_course->courseEnrollment;

            $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

            $each_course->review;
            $each_course->count_reviews = $this->calculateRatings($each_course->review);

            $each_course->download_url = explode('++', $each_course->course_urls);
        }

        $category_query = course_category_model::query();
        foreach($columns as $column){
            $category_query->orWhere($column, 'LIKE', '%' . $search . '%');
        }
        $course_category_model = $category_query->get();

        $user_query = User::query();
        $users = ['name', 'last_name', 'email'];
        foreach($users as $each_users){
            $user_query->orWhere($each_users, 'LIKE', '%' . $search . '%')->where('user_type', 'teacher');
        }
        $instructors = $user_query->get();

        foreach($instructors as $each_instructors){
            $each_instructors->courses;

            $each_instructors->subscribers;
        }

        $view = [
            'search'=>$search,
            'course'=>$course,
            'course_category_model'=>$course_category_model,
            'instructors'=>$instructors,
        ];

        return view('dashboard.search_result', $view);
    }
}
