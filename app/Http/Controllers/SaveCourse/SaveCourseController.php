<?php

namespace App\Http\Controllers\SaveCourse;

use App\Http\Controllers\Controller;
use App\Model\Review;
use App\Model\SavedCourses;
use App\Traits\Generics;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaveCourseController extends Controller
{
    //
    use Generics;
    function __construct(SavedCourses $savedCourses, Review $review)
    {
        $this->middleware('auth',  ['except' => ['saveCourse', 'removeSavedCourse']]);
        $this->savedCourses = $savedCourses;
        $this->review = $review;
    }

    function getAllSavedCourse(){

        $user = Auth()->user();

        $condition = [
            ['user_unique_id', $user->unique_id],
        ];

        $saved_courses = $this->savedCourses->getAllSaveCourse($condition);

        foreach($saved_courses as $each_saved_courses){

            $each_saved_courses->courses;

            $each_saved_courses->courses->price;

            $each_saved_courses->users;

            $conditions = [
                ['course_unique_id', $each_saved_courses->book_unique_id ]
            ];
            $reviews = $this->review->getAllReviews($conditions);
            $each_saved_courses->reviews = $reviews;
            $each_saved_courses->count_review = $this->calculateRatings($reviews);

        }

        return view('dashboard.saved_courses', ['saved_courses'=>$saved_courses]);

    }

    function handleValidations(array $data){

        $validator = Validator::make($data, [
            'course_unique_id' => 'required',
            'user_unique_id' => 'required'
        ]);

        return $validator;

    }

    public function saveCourse(Request $request){

        $data = $request->all();

        try{

            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            $condition = [
                ['user_unique_id', $data['user_unique_id']],
                ['book_unique_id', $data['course_unique_id']],
            ];

            $savedCourse = $this->savedCourses->getAllSaveCourse($condition);

            if (count($savedCourse) > 0){

                return response()->json(['error_code'=>1, 'error_message'=>'Course saved! already ']);

            }else{

                $save_course = new SavedCourses();

                $unique_id = $this->createUniqueId('likes', 'unique_id');

                $save_course->unique_id = $unique_id;
                $save_course->user_unique_id = $data['user_unique_id'];
                $save_course->book_unique_id = $data['course_unique_id'];

                if ($save_course->save()){
                    return response()->json(['error_code'=>0, 'success_statement'=>'course was saved successfully']);
                }else{
                    return response()->json(['error_code'=>1, 'error_message'=>'This Course has already been save']);
                }

            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }

    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'action' => 'required'
        ]);
        return $validator;

    }

    public function removeSavedCourse(Request $request){

        try{

            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            if($request->action === "single"){

                $condition = [
                    ['unique_id', $request->saved_course_id],
                ];

                $savedCourse = $this->savedCourses->getSingleSaveCourse($condition);
                if($savedCourse !== null){
                    $savedCourse->delete();
                }else{
                    return response()->json(['error_code'=>1, 'error_message'=>'An Error occurred, try again later']);
                }

            }else{

                $condition = [
                    ['user_unique_id', $request->user_unique_id],
                ];
                $savedCourse = $this->savedCourses->getAllSaveCourse($condition);
                if(count($savedCourse) > 0){
                    foreach($savedCourse as $eachSavedCourse){
                        $eachSavedCourse->delete();
                    }
                }else{
                    return response()->json(['error_code'=>1, 'error_message'=>'An Error occurred, try again later']);
                }

            }
            return response()->json(['error_code'=>0, 'success_statement'=>'Saved Course was Removed successfully']);

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }


    }
}
