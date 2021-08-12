<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Model\BlogModel;
use App\Model\BlogPostComment;
use App\Model\BlogTagModel;
use App\Model\TestimonyModel;
use App\course_category_model;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    //
    use Generics;
    function __construct(
        BlogTagModel $blogTagModel, BlogModel $blogModel, TestimonyModel $testimonyModel, course_category_model $course_category_model
    ){
        $this->middleware('auth',  ['except' => ['storeBlogTags', 'storeBlog', 'confirmBlogPost', 'blogPostComment', 'blogDetailsInterface']]);
        $this->blogTagModel = $blogTagModel;
        $this->blogModel = $blogModel;
        $this->testimonyModel = $testimonyModel;
        $this->course_category_model = $course_category_model;
    }

    public function createBlogTagInterface(){
        return view('dashboard.create_tag');
    }

    public function blogDetailsInterface($unique_id = null){
        if ($unique_id != null){
            $blog_post = $this->blogModel->getSingleBlogPost([
                ['unique_id', $unique_id],
            ]);
            $blog_post->views += 1;
            $blog_post->save();

            $tags = explode(',', $blog_post->tag_unique_id);
            $arra = [];
            foreach ($tags as $yy => $each_tags){
                $blog_tag = $this->blogTagModel->getSingleBlogTags([
                    ['unique_id', $each_tags]
                ]);

                array_push($arra, $blog_tag);
            }
            $blog_post->blog_post_tag = $arra;

            $blog_post->blogComments;

            $blog_post->users;

            $blogs = $this->blogModel->getAllBlogPost([
                ['status', 'confirmed'],
            ]);

            $testimonys = $this->testimonyModel->getAllTestimony();

            $course_category_model = $this->course_category_model->getAllCategories();

            $view = [
                'blog_post'=>$blog_post,
                'recentPosts'=>$blogs,
                'testimonys'=>$testimonys,
                'course_category_model'=>$course_category_model,
            ];

            return view('front_end.blog-details', $view);
        }
    }

    public function blogPostList(){
        $blogModel = $this->blogModel->getAllBlogPost([
            ['status', 'pending'],
        ]);
        return view('dashboard.blog_list', ['blogModel'=>$blogModel]);
    }

    public function createBlogInterface(){
        $blogTagModel = $this->blogTagModel->getAllBlogTags();
        return view('dashboard.create_blog', ['blogTagModel'=>$blogTagModel]);
    }

    function handleValidations(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'tags' => 'required',
        ]);
    }
    public function storeBlogTags(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $status_hold = 0;

        try{

            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            if (count($data['tags']) > 0){
                foreach ($data['tags'] as $kk => $each_tags){
                    $unique_id = $this->createUniqueId('blog_tag_models', 'unique_id');
                    $blog_tag = new BlogTagModel();
                    $blog_tag->unique_id = $unique_id;
                    $blog_tag->tag_name = $each_tags;

                    if ($blog_tag->save()){
                        $status_hold = 1;
                    }
                }

                if($status_hold == 1){
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

    function handleValidation(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'title' => 'required',
            'tags' => 'required',
            'desc' => 'required',
           // 'cover_img' => 'required|file|image|mimes:jpeg,png,gif|max:4048',
        ]);
    }
    public function storeBlog(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $blog_image = null;
        try{
            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            if ($request->hasFile('cover_img')) {

                $image = $request->file('cover_img');
                $blog_image = md5($image->getClientOriginalName() . time()).'.'.$image->getClientOriginalExtension();
             
                $destinationPath = storage_path('app/public/blog_image');
                $img = Image::make($image->getRealPath());
                $img->resize(382, 382, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$blog_image);
            }

            $unique_id = $this->createUniqueId('blog_models', 'unique_id');
            $blogs = new BlogModel();

            $blogs->unique_id = $unique_id;
            $blogs->blog_title = $data['title'];
            $blogs->blog_image = $blog_image;
            $blogs->blog_message = $data['desc'];
            $blogs->user_unique_id = $data['userUniqueId'];
            $blogs->tag_unique_id = $data['tags'];

            if($blogs->save()){
                return response()->json(['error_code'=>0, 'success_statement'=>'Blog Post was saved successfully!']);
            }else{
                return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }
    }

    function handleTransferValidations(array $data)
    {

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;
    }
    public function confirmBlogPost(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $validation = $this->handleTransferValidations($request->all());
            if ($validation->fails()) {
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $dataArray = explode('|', $request->dataArray);

            foreach ($dataArray as $eachDataArray) {

                //update the blog post status to confirmed
                $blogPost = $this->blogModel->getSingleBlogPost([
                    ['unique_id', $eachDataArray]
                ]);
                $blogPost->status = 'confirmed';
                $blogPost->save();
            }
            return response()->json(['error_code' => 0, 'success_statement' => 'Selected Blog Post was confirmed Successfully']);
            // return ['error_code'=>1, 'error_message'=>'An error occurred, please try again'];

        } catch (Exception $exception) {

            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);

        }
    }

    protected function Validators($request){

        $this->validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

    }
    public function blogPostComment(Request $request, $unique_id = null){
        try {

            $this->Validators($request);//validate fields

            if ($unique_id != null){

                $uniqueId = $this->createUniqueId('blog_post_comments', 'unique_id');
                $comment = new BlogPostComment();

                $comment->unique_id = $uniqueId;
                $comment->blog_unique_id = $unique_id;
                $comment->user_name = $request->name;
                $comment->user_email = $request->email;
                $comment->message = $request->message;

                if ($comment->save()){
                    return redirect('/blog-details/'.$unique_id)->with('success_message', 'Comment was made successfully');
                }else{
                    return redirect('/blog-details/'.$unique_id)->with('error_message', 'An Error occurred, Please try Again Later');
                }
            }

        } catch (Exception $exception) {
            $errorsArray = $exception->getMessage();
            return  redirect('/blog-details/'.$unique_id)->with('error_message', $errorsArray);

        }
    }
}
