<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ConfirmationCode;
use App\Models\User;
use App\Model\AppSettings;
use App\Traits\Generics;
use App\Traits\SuccessMessages;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    //
    use RegistersUsers, Generics, SuccessMessages;

    public function __construct(ConfirmationCode $confirmationCodes, AppSettings $appSettings, User $user)
    {
        $this->middleware(['guest']);
        $this->confirmationCodes = $confirmationCodes;
        $this->appSettings = $appSettings;
        $this->user = $user;
    }

    protected function create(array $data)
    {
        $now = Carbon::now()->addDays(14);

        return User::create([
            'unique_id' => $this->createUniqueId('users', 'unique_id'),
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'user_type' => $data['user_type'],
            'email' => $data['email'],
            'user_referral_id' => $this->createUniqueIdForReferral(8, 'users', 'user_referral_id'),
            'referred_id' => $data['referred_id'],
            'password' => Hash::make($data['password']),
            'account_activation_date_counter' => $now->toDateTimeString(),
        ]);
    }

    public function registerUsers(Request $request){
        try{
            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return Redirect::back()->withErrors($validation);
            }

            $user = $this->user->getAllUsers([
                ['user_referral_id', $request->referred_id]
            ]);
            
            if(count($user) > 0){

                event(new Registered($user = $this->create($request->all())));

                //send the user an email for activation of account and redirect the user to the page where they will enter code
                $createConfirmationCode = $this->confirmationCodes->createActivationCode($user, $type = "account-activation");
    
                if($createConfirmationCode['status'] === true){
                    //send the activation code via email to the user
                    $this->confirmationCodes->sendActivationMail($createConfirmationCode['data'], $user);
    
                    //redirect the user the account activation page
                    return redirect()->route('account_activation', [$user->unique_id])->with('success', $this->returnSuccessMessage('successful_registration'))->with('email', $user->email);
                }else{
                    throw new \Exception($createConfirmationCode['error']);
                }
            }else{
                return Redirect::back()->with('error', 'Please provide a valid Refrral Id');
            }
        }catch(\Exception $exception){
            return Redirect::back()->with('error',$exception->getMessage());
        }
    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6|max:10',
            'name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'user_type'=>'required',
            'referred_id'=>'required',
        ]);

        return $validator;

    }


}
