<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Model\Like;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\Generics;

class LikesController extends Controller
{
    //
    use Generics;

    function __construct(Like $like){
        $this->like = $like;
    }

    function handleValidations(array $data){

        $validator = Validator::make($data, [
            'course_unique_id' => 'required',
            'user_unique_id' => 'required',
            'action' => 'required',
        ]);

        return $validator;

    }

    public function processCourseLikeStatus(Request $request){

        $data = $request->all();

        try{

            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            if ($data['action'] === 'like'){

                $likes = $this->addLikeToModel($data['action'], $data['course_unique_id'] , $data['user_unique_id']);

                return response()->json(['error_code'=>0, 'success_statement'=>$likes]);

            }elseif($data['action'] === 'dislike'){

                $likes = $this->addLikeToModel($data['action'], $data['course_unique_id'] , $data['user_unique_id']);

                return response()->json(['error_code'=>0, 'success_statement'=>$likes]);

            }else{
                return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }

    }

    public function addLikeToModel($action, $course_id, $user_id){

        $condition = [
            ['user_unique_id', $user_id],
            ['course_unique_id', $course_id],
            ['like_type', $action],
        ];

        $like = $this->like->getSingleLikes($condition);

        if($like === null){
            $unique_id = $this->createUniqueId('likes', 'unique_id');

            $likes = new Like();
            $likes->unique_id   = $unique_id ;
            $likes->user_unique_id = $user_id;
            $likes->course_unique_id = $course_id;
            $likes->like_type = $action;

            $likes->save();

            if ($action === 'like'){
                return 'Liked!';
            }else{
                return 'Disliked!';
            }
        }else{

            $like->delete();

            return 'Removed!';

        }

    }
}
