<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Model\InsrtuctorReviewReply;
use App\Model\InstructorReviewLike;
use App\Model\InstructorsReview;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorsReviewController extends Controller
{
    //
    use Generics;

    function __construct(InstructorReviewLike $instructorReviewLike){
        $this->instructorReviewLike = $instructorReviewLike;
    }

    function handleValidation(array $data){
        $validator = Validator::make($data, [
            'instructor_id' => 'required',
            'user_id' => 'required',
            'comment' => 'required',
        ]);
        return $validator;
    }

    public function createInstructorComment(Request $request){
        $data = $request->all();

        try{
            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            $reviews = new InstructorsReview();
            $unique_id = $this->createUniqueId('instructors_reviews', 'unique_id');
            $reviews->unique_id = $unique_id;
            $reviews->instructor_unique_id = $data['instructor_id'];
            $reviews->user_unique_id = $data['user_id'];
            $reviews->comment = $data['comment'];
            if ($reviews->save()){
                return response()->json(['error_code'=>0, 'success_statement'=>'Comment was successfully posted']);
            }else{
                return response()->json(['error_code'=>1, 'error_message'=>'This Course has already been save']);
            }
        }catch (Exception $exception){
            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);
        }

    }

    function handleValidations(array $data){
        $validator = Validator::make($data, [
            'main_comment_id' => 'required',
            'user_id' => 'required',
            'comment' => 'required',
        ]);
        return $validator;
    }

    public function replyInstructorComment(Request $request){
        $data = $request->all();

        try{
            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }
            $reviews = new InsrtuctorReviewReply();
            $unique_id = $this->createUniqueId('insrtuctor_review_replies', 'unique_id');
            $reviews->unique_id = $unique_id;
            $reviews->user_unique_id = $data['user_id'];
            $reviews->main_instructor_unique_id = $data['main_comment_id'];
            $reviews->comment = $data['comment'];
            if ($reviews->save()){
                return response()->json(['error_code'=>0, 'success_statement'=>'Replied comment was successfully posted']);
            }else{
                return response()->json(['error_code'=>1, 'error_message'=>'This Course has already been save']);
            }
        }catch (Exception $exception){
            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);
        }

    }

    function handleValidationss(array $data){
        $validator = Validator::make($data, [
            'main_review_id' => 'required',
            'user_unique_id' => 'required',
            'action' => 'required',
        ]);
        return $validator;
    }
    public function processReviewLikeStatus(Request $request){

        $data = $request->all();

        try{

            $validation = $this->handleValidationss($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            if ($data['action'] === 'like'){

                $likes = $this->addLikeToModel($data['action'], $data['main_review_id'] , $data['user_unique_id']);

                return response()->json(['error_code'=>0, 'success_statement'=>$likes]);

            }elseif($data['action'] === 'dislike'){

                $likes = $this->addLikeToModel($data['action'], $data['main_review_id'] , $data['user_unique_id']);

                return response()->json(['error_code'=>0, 'success_statement'=>$likes]);

            }else{
                return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }

    }

    public function addLikeToModel($action, $main_review_id, $user_id){

        $condition = [
            ['user_unique_id', $user_id],
            ['main_review_id', $main_review_id],
            ['like_type', $action],
        ];
        $like = $this->instructorReviewLike->getSingleInstructorReviewLike($condition);

        if($like === null){
            $unique_id = $this->createUniqueId('likes', 'unique_id');

            $likes = new InstructorReviewLike();
            $likes->unique_id   = $unique_id ;
            $likes->user_unique_id = $user_id;
            $likes->main_review_id = $main_review_id;
            $likes->like_type = $action;
            $likes->save();
            if ($action === 'like'){
                return 'liked!';
            }else{
                return 'disliked!';
            }
        }else{
            $like->delete();
            return 'removed!';

        }

    }
}
