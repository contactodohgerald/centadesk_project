<?php

namespace App\Http\Controllers\Passwords;

use App\Mail\AccountActivation;
use App\Mail\PasswordResetMail;
use Carbon\Carbon;
use App\Models\User;
use App\Traits\Generics;
use App\Model\AppSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
//use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    use Generics;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.forgot-password');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function initiatePasswordReset(Request $request)
    {
        //conduct data validation
        $validator = $this->handleValidation($request->all());
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message' =>$validator->getMessageBag(),
                'data'=>[]
            ]);
        }

        $email = $request->email;
        $sendCode = $this->sendResetPasswordCode($email);
        if($sendCode['status'] === false){
            return Redirect::back()->with('error', $sendCode['message']);
        }

        if($sendCode['status'] === true){

            return redirect()->route('reset-password-area', [$email])->with('success', $sendCode['message']);

        }

    }

    function handleValidation(array $data)
    {

        $validator = Validator::make($data, [
            'email' => 'required|string',
        ]);

        return $validator;
    }


    function sendResetPasswordCode($email){

        $userDetails = User::where('email', $email)->first();
        if ($userDetails === null) {
            return [
                'status'=>false,
                'message'=> 'Email Address does not exist'
            ];
        }

        $token = $this->generateRandomNumber();
        $userDetails->remember_token = $token;
        $userDetails->forgot_timer = Carbon::now()->toDateTimeString();
        $userDetails->save();
        //send an email to users email address

        $this->sendPasswordResetMail($token, $userDetails);

        if ($userDetails) {
            return [
                'status' => true,
                'message' => 'A Password reset mail has been sent to your email address. Please check your email address and provide code to be able to change your password.'
            ];
        }

    }

    //send the email to the user involved
    function sendPasswordResetMail($token, $userObject){
        $appSettings = new AppSettings();
        $userObject['settings'] = $appSettings->getSingleModel();
        $userObject['code'] = $token;
        Mail::to($userObject)->send(new PasswordResetMail($userObject));
    }

    /**
     * resend the password reset code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendPasswordResetCode($username)
    {

        $sendCode = $this->sendResetPasswordCode($username);
        if ($sendCode['status'] === false) {
            return Redirect::back()->with('error', $sendCode['message']);
        }

        if ($sendCode['status'] === true) {
            return redirect()->route('reset-password-area', [$username])->with('success', $sendCode['message']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showResetPasswordPage($username)
    {
        return view('auth.reset-password', ['username'=> $username]);
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

    function verifyToken(Request $request): \Illuminate\Http\JsonResponse{
        
        $token = $request->token_;
        $email = $request->email;

        //conduct data validation
        $validator = $this->handleValidation($request->all());
        if($validator->fails()){
            return response()->json($validation->getMessageBag());
        }

        //check if the token is same with what was supplied
        $tokenValidation = User::where('remember_token', $token)->where('email', $email)->first();

        //send the error message
        if($tokenValidation === null){
            return response()->json(['status'=>false, 'error_message'=> 'Invalid Token Supplied']);
        }

        //check for expiration
        $createdTimePlusTenMinutes = Carbon::parse($tokenValidation->forgot_timer)->addMinutes(10)->toDateTimeString();
        $now = Carbon::now()->toDateTimeString();
        if($createdTimePlusTenMinutes < $now){
            return response()->json(['status'=>false, 'error_message'=> 'Supplied Token has expired']);
        }
        
        //send a success message
        return response()->json(['status'=>true, 'success_message'=> 'Valid Token']);
    }

    function handleTokenValidation(array $data)
    {

        $validator = Validator::make($data, [
            'token_' => 'required|numeric',
            'username' => 'required|string',
        ]);

        return $validator;
    }


    //get the login code for a user
    function validateForMessageSending($username)
    {

        $userDetails = User::where('email', $username)->first();
        if($userDetails === null){
            return response()->json(['status'=>false, 'error_message'=> 'User not found']);
        }

        if ($userDetails !== null) {
            $appSettings = new AppSettings();
            $settings = $appSettings->getSingleModel();
            $siteName = $settings->site_name;

            $api_key = env('SMS_SECRET', 'mdLcSDILeVMX6PFDUOmB62URpcCbJwJiY0TIFAolMARXvR28dAeM6HVhCTOI');

            $message = 'Hi ' . $userDetails->name . ', A password reset request have been made on your ' . $settings->site_name . ' account. Please enter code below to continue : ' . $userDetails->remember_token.'. Code expires in 10minutes.';

            $url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=$api_key&from=$siteName&to=$userDetails->phone&body=$message&dnd=2";
            return response()->json(['status' => true, 'data' => $url]);
        }

    }


    //authentiicate and enable the user change
    function changeUserPassword(Request $request): \Illuminate\Http\JsonResponse{//

        $validator = $this->handlePasswordChangeValidation($request->all());
        if ($validator->fails()) {
            return response()->json($validation->getMessageBag());
        }

        //process the password change
        //check if the token is same with what was supplied where('remember_token', $request->token_)->
        $tokenValidation = User::where('email', $request->email)->first();
        //send the error message
        if ($tokenValidation === null) {
            return response()->json(['status'=>false, 'error_message'=> 'Invalid Token Supplied']);
        }

        //check for expiration
        $createdTimePlusTenMinutes = Carbon::parse($tokenValidation->forgot_timer)->addMinutes(10)->toDateTimeString();
        $now = Carbon::now()->toDateTimeString();
        if ($createdTimePlusTenMinutes < $now) {
            return response()->json(['status'=>false, 'error_message'=> 'Supplied Token have expired']);
        }

        //update the new password
        $tokenValidation->password = Hash::make($request->password);
        $tokenValidation->remember_token = null;
        if($tokenValidation->save()){
            //send a success message
            return response()->json(['status'=>true, 'error_message'=> 'Password have been changed successfully']);
        }

    }


    function handlePasswordChangeValidation(array $data)
    {

        $validator = Validator::make($data, [
            //'token_' => 'required|numeric',
            'password' => 'required|confirmed|min:6|max:10',
            'email' => 'required|string'
        ]);

        return $validator;
        
    }

}