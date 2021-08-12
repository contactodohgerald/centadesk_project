<?php

namespace App\Http\Controllers\Review;

use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\Review;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    //
    use Generics;
    function __construct(Review $review, course_model $course_model){
        $this->review = $review;
        $this->course_model = $course_model;
    }

    public function getAllReviews($course_unique_id){

        $condition = [
            ['course_unique_id', $course_unique_id],
        ];

        $reviews = $this->review->getAllReviews($condition);

        return response()->json(['error_code'=>0, 'success_statement'=>'Review was returned successfully!', 'data'=>$reviews]);

    }

    public function getAllCourses($course_unique_id){

        $condition = [
            ['unique_id', $course_unique_id]
        ];
        $course = $this->course_model->getSingleCourse($condition);

        if($course != null){
            $review_condition = [
                ['course_unique_id', $course->unique_id]
            ];
    
            $reviews = $this->review->getAllReviews($review_condition);
            if(count($reviews) > 0){
                $course->reviews = $reviews;
                foreach ($reviews as $each_review){
                    $each_review->users;
                }
        
                return response()->json(['error_code'=>0, 'success_statement'=>'Review was returned successfully!', 'data'=>$course]);
            }
        }

    }

    function handleValidations(array $data){

        $validator = Validator::make($data, [
            'userId' => 'required',
            'courseId' => 'required',
            'message' => 'required',
            'rating' => 'required',
        ]);

        return $validator;

    }

    public function storeReview(Request $request){

        $data = $request->all();

        try{

            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            $condition = [
                ['user_unique_id', $data['userId']],
                ['course_unique_id', $data['courseId']],
            ];

            $review = $this->review->getAllReviews($condition);

            if ($review->count() > 0){

                foreach ($review as $each_review){

                    $each_review->user_unique_id = $data['userId'];
                    $each_review->course_unique_id = $data['courseId'];
                    $each_review->rating = $data['rating'];
                    $each_review->review_message = $data['message'];

                    if($each_review->save()){
                        return response()->json(['error_code'=>0, 'success_statement'=>'Review was saved successfully!']);
                    }else{
                        return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
                    }
                }
            }else{
                $unique_id = $this->createUniqueId('reviews', 'unique_id');

                $reviews = new Review();
                $reviews->unique_id = $unique_id;
                $reviews->user_unique_id = $data['userId'];
                $reviews->course_unique_id = $data['courseId'];
                $reviews->rating = $data['rating'];
                $reviews->review_message = $data['message'];

                if($reviews->save()){
                    return response()->json(['error_code'=>0, 'success_statement'=>'Review was saved successfully!']);
                }else{
                    return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
                }
            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }
    }
}
