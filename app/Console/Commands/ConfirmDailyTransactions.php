<?php

namespace App\Console\Commands;

use App\Model\AppSettings;
use App\Model\CurrencyRatesModel;
use App\Model\TransactionModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ConfirmDailyTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirm:dailytopup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For Confirmation of Daily Amount top Ups';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TransactionModel $transactionModel, AppSettings $appSettings, User $user, CurrencyRatesModel $currencyRatesModel)
    {
        parent::__construct();
        $this->appSettings = $appSettings;
        $this->transactionModel = $transactionModel;
        $this->user = $user;
        $this->currencyRatesModel = $currencyRatesModel;

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get the flutterwave details
        $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
        if($flutter_wave_details['error_code'] == 1){
            return;
        }
        $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

        $curl = curl_init();

        $startDate = Carbon::now()->toDateString();
        $endDate = Carbon::now()->addDays(1)->toDateString();

        /*$startDate = '2020-12-05';
        $endDate = '2020-12-06';*/

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions?from=$startDate&to=$endDate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $secKey"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;//status
        $results = json_decode($response, true);

        if($results['status'] === 'success'){
            $total_pages = $results['meta']['page_info']['total_pages'];
            $current_page = $results['meta']['page_info']['current_page'];
            $this->confirmDailyTransactions($total_pages, $current_page, $secKey, $startDate, $endDate);
        }

    }

    function confirmDailyTransactions($total_pages, $current_page, $secKey, $startDate, $endDate){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions?from=$startDate&to=$endDate&page=$current_page",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $secKey"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;//status
        $results = json_decode($response, true);

        if($results['status'] === 'success'){

            $allTopUps = $results['data'];//

            if(count($allTopUps) > 0){

                foreach($allTopUps as $k => $eachTopUps){

                    if($eachTopUps['status'] === 'pending'){//jump iteration if the transaction is still pending
                        continue;
                    }

                    $transactionObj = $this->transactionModel->getSingleRow($eachTopUps['tx_ref']);//select the transaction
                    if($transactionObj !== null){

                        if($transactionObj->status === 'pending' || $transactionObj->status === 'failed'){//check if the transaction from my database is pending

                            if($eachTopUps['status'] === 'successful'){//confirm the payment

                                //assign new values to the transaction obj
                                $transactionObj->status = 'confirmed';
                                $transactionObj->amount = $this->currencyRatesModel->getAmountForDbWithNoAuth($eachTopUps['amount'])['data']['amount'];
                                $transactionObj->reference = $eachTopUps['flw_ref'];
                                $transactionObj->save();

                                //update the user balance
                                $userDetails = $this->user->getOneModel($transactionObj->user_unique_id);
                                $userDetails->balance = $userDetails->balance + $this->currencyRatesModel->getAmountForDbWithNoAuth($eachTopUps['amount'])['data']['amount'];
                                $userDetails->save();

                                $this->sendTopupSuccessMail($transactionObj, $userDetails);//send mail

                            }

                            if($eachTopUps['status'] === 'failed'){

                                //assign new values to the transaction obj
                                $transactionObj->status = 'failed';
                                $transactionObj->amount = $this->currencyRatesModel->getAmountForDbWithNoAuth($eachTopUps['amount'])['data']['amount'];
                                $transactionObj->reference = $eachTopUps['flw_ref'];
                                $transactionObj->save();

                            }
                        }

                    }


                }

            }

        }

        //if the current page is less than the total page, call the unction again
        if($current_page < $total_pages){
            $current_page++;
            $this->confirmDailyTransactions($total_pages, $current_page, $secKey, $startDate, $endDate);
        }

    }

    //send complete reward dispensation mail
    function sendTopupSuccessMail($transactionObj, $userDetails){
        //send a mail to the user
        $transactionDetails = $transactionObj;
        $transactionDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $transactionDetails['userDetails'] = $userDetails;
        Mail::to($userDetails)->send(new FundAdditionNotifier($transactionDetails));
    }
}
