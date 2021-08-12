<?php

namespace App\Http\Controllers\Route;

use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\Model\BlogModel;
use App\Model\TestimonyModel;
use App\Model\GalleryModel;
use App\Traits\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    //
    use SendMail;
    function __construct(
        User $user, TestimonyModel $testimonyModel, course_model $course_model, AppSettings $appSettings, BlogModel $blogModel, GalleryModel $galleryModel
    ){
        $this->user = $user;
        $this->testimonyModel = $testimonyModel;
        $this->course_model = $course_model;
        $this->appSettings = $appSettings;
        $this->blogModel = $blogModel;
        $this->galleryModel = $galleryModel;
    }

    public function aboutUsPage(){
        $query = [
            ['status', 'active'],
            ['user_type', 'teacher'],
            ['yearly_subscription_status', 'yes'],
        ];
        $instructors = $this->user->getAllUsers($query);

        $testimonys = $this->testimonyModel->getAllTestimony();

        $view = [
            'instructors'=>$instructors,
            'testimonys'=>$testimonys,
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
        ];
        return view('front_end.about', $view);
    }

    public function contactUsPage(){
        $appSettings = $this->appSettings->getSingleModel();
        $view = [
            'appSettings'=>$appSettings,
        ];
        return view('front_end.contact', $view);
    }

    public function faqPage(){
        return view('front_end.faq');
    }

    public function blogPage(){
        $blogs = $this->blogModel->getBlogByPaginate(20, [
            ['status', 'confirmed'],
        ]);
        foreach ($blogs as $each_blog_post){
            $each_blog_post->blogComments;

            $each_blog_post->users;
        }

        return view('front_end.blog', ['blogs'=>$blogs]);
    }

    public function howItWorksPage(){
        return view('front_end.how-it-works');
    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
    }

    public function contactUsMail(Request $request){
        // full_name email phone subject message
        $data = $request->all();

        try {
            $this->Validator($request); //validate fields

            $adminEmail = $this->appSettings->getSingleModel();

            $this->contactUsMailSend('Notification', $data['subject'], $data['phone'],  $data['email'], $data['full_name'], $data['message'], env('APP_NAME'), $this->base_url, $adminEmail->company_email_2);

            return back()->with('success_message', 'Mail Was Sent Successfully');

        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  back()->with('error_message', $errorsArray);
        }
    }

    public function termsOfUsePage(){
        return view('front_end.terms');
    }

    public function privacyPolicy(){
        return view('front_end.privacy');
    } 
    
    public function affiliatePage(){
        return view('front_end.affiliate');
    }
    
    public function careerPage(){
        return view('front_end.career');
    } 
    
    public function teacherPage(){
        return view('front_end.teacher');
    } 
    public function galleryPage(){

        $galleryModel = $this->galleryModel->getGalleryByPaginate(9, [
            ['status', 'pending'],
        ]);

        foreach($galleryModel as $each_gallery){
            $each_gallery->users;
        }

        $view = [
            'galleryModel'=>$galleryModel,
        ];

        return view('front_end.gallery', $view);
    }
    
}
