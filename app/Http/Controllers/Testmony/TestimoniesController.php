<?php

namespace App\Http\Controllers\Testmony;

use App\Http\Controllers\Controller;
use App\Model\TestimonyModel;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimoniesController extends Controller
{
    //
    use Generics;

    function __construct(TestimonyModel $testimonyModel){
        $this->testimonyModel = $testimonyModel;
    }

    public function showTestimonies(){
        $testimonys = $this->testimonyModel->getAllTestimony();
        return view('front_end.testimonies', ['testimonys'=>$testimonys]);
    }

    public function createTestimony(){
        return view('dashboard.testimony');
    }

    protected function Validator($request)
    {

        $this->validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'message' => 'required',
        ]);
    }

    public function storeNewTestimony(Request $request){
        // full_name message
        $data = $request->all();

        try {
            $this->Validator($request); //validate fields

            $unique_id = $this->createUniqueId('testimony_models', 'unique_id');
            $testimony = new TestimonyModel();
            $testimony->unique_id = $unique_id;
            $testimony->user_name = $data['full_name'];
            $testimony->message = $data['message'];

            if ($testimony->save()) {
                return redirect('/add-testimonies')->with('success_message', 'Testimony Was Successfully Updated');
            } else {
                return redirect('/add-testimonies')->with('error_message', 'An Error occurred, Please try Again Later');
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('add-testimonies')->with('error_message', $errorsArray);
        }

    }
}
