<?php

namespace App\Http\Controllers\Users;

use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\InsrtuctorReviewReply;
use App\Model\InstructorReviewLike;
use App\Model\InstructorsReview;
use App\Model\courseEnrollment;
use App\Model\Subscribe;
use App\Traits\UsersArray;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class GeneralUserController extends Controller
{
    //
    use UsersArray;

    function __construct(
        User $user, course_model $course_model, Subscribe $subscribe, InstructorsReview $instructorsReview, InsrtuctorReviewReply $instructorReviewReply, InstructorReviewLike $instructorReviewLike, courseEnrollment $courseEnrollment
    ){
        $this->user = $user;
        $this->course_model = $course_model;
        $this->subscribe = $subscribe;
        $this->instructorsReview = $instructorsReview;
        $this->instructorReviewReply = $instructorReviewReply;
        $this->instructorReviewLike = $instructorReviewLike;
        $this->courseEnrollment = $courseEnrollment;
    }

    public function viewUserGeneral($unique_id){

        $condition = [
            ['unique_id', $unique_id]
        ];
        $user = $this->user->getSingleUser($condition);

        $condition = [
            ['user_id', $user->unique_id]
        ];
        $course_model = $this->course_model->getAllCourse($condition);
        $user->courses = $course_model;

        foreach ($user->courses as $each_course){
            $each_course->user;
            $each_course->price;
            $each_course->category;
        }

        $conditions = [
            ['teacher_unique_id',  $user->unique_id]
        ];
        $subscribe = $this->subscribe->getAllSubscribers($conditions);
        $user->subscribe = $subscribe;

        foreach ($user->subscribe as $each_subscribe){
            $each_subscribe->users;
            $conditionss = [
                ['user_id', $each_subscribe->users->unique_id]
            ];
            $course_model = $this->course_model->getAllCourse($conditionss);
            $each_subscribe->course_count = count($course_model);

            $enrolled = $this->courseEnrollment->getAllEnrolls([
                ['course_creator', '=', $each_subscribe->unique_id]
            ]);
            $each_subscribe->enrolled_users = $enrolled->count();
        }

        $query = [
            ['instructor_unique_id', $user->unique_id]
        ];
        $instructors = $this->instructorsReview->getAllInstructorReview($query);
        $user->comments_for_instructor = $instructors;
        foreach ($user->comments_for_instructor as $each_instructor_comment){
            $each_instructor_comment->users;

            $likes_query = [
                ['main_review_id', $each_instructor_comment->unique_id],
                ['like_type', 'like'],
            ];
            $likes = $this->instructorReviewLike->getAllInstructorReviewLike($likes_query);
            $each_instructor_comment->likes = $likes;

            $likes_query = [
                ['main_review_id', $each_instructor_comment->unique_id],
                ['like_type', 'dislike'],
            ];
            $likes = $this->instructorReviewLike->getAllInstructorReviewLike($likes_query);
            $each_instructor_comment->dislikes = $likes;

            $queries = [
                ['main_instructor_unique_id', $each_instructor_comment->unique_id]
            ];
            $instructorReviewReply = $this->instructorReviewReply->getAllInstructorReviewReply($queries);

            $each_instructor_comment->each_instructor_comments = $instructorReviewReply;

            foreach ($each_instructor_comment->each_instructor_comments as $comment){
                $comment->users;
                $likes_query = [
                    ['main_review_id', $comment->unique_id],
                    ['like_type', 'like'],
                ];
                $likes = $this->instructorReviewLike->getAllInstructorReviewLike($likes_query);
                $comment->comment_reply_likes = $likes;

                $likes_query = [
                    ['main_review_id', $comment->unique_id],
                    ['like_type', 'dislike'],
                ];
                $likes = $this->instructorReviewLike->getAllInstructorReviewLike($likes_query);
                $comment->comment_reply_dislikes = $likes;

            }
        }
        $array_of_subscribers = $this->returnArrayForSubscribeUsers($user->unique_id);
        $user->array_of_subscribers = $array_of_subscribers;

        $enrolled = $this->courseEnrollment->getAllEnrolls([
            ['course_creator', '=', $user->unique_id]
        ]);
        $user->enrolled_users = $enrolled->count();

        return view('dashboard.profile_page', ['user'=>$user]);
    }

    public function browseInstructors(){

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

        return view('dashboard.browse_instructors', ['instructors'=>$instructors]);

    }

    public function updateUserFCMKeys(Request $request, $user_unique_id){
        $data = $request->all();

        $condition = [
            ['unique_id', $user_unique_id]
        ];
        $user = $this->user->getSingleUser($condition);

        try{

            if ($user === null){
                return response()->json(['error_code'=>1, 'error_message'=>'this user does not exist']);
            }else{

                $user->andriod_fcm_key = $data['andriod_fcm_key'];
                $user->ios_fcm_key = $data['ios_fcm_key'];
                $user->web_fcm_key = $data['web_fcm_key'];
                if($user->save()){
                    return response()->json(['error_code'=>0, 'success_statement'=>'FCM Keys were updated successfully']);
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
