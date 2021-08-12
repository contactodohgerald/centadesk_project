<?php

namespace App\Http\Controllers\Subscribe;

use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\Subscribe;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    //
    use Generics;
    function __construct(Subscribe $subscribe, course_model $course_model){
        $this->middleware('auth',  ['except' => ['subscribeTOTeacher']]);
        $this->subscribe = $subscribe;
        $this->course_model = $course_model;

    }

    public function browseSubscribers(){

        $user = Auth::user();

        $condition = [
            ['teacher_unique_id', $user->unique_id]
        ];
        $subscriber = $this->subscribe->getAllSubscribers($condition);

        foreach ($subscriber as $each_subscribe){

            $each_subscribe->users;

            $conditions = [
                ['user_id', $each_subscribe->user_unique_id],
            ];
            $course_model = $this->course_model->getAllCourse($conditions);

            $each_subscribe->count_course = $course_model->count();

        }

        return view('dashboard.browse_subscribers', ['subscriber'=>$subscriber]);
    }

    function handleValidations(array $data){

        $validator = Validator::make($data, [
            'userId' => 'required',
            'teacherId' => 'required'
        ]);

        return $validator;

    }

    public function subscribeTOTeacher(Request $request){

        $data = $request->all();

        try{

            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            $condition = [
                ['user_unique_id', $data['userId']],
                ['teacher_unique_id', $data['teacherId']],
            ];

            $subscribe = $this->subscribe->getAllSubscribers($condition);

            if ($subscribe->count() > 0){
                return response()->json(['error_code'=>1, 'error_message'=>'Already subscribed to instructor']);
            }else{
                $unique_id = $this->createUniqueId('subscribes', 'unique_id');

                $subscribes = new Subscribe();
                $subscribes->unique_id = $unique_id;
                $subscribes->user_unique_id = $data['userId'];
                $subscribes->teacher_unique_id = $data['teacherId'];

                if($subscribes->save()){
                    return response()->json(['error_code'=>0, 'success_statement'=>'Subscribed!']);
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
