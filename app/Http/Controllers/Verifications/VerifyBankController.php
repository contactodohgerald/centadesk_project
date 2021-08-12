<?php

namespace App\Http\Controllers\Verifications;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyBankController extends Controller
{
    //
    use Generics;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index()
    {
        return view('verifications.bank_verification');
    }

    public function verifyBank(Request $request)
    {
        return $request;
        $bank_code = $request->bank_user;
        $account_number = $request->account_number_user;
        $response = $this->nubanVerify($account_number, $bank_code);


        if ($response) {
            //update users data
            return response()->json($response);
        } else {
            return response("failed");
        }
    }

    public function addBank(Request $request){
        $user = Auth::user();
        $request->unique_id = $user->unique_id;
        //$request->name = $request->account_name;
        $add_bank = $this->user->updateUserModel($request);

        if($add_bank){
            return response()->json(['data'=> $add_bank, 'status' => 1]);
        }
    }

    public function nubanVerify($account_number = '', $bank_code = '')
    {
        $ch = curl_init();
        $query = http_build_query([
            'bank_code' => $bank_code,
            'acc_no' => $account_number
        ]);
        $url = "https://app.nuban.com.ng/api/NUBAN-IFQGEDVI173";
        $getUrl = $url . "?" . $query;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            echo 'Request Error:' . curl_error($ch);
            return false;
        } else {
            return $response;
        }

        curl_close($ch);
        //function ends here
    }
}
