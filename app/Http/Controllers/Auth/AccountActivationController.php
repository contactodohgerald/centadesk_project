<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ConfirmationCode;
use App\Models\User;
use App\Traits\SuccessMessages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountActivationController extends Controller
{
    use SuccessMessages;

    function __construct(User $user, ConfirmationCode $confirmationCodes)
    {
        $this->user = $user;
        $this->confirmationCodes = $confirmationCodes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendActivationCode($userId, $type)
    {
        $userObject = User::where([
            ['unique_id', '=', $userId]
        ])->first();

        if($userObject === null){
            return Redirect::back()->with('error', 'User was not found');
        }

        //send the user an email for activation of account and redirect the user to the page where they will enter code
        $createConfirmationCode = $this->confirmationCodes->createActivationCode($userObject, $type);

        //send the activation code via email to the user
        $this->confirmationCodes->sendActivationMail($createConfirmationCode['data'], $userObject);

        return redirect()->route('account_activation', [$userObject->unique_id])->with('success', $this->returnSuccessMessage('successful_registration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accountActivationPage($userId)
    {
        return view('auth.account_activation', ['user_id'=>$userId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyAndActivateAccount(Request $request, $typeOfCode, $userId)
    {
        //get the user object
        $userObject = $this->user::where([
            ['unique_id', '=', $userId]
        ])->first();

        if($userObject === null){
            return Redirect::back()->with('error', 'User was not found');
        }

        //verify the token
        $tokenVerification = $this->confirmationCodes->verifyTokenValidity($request->token, $typeOfCode, $userObject);

        if($tokenVerification['status'] === false){
            return Redirect::back()->with('error', $tokenVerification['message']);
        }

        //activation was successful, activate the user account
        $userObject->email_verified_at = Carbon::now()->toDateTimeString();
        if($userObject->save()){
            return redirect()->route('login')->with('success', 'Your account have been successfully verified, please login to continue');
        }
        return Redirect::back()->with('success', 'An error occurred, please try again');
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
