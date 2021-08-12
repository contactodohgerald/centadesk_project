<?php

namespace App\Http\Controllers;

use App\course_model;
use App\priceModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\Generics;
use App\Traits\appFunction;

class priceController extends Controller
{
    use Generics;
    use appFunction;

    function __construct(priceModel $priceModel, course_model $course_model)
    {
        $this->middleware('auth');
        $this->priceModel = $priceModel;
        $this->course_model = $course_model;
    }

    // function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $priceModel = $this->priceModel->getAllPricing();

        return view('dashboard.view-prices', ['priceModel' => $priceModel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.create_price');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:20',
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/create_price')->with('error_message', $validator->errors());
            }

            $pricing = new priceModel();
            $unique_id = $this->createUniqueId('price_tb', 'unique_id');
            $pricing->unique_id = $unique_id;
            $pricing->title = $data['title'];
            $pricing->amount = $data['amount'];

            if ($pricing->save()) {
                return redirect('/create_price')->with('success_message', 'Course Price was created Successfully');
            } else {
                return redirect('/create_price')->with('error_message', 'An error occurred, please try again later');
            }
        } catch (Exception $e) {

            $errorsArray = [$e->getMessage()];
            return redirect('/create_price')->with('error_message', $errorsArray);
        }
    }

    public function show_edit($unique_id)
    {
        $condition = [
            ['unique_id', $unique_id]
        ];

        $price = $this->priceModel->getSinglePricing($condition);

        // print_r($price);die();
        return view('dashboard.edit_price', ['price' => $price]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:20',
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            $data = $request->all();

            $pricing = priceModel::find($id);
            $pricing->title = $data['title'];
            $pricing->amount = $data['amount'];

            if ($pricing->save()) {
                $error = 'Pricing was updated Successfully!';
                return response()->json(["message" => $error, 'status' => true]);
            } else {
                throw new Exception($this->errorMsgs(14)['msg']);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    public function soft_delete(Request $request, $id)
    {
        try {
            if (!$id) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            $delete_price = priceModel::find($id)->delete();

            $condition = [
                ['pricing',$id],
            ];
            $delete_all_course = $this->course_model->getAllCourse($condition);

            foreach ($delete_all_course as $e) {

                $e->delete();
            }

            if (!$delete_all_course) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Price Deleted Successfully!';
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
