<?php

namespace App\Http\Controllers;

use Exception;
use App\priceModel;
use App\course_model;
use App\Traits\Generics;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\course_category_model;
use Illuminate\Support\Facades\Validator;

class CourseCategoryModelController extends Controller
{
    use Generics;
    use appFunction;

    function __construct(course_category_model $category_model, priceModel $priceModel, course_model $course_model)
    {
        $this->middleware('auth');
        $this->course_model = $course_model;
        $this->category_model = $category_model;
        $this->priceModel = $priceModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.create_category');
    }

    public function viewCoursesCategories(){

        $categories = $this->category_model->getAllCategories();

        return view('dashboard.view-category', ['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30|unique:course_category_tb,name',
                'description' => 'required|min:5',
                'category_icon' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/create_category')->with('error_message', $validator->errors());
            }

            if ($request->hasFile('category_image')) {
                $file = $request->file('category_image');
                $category_image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->storeAs('public/category_image', $category_image);
            }

            $course_category_tb = new course_category_model();

            $unique_id = $this->createUniqueId('course_category_tb', 'unique_id');
            $course_category_tb->unique_id  = $unique_id;
            $course_category_tb->name  = $data['name'];
            $course_category_tb->category_icon  = $data['category_icon'];
            $course_category_tb->category_image  = $category_image;
            $course_category_tb->description  = $data['description'];

            if ($course_category_tb->save()) {
                return redirect('/create_category')->with('success_message', 'Course Category was created Successfully');
            } else {
                return redirect('/create_category')->with('error_message', 'An error occurred, please try again later');
            }
        } catch (Exception $e) {
            $errorsArray = [$e->getMessage()];
            return redirect('/create_category')->with('error_message', $errorsArray);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\course_category_model  $course_category_model
     * @return \Illuminate\Http\Response
     */
    public function show($unique_id)
    {
        //

        $condition = [
            ['unique_id', $unique_id]
        ];

        $course_category = $this->category_model->getSingleCategories($condition);

        // print_r($course_category);die();
        return view('dashboard.edit_category', ['course_category'=>$course_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\course_category_model  $course_category_model
     * @return \Illuminate\Http\Response
     */
    public function edit(course_category_model $course_category_model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course_category_model  $course_category_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_category_model)
    {
        //
        $data = $request->all();

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30',
                'description' => 'required|min:5',
                'category_icon' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error_message', $validator->errors());
            }

            $condition = [
                ['unique_id', $course_category_model]
            ];

            $course_category_tb = $this->category_model->getSingleCategories($condition);

            //code for remove old file

            if ($request->hasFile('category_image')) {
                if (file_exists(storage_path('app/public/category_image/') . $course_category_tb->category_image)) {
                    $file_old = storage_path('app/public/category_image/') . $course_category_tb->category_image;
                    if($course_category_tb->category_image != 'category_image.jpg'){
                        unlink($file_old);
                    }
                }

                $file = $request->file('category_image');
                $category_image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->storeAs('public/category_image', $category_image);

                $course_category_tb->category_image  = $category_image;
            }

            $course_category_tb->name  = $data['name'];
            $course_category_tb->category_icon  = $data['category_icon'];

            $course_category_tb->description  = $data['description'];

            if ($course_category_tb->save()) {
                return redirect('/view_category')->with('success_message', 'Course Category was updated Successfully');
            } else {
                return redirect()->back()->with('error_message', 'An error occurred, please try again later');
            }
        } catch (Exception $e) {
            $errorsArray = [$e->getMessage()];
            return redirect()->back()->with('error_message', $errorsArray);
        }
    }

    public function soft_delete(Request $request, $id)
    {
        try {
            if (!$id) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            $delete_category = course_category_model::find($id)->delete();

            $condition = [
                ['category_id',$id],
            ];
            $delete_all_course = $this->course_model->getAllCourse($condition);

            foreach ($delete_all_course as $e) {
                $e->delete();
            }

            if (!$delete_all_course) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Category Deleted Successfully!';
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
}
