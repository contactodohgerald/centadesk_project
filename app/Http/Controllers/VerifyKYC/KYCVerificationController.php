<?php

namespace App\Http\Controllers\VerifyKYC;

use App\Http\Controllers\Controller;
use App\Model\KycVerification;
use App\Traits\SendMail;
use App\Models\User;
use Illuminate\Http\Request;

class KYCVerificationController extends Controller
{
    //
    use SendMail;

    function __construct(KycVerification $kycVerification, User $user){
        $this->middleware('auth', ['except' => ['KYCVerificationHandler']]);
        $this->kycVerification = $kycVerification;
        $this->user = $user;
    }

    public function listKYCForVerification(){

        $condition = [
            ['status', 'pending']
        ];

        $kycVerification = $this->kycVerification->getAllKycVerification($condition);

        foreach ($kycVerification as $each_kycVerification){
            $each_kycVerification->users;
        }

        return view('dashboard.verify_kyc', ['kycVerification'=>$kycVerification]);
    }

    public function verifyKYC($unique_id){

        $condition = [
            ['unique_id', $unique_id],
        ];
        $kyc = $this->kycVerification->getSingleKycVerification($condition);
        $kyc->users;

        return view('dashboard.verify_kyc_page', ['kyc'=>$kyc]);
    }

    public function KYCVerificationHandler(Request $request){
        $data = $request->all();

        $condition = [
            ['unique_id', $data['unique_id']]
        ];
        $kycVerification = $this->kycVerification->getSingleKycVerification($condition);

        $conditions = [
            ['unique_id', $kycVerification->user_unique_id]
        ];
        $user = $this->user->getSingleUser($conditions);

        try{

            if ($kycVerification === null){
                return response()->json(['error_code'=>1, 'error_message'=>'this user does not exist']);
            }else{
                if ($data['action'] === 'yes'){
                    $kycVerification->status = 'confirmed';
                    if($kycVerification->save()){

                        $app_name = env('APP_NAME');

                        $message = 'Your KYC Verification was recently reviewed by our team and was confirmed';

                        //write a function that sends the user an email upon successful kyc verification
                        $this->sendMails("KYC Verification", $message, $app_name, $this->base_url, $user->email);

                        return response()->json(['error_code'=>0, 'success_statement'=>'KYC was verified successfully']);
                    }else{
                        return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
                    }
                }else{
                    $kycVerification->status = 'declined';
                    if ($kycVerification->save()){

                        $user->cac_verification_status = 'no';
                        if ($user->save()){
                            $app_name = env('APP_NAME');

                            $message = 'Your KYC Verification was recently reviewed by our team of developers and was declined for not meeting our standard. Please kindly re-upload your KYC documents as explained in the KYC upload page';

                            //write a function that sends the user an email upon successful kyc verification
                            $this->sendMails("KYC Verification", $message, $app_name, $this->base_url, $user->email);

                            return response()->json(['error_code'=>0, 'success_statement'=>'KYC was declined successfully']);
                        }
                    }else{
                        return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
                    }

                }
            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }

    }
}
