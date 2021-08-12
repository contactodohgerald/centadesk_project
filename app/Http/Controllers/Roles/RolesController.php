<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Model\RolesModel;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    use Generics;

    function __construct(RolesModel $rolesModel)
    {
        //$this->middleware('auth');
        $this->rolesModel = $rolesModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select the roles
        $allRoles = $this->rolesModel->getAllRows();
        $data = ['all_roles'=>$allRoles];
        return view('roles.all_roles', $data);//return the view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.add_roles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //validate the input
        $validate = $this->handleValidation($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }//roles_models

        //loop through the roles and add to the db
        $allRoles = $request->role;
        $allDescription = $request->description;
        $insertStatus = 0;
        $errorMessage = [];

        //check if all the values are unique
        foreach($allRoles as $k => $eachRole){
            $roleChecker = RolesModel::where('role', $eachRole)->first();
            if($roleChecker !== null){
                $errorMessage[] = $eachRole.' '.($k+1).' already exists';
            }
        }
        if(count($errorMessage) > 0){
            return Redirect::back()->withErrors(['role'=>$errorMessage]);
        }

        foreach($allRoles as $k => $eachRole){

            $unique_id = $this->createUniqueId('roles_models', 'unique_id');
            $roleObjectForInsert = $this->createObject([
                'unique_id'=>$unique_id,
                'role'=>$eachRole,
                'description'=>$allDescription[$k]
            ]);//create an object
            $rolesObject = $this->rolesModel->createRoles($roleObjectForInsert);//insert the object to db

            if($rolesObject){
                $insertStatus = 1;
            }

        }

        if($insertStatus == 1){
            return Redirect::back()->with('status', 'Role(s) was successfully added');
        }
        return Redirect::back()->with('error', 'An error occurred, please try again');

    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'role' => 'required|array',
            'role.*' => 'required|string'
        ]);

        return $validator;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
