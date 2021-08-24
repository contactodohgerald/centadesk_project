<?php

namespace App\Http\Controllers\Users;

use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\Model\InsrtuctorReviewReply;
use App\Model\InstructorReviewLike;
use App\Model\InstructorsReview;
use App\Model\KycVerification;
use App\Model\Subscribe;
use App\Model\courseEnrollment;
use App\Model\live_stream_model;
use App\Traits\Generics;
use App\Traits\SendMail;
use App\Traits\UsersArray;
use App\Models\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\appFunction;

class UserController extends Controller
{
    use appFunction, SendMail, Generics, UsersArray;

    function __construct(
        KycVerification $kycVerification,
        AppSettings $appSettings,
        course_model $course_model,
        Subscribe $subscribe,
        InstructorReviewLike $instructorReviewLike,
        InsrtuctorReviewReply $instructorReviewReply,
        InstructorsReview $instructorsReview,
        live_stream_model $liveStream,
        courseEnrollment $courseEnrollment
    ) {
        $this->middleware('auth',  ['except' => ['comfirmUser', 'update_user_details', 'upload_cover_photo', 'soft_delete']]);
        $this->kycVerification = $kycVerification;
        $this->appSettings = $appSettings;
        $this->course_model = $course_model;
        $this->subscribe = $subscribe;
        $this->instructorReviewLike = $instructorReviewLike;
        $this->instructorsReview = $instructorsReview;
        $this->instructorReviewReply = $instructorReviewReply;
        $this->courseEnrollment = $courseEnrollment;
        $this->liveStream = $liveStream;
        // liveStream
    }

    /**
     * Function to display teacher profile page.
     *
     * @return array
     */
    public function profile(){
        $user = Auth::user();

        $condition = [
            ['user_id', $user->unique_id]
        ];
        $course_model = $this->course_model->getAllCourse($condition);
        $user->courses = $course_model;

        foreach ($user->courses as $each_course) {

            $each_course->user;

            $each_course->price;

            $each_course->category;
        }

        $conditions = [
            ['teacher_unique_id',  $user->unique_id]
        ];
        $subscribe = $this->subscribe->getAllSubscribers($conditions);
        $user->subscribe = $subscribe;


        foreach ($user->subscribe as $each_subscribe) {

            $each_subscribe->users;
            $conditions = [
                ['user_id',  $each_subscribe->users->unique_id]
            ];
            $course_model = $this->course_model->getAllCourse($conditions);
            $each_subscribe->count_course = count($course_model);

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
        foreach ($user->comments_for_instructor as $each_instructor_comment) {
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

            foreach ($each_instructor_comment->each_instructor_comments as $comment) {
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

        return view('dashboard.profile', ['user' => $user]);
    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'account_name' => 'required',
            'bank_code' => 'required',
            'bank_account' => 'required',
        ]);
    }

    function bankAccountUpdate(Request $request){

        $data = $request->all();

        try {
            $this->Validator($request); //validate fields

            $user = Auth::user();

            $user->account_name = $data['account_name'];
            $user->bank_code = $data['bank_code'];
            $user->account_number = $data['bank_account'];

            if ($user->save()) {
                return redirect('/main_settings_page')->with('success_message', 'Bank Account Details was updated Successfully');
            } else {
                return redirect('/main_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('main_settings_page')->with('error_message', $errorsArray);
        }
    }

    function walletAddressUpdate(Request $request){

        $data = $request->all();

        try {

            $user = Auth::user();

            $user->wallet_address = $data['bit_coin_wallet'];

            if ($user->save()) {
                return redirect('/main_settings_page')->with('success_message', 'Wallet was updated Successfully');
            } else {
                return redirect('/main_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('main_settings_page')->with('error_message', $errorsArray);
        }
    }

    /**
     * Post Controller for update of user details.
     *
     * @param Request $request
     * @return array
     */
    public function update_user_details(Request $request){
        $user = $request->user();

        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'first_name' => 'string|max:40|nullable',
                'other_names' => 'string|nullable',
                'headline' => 'string|max:100|nullable',
                'description' => 'min:50|nullable',
                'facebook' => 'string|nullable',
                'twitter' => 'string|nullable',
                'linkedin' => 'string|nullable',
                'youtube' => 'string|nullable',
                'instagram' => 'string|nullable',
                'whatsapp' => 'string|nullable',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $first_name = $request->input('first_name');
            $other_names = $request->input('other_names');
            $headline = $request->input('headline');
            $description = $request->input('description');
            $facebook = $request->input('facebook');
            $twitter = $request->input('twitter');
            $linkedin = $request->input('linkedin');
            $youtube = $request->input('youtube');
            $instagram = $request->input('instagram');
            $whatsapp = $request->input('whatsapp');

            $user = User::find($user->unique_id);

            $user->name = $first_name;
            $user->last_name = $other_names;
            $user->professonal_heading = $headline;
            $user->description = $description;
            $user->facebook = $facebook;
            $user->twitter = $twitter;
            $user->linkedin = $linkedin;
            $user->youtube = $youtube;
            $user->instagram = $instagram;
            $user->whatsapp = $whatsapp;
            $updated = $user->save();


            if (!$updated) {
                throw new Exception('Database Error!');
            } else {
                $error = 'Personal Details Updated!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => $error,
            ];
            return response()->json(["message" => $error, 'status' => false]);
        }
    }

    /**
     * Function for updating cover photo.
     *
     * @return array
     */
    public function upload_cover_photo(Request $request){
        $user = $request->user();

        try {
            $validator = Validator::make($request->all(), [
                'profile_img' => 'required|file|image|mimes:jpeg,png,gif|max:4048',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $user = User::find($user->unique_id);
            $prev_file_name = $user->profile_image;


            //delete existing file
            if (file_exists(storage_path('app/public/profile/' . $prev_file_name))) {

                if ($prev_file_name !== 'avatar.png') {
                    unlink(storage_path('app/public/profile/' . $prev_file_name));
                }
            }

            $cover_img = $request->file('profile_img');
            $img_name = $this->gen_file_name($user, 'profile-photo', $cover_img);
            $upload_img = $cover_img->storeAs(
                'public/profile',
                $img_name
            );

            $user->profile_image = $img_name;
            $updated = $user->save();

            if (!$updated) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Profile Image Updated!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    function uploadUserCAC(){

        return view('dashboard.upload_cac');
    }

    protected function Validators($request)
    {

        $this->validator = Validator::make($request->all(), [
            'cac_passport' => 'required|mimes:jpg,jpeg,png|max:3000',
            'cac_files' => 'required|mimes:jpg,jpeg,png,pdf,doc|max:6000',
        ]);
    }

    function uploadCACFiles(Request $request){
        $user = Auth::user();
        try {
            $this->Validators($request); //validate fields

            $condition = [
                ['user_unique_id', $user->unique_id],
            ];

            $kycVerification = $this->kycVerification->getAllKycVerification($condition);

            if (count($kycVerification) > 0) {


                foreach ($kycVerification as $each_kycVerification) {

                    //code for remove old file
                    if ($each_kycVerification->passport_cac !== null) {
                        if (file_exists(storage_path('app/public/cac_passport/') . $user->passport_cac)) {
                            $file_old = storage_path('app/public/cac_passport/') . $user->passport_cac;
                            unlink($file_old);
                        }
                    }
                    if ($request->hasFile('cac_passport')) {
                        $file = $request->file('cac_passport');
                        $cac_passport = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->storeAs('public/cac_passport', $cac_passport);
                    }

                    if ($each_kycVerification->file_cac !== null) {
                        if (file_exists(storage_path('app/public/cac_files/') . $user->file_cac)) {
                            $file_olds = storage_path('app/public/cac_files/') . $user->file_cac;
                            unlink($file_olds);
                        }
                    }
                    if ($request->hasFile('cac_files')) {
                        $files = $request->file('cac_files');
                        $cac_files = md5($files->getClientOriginalName() . time()) . "." . $files->getClientOriginalExtension();
                        $files->storeAs('public/cac_files', $cac_files);
                    }

                    $each_kycVerification->passport_cac = $cac_passport;
                    $each_kycVerification->file_cac = $cac_files;
                    $each_kycVerification->status = 'pending';

                    if ($each_kycVerification->save()) {

                        $adminEmail = $this->appSettings->getSingleModel();

                        $full_name = $user->name . ' ' . $user->last_name;

                        $message = 'Hi Adnin, am ' . $full_name . ' by name. I re-uploaded my form of verification for KYC verification, Please treat it with all urgency. Thank you';

                        $this->sendAdminEmailForAccountResolve('KYC Verification', $message, env('APP_NAME'), $this->base_url, $adminEmail->company_email_2);

                        return redirect('/kyc_verification')->with('success_message', 'CAC Upload was made successfully');
                    } else {
                        return redirect('/kyc_verification')->with('error_message', 'An Error occurred, Please try Again Later');
                    }
                }
            } else {

                if ($request->hasFile('cac_passport')) {
                    $file = $request->file('cac_passport');
                    $cac_passport = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->storeAs('public/cac_passport', $cac_passport);
                }

                if ($request->hasFile('cac_files')) {
                    $files = $request->file('cac_files');
                    $cac_files = md5($files->getClientOriginalName() . time()) . "." . $files->getClientOriginalExtension();
                    $files->storeAs('public/cac_files', $cac_files);
                }

                $unique_id = $this->createUniqueId('kyc_verifications', 'unique_id');

                $kycVerifications = new KycVerification();
                $kycVerifications->unique_id = $unique_id;
                $kycVerifications->passport_cac = $cac_passport;
                $kycVerifications->file_cac = $cac_files;
                $kycVerifications->user_unique_id = $user->unique_id;
                $kycVerifications->status = 'pending';

                if ($kycVerifications->save()) {

                    $user->cac_verification_status = 'yes';
                    $user->save();

                    $adminEmail = $this->appSettings->getSingleModel();

                    $full_name = $user->name . ' ' . $user->last_name;

                    $message = 'Hi Adnin, am ' . $full_name . ' by name. I just uploaded my form of verification, Please treat it with all urgency. Thank you';

                    $this->sendAdminEmailForAccountResolve('KYC Verification', $message, env('APP_NAME'), $this->base_url, $adminEmail->company_email_2);

                    return redirect('/kyc_verification')->with('success_message', 'CAC Upload was made successfully');
                } else {
                    return redirect('/kyc_verification')->with('error_message', 'An Error occurred, Please try Again Later');
                }
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('/kyc_verification')->with('error_message', $errorsArray);
        }
    }

    public function soft_delete(Request $request, $id){
        try {
            if (!$id) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            $delete_user = User::find($id)->delete();
            if (!$delete_user) {
                throw new Exception($this->errorMsgs(14)['msg']);
            }

            $condition = [
                ['user_id', $id],
            ];
            $delete_all_course = $this->course_model->getAllCourse($condition);

            foreach ($delete_all_course as $e) {
                $e->delete();
            }
            $condition = [
                ['user_id', $id],
            ];
            $delete_live_stream = $this->liveStream->get_all($condition);

            foreach ($delete_live_stream as $e) {
                $e->delete();
            }

            $error = 'User Deleted Successfully!';
            return response()->json(["message" => $error, 'status' => true]);
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    function handleDeleteValidations(array $data)
    {

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;
    }

    public function comfirmUser(Request $request){
        try {

            $validation = $this->handleDeleteValidations($request->all());
            if ($validation->fails()) {
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $dataArray = explode('|', $request->dataArray);

            foreach ($dataArray as $eachDataArray) {
                //update the user email to confirmed
                $user = User::find($eachDataArray);
                $user->email_verified_at = Carbon::now()->toDateString();
                $user->save();
            }
            return response()->json(['error_code' => 0, 'success_statement' => 'Selected user (s) was comfirmed successfully']);

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);
        }
    }
}
