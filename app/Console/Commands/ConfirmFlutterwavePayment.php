<?php

namespace App\Console\Commands;

use App\Model\AppSettings;
use App\Model\TransactionModel;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ConfirmFlutterwavePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirm:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Confirmation of flutter wave payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TransactionModel $transactionModel, AppSettings $appSettings, User $user)
    {
        parent::__construct();
        $this->appSettings = $appSettings;
        $this->transactionModel = $transactionModel;
        $this->user = $user;

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->retrieveStatusOfBulkTransfer();
    }

    //send mail  for payment confirmation
    function sendWithdrawalRequestMail($transactionObj, $userDetails){
        //send a mail to the user
        $transactionDetails = $transactionObj;
        $transactionDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $transactionDetails['userDetails'] = $userDetails;
        Mail::to($userDetails)->send(new WithdrawalNotifier($transactionDetails));
    }

    public function retrieveStatusOfBulkTransfer(){

        try{

            //get the flutterwave details
            $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
            if($flutter_wave_details['error_code'] == 1){
                throw new Exception($flutter_wave_details['error']);
                return;
            }
            $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

            //get all the processing withdrawals
            $conditions[] = ['status', '=', 'processing'];
            $pendingWithdrawalPayment = $this->transactionModel->getAllWithConditions($conditions);
            if(count($pendingWithdrawalPayment) > 0){

                $curl = curl_init();
                ///"Content-Type: application/json"
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.flutterwave.com/v3/transfers/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $secKey"
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $results = json_decode($response, true);

                if($results['status'] !== 'success'){
                    throw new Exception($results['message']);
                    return;
                }

                $allTransfers = $results['data'];//

                foreach($pendingWithdrawalPayment as $k => $eachPendingPayment){//loops through the pending payments

                    foreach ($allTransfers as $l => $eachTransferObject) {

                        if($eachPendingPayment->unique_id === $eachTransferObject['reference']){

                            if($eachTransferObject['status'] === 'SUCCESSFUL'){

                                $amount = $eachTransferObject['amount'];
                                $eachPendingPayment->status = 'confirmed';
                                $eachPendingPayment->save();


                                //update the school balance
                                $userDetails = $this->user->getOneModel($eachPendingPayment->user_unique_id);
                                $userDetails->balance = $userDetails->balance - $eachPendingPayment->amount;
                                $userDetails->save();

                                $this->sendWithdrawalRequestMail($eachPendingPayment, $userDetails);//send mail
                            }

                        }

                    }

                }

                /*return [
                    'error_code'=>0,
                    'error'=>['pendingWithdrawalPayment'=>$pendingWithdrawalPayment, 'allTransfers'=>$allTransfers],
                    'data'=>[]
                ];*/

            }

        }catch(Exception $exception){
            /*$error = $exception->getMessage();
            return [
                'error_code'=>1,
                'error'=>$error,
                'data'=>[]
            ];*/
        }

    }
}
