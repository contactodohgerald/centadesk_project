<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Model\GalleryModel;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    //
    use Generics;
    function __construct(GalleryModel $galleryModel){
        $this->middleware('auth',  ['except' => ['storeGallery', 'deleteGallery']]);
        $this->galleryModel = $galleryModel;
    }

    public function createGalleryInterface(){

        return view('dashboard.create_gallery');

    }
    
    public function galleryList(){

        $galleryModel = $this->galleryModel->getAllGallery([
            ['status', 'pending'],
        ]);
        foreach($galleryModel as $each_gallery){
            $each_gallery->users;
        }
        $view = [
            'galleryModel'=>$galleryModel,
        ];
        return view('dashboard.view_gallery', $view);

    }

    function handleValidation(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'title' => 'required',
        ]);
    }

    public function storeGallery(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $gallery_image = null;
    
        try{
            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            } 

            if ($request->hasFile('cover_img')) {

                $image = $request->file('cover_img');
                $gallery_image = md5($image->getClientOriginalName() . time()).'.'.$image->getClientOriginalExtension();
             
                $destinationPath = storage_path('app/public/gallery_image');
                $img = Image::make($image->getRealPath());
                $img->resize(382, 382, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$gallery_image);
            }

            $unique_id = $this->createUniqueId('gallery_models', 'unique_id');
            $gallery = new GalleryModel();

            $gallery->unique_id = $unique_id;
            $gallery->gallery_title = $data['title'];
            $gallery->gallery_image = $gallery_image;
            $gallery->user_unique_id = $data['userUniqueId'];

            if($gallery->save()){
                return response()->json(['error_code'=>0, 'success_statement'=>'Gallery was saved successfully!']);
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
    public function deleteGallery(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $validation = $this->handleTransferValidations($request->all());
            if ($validation->fails()) {
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $dataArray = explode('|', $request->dataArray);

            foreach ($dataArray as $eachDataArray) {

                $galleryModel = $this->galleryModel->selectSingleGallery($eachDataArray);
                
                $galleryModel->delete();
            }
            return response()->json(['error_code' => 0, 'success_statement' => 'Selected gallery was successfully deleted ']);

        } catch (Exception $exception) {

            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);

        }
    }

}
