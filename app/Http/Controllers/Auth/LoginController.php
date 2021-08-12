<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Traits\Generics;
use App\Models\ConfirmationCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use Generics;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ConfirmationCode $confirmationCodes)
    {
        $this->middleware('guest')->except('logout');
        $this->confirmationCodes = $confirmationCodes;
    }

    public function showLoginForm(){
        $data = $this->createArrayForView();
        if(isset($_GET['ref'])){
            $refId = trim($_GET['ref']);
            $data['refId'] = $refId;
        }

        return view('auth.login', $data);
    }    

    protected function login(Request $request){

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $users = Auth::user();

            if($users->email_verified_at === null){//check for unactivated account
                //send the user an email for activation of account and redirect the user to the page where they will enter code
                $createConfirmationCode = $this->confirmationCodes->createActivationCode($users, $type = "account-activation");

                if($createConfirmationCode['status'] === true){
                    //send the activation code via email to the user
                    $this->confirmationCodes->sendActivationMail($createConfirmationCode['data'], $users);

                    Auth::logout();

                    //redirect the user the account activation page
                    return redirect()->route('account_activation', [$users->unique_id])->with('success', 'Please provide the code that was sent to your email here')->with('email', $users->email);
                }

            }
            
            if ($users->status === 'inactive'){
                Auth::logout();
    
                return redirect()->route('complain_page');
            }
    
            if ($users->status === 'banned'){
                Auth::logout();
    
                return redirect()->back()->with('error', 'Your Account Has Been Banned, Please Contact Admin Through the Contact Us Page. We Will be Happy To be Of assistance');                
            }

            return redirect()->intended($this->redirectPath());
        }

    }
}
