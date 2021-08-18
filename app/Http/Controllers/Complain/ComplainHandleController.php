<?php

namespace App\Http\Controllers\Complain;

use App\Http\Controllers\Controller;
use App\Model\AccountResolve;
use App\Traits\SendMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainHandleController extends Controller
{
    //
    use SendMail;

    function __construct(AccountResolve $accountResolve, User $user)
    {
        $this->middleware('auth');
        $this->accountResolve = $accountResolve;
        $this->user = $user;
    }

    public function complainListForAdmin(){

        $complains = $this->accountResolve->getAllOfComplain([
            ['status', 'pending'],
            ['ignore_status', 'no'],
        ]);

        foreach ($complains as $each_complains){

            $each_complains->users;

        }
      
        return view('dashboard.all_compalins', ['complains'=>$complains]);

    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'unique_id' => 'required',
        ]);

    }

    public function activateUserAccount(Request $request){

        try{
            $this->Validator($request);//validate fields

            $condition = [
                ['unique_id', $request->unique_id]
            ];

            $complain = $this->accountResolve->getSingleOfComplain($condition);

            $conditions = [
                ['unique_id', $complain->user_unique_id]
            ];

            $user = $this->user->getSingleUser($conditions);

            if ($user === null || $user === ''){

                return redirect('/complain_list')->with('error_message', 'Account Could Not Be Activated, Please Try At A Later Time');

            }else{

                $user->status = 'active';

                if ($user->save()){

                    $complain->status = 'success';
                    $complain->save();

                    $app_name = env('APP_NAME');

                    $message = 'We the entire team of '.$app_name.' is please to announce to you that your '.$app_name.' account has been activated, we hope your stay and experience on our platform is as smooth and hassle free as possible. Login in to your '.$app_name.' to start enjoying unlimited offers';

                    //write a function that sends the user an email upon account activation
                    $this->sendMails("Account Activation", $message, $app_name, $this->base_url, $user->email);

                    return redirect('/complain_list')->with('success_message', 'Account Was Activated Successfully');

                }else{

                    return redirect('/complain_list')->with('error_message', 'An Error occurred, Please try Again Later');

                }

            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('/complain_list')->with('error_message', $errorsArray);

        }

    }

    public function ignoreAccountActivateRequest(Request $request){

        try{
            $this->Validator($request);//validate fields

            $condition = [
                ['unique_id', $request->unique_id]
            ];

            $complain = $this->accountResolve->getSingleOfComplain($condition);


            if ($complain === null || $complain === ''){

                return redirect('/complain_list')->with('error_message', 'Request Could Not Be Ignored At This Time, Please Try At A Later Time');

            }else{

                $complain->ignore_status = 'yes';

                if ($complain->save()){

                    return redirect('/complain_list')->with('success_message', 'Account Activate Request Was Successfully Ignored');

                }else{

                    return redirect('/complain_list')->with('error_message', 'An Error occurred, Please try Again Later');

                }

            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('/complain_list')->with('error_message', $errorsArray);

        }

    }
}
