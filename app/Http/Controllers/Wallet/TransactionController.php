<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Model\PaymentGatewayBox;
use App\Model\TransactionModel;
use App\Traits\Generics;
use App\Traits\Payment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    //
    use Generics, Payment;

    function __construct(TransactionModel $transactionModel, User $user)
    {
        $this->middleware('auth', ['except' => ['handleTransfers', 'markWithdrawalsAsPaid']]);
        $this->transactionModel = $transactionModel;
        $this->user = $user;
    }

    public function myTransaction()
    {

        $userDetails = Auth::user();

        if ($userDetails->user_type === 'admin' || $userDetails->user_type === 'super_admin') {

            $condition = [
                ['action_type', 'top_up'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['action_type', 'top_up'],
                ['status', 'failed'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['action_type', 'top_up'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        } else {
            $condition = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'top_up'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'top_up'],
                ['status', 'failed'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'top_up'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        }

        foreach ($transaction as $each_transaction){
            $each_transaction->users;
        }
        foreach ($pending_transaction as $each_pending_transaction){
            $each_pending_transaction->users;
        }
        foreach ($successful_transaction as $each_successful_transaction){
            $each_successful_transaction->users;
        }

        $data = ['transaction' => $transaction, 'pending_transaction' => $pending_transaction, 'successful_transaction' => $successful_transaction, 'userDetails' => $userDetails, 'dates' => 'ALL'];
        
        return view('dashboard.my_wallet', $data);
    }

    public function showTransactionByDate(Request $request)
    {

        $userDetails = Auth::user();

        if ($userDetails->user_type === 'admin' || $userDetails->user_type === 'super_admin') {

            $condition = [
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'top_up'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'top_up'],
                ['status', 'failed'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'top_up'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        } else {
            $condition = [
                ['user_unique_id', $userDetails->unique_id],
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'top_up'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['user_unique_id', $userDetails->unique_id],
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'top_up'],
                ['status', 'failed'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['user_unique_id', $userDetails->unique_id],
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'top_up'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        }

        $data = ['transaction' => $transaction, 'pending_transaction' => $pending_transaction, 'successful_transaction' => $successful_transaction, 'userDetails' => $userDetails, 'dates' => $request->start_date . ' TO ' . $request->end_date];

        return view('dashboard.my_wallet', $data);
    }

    public function showTopUpTransaction($unique_id = null)
    {

        $userDetails = Auth::user();

        $condition = [
            ['unique_id', $unique_id]
        ];

        $transactions = $this->transactionModel->getSingleTransaction($condition);

        return view('dashboard.transaction_history', ['userDetails' => $userDetails, 'transactions' => $transactions]);
    }

    protected function Validator($request)
    {

        $this->validator = Validator::make($request->all(), [
            'topUpAmount' => 'required',
        ]);
    }

    public function topUpWallet(Request $request)
    {

        $user_details = Auth::user();

        try {
            $this->Validator($request); //validate fields

            $user_unique_id = $user_details->unique_id;

            $user_full_name = $user_details->name . ' ' . $user_details->last_name;

            $user_preferred_currency = $user_details->getBalanceForView()['data']['currency'];
            
            $inputed_amount = $request->topUpAmount;
           
            $unique_id = $this->createUniqueId('transaction_models', 'unique_id');
            $request = $user_details;
            $request->unique_id = $unique_id;
            $request->user_unique_id = $user_unique_id;
            $request->type_of_user = $user_details->user_type;
            $request->country = $user_details->country;
            $request->customer = $user_full_name;
            $request->biller_name = $user_full_name;
            $request->currency = $user_preferred_currency;
            $request->reference = $unique_id;
            $request->amount = $inputed_amount;
            $request->description = 'Wallet Top Up';
            $request->action_type = 'top_up';
            $request->top_up_option = 'flutterwave';
            $request->status = 'pending';

            $newTransactionDetails = $this->transactionModel->insertIntoTransactionModel($request);

            if ($newTransactionDetails) {

                $ipaddress = $this->get_client_ip();
              
                $pay_with_flutterwave = $this->pay_with_flutterwave($this->base_url. "/confirm_top_up", $inputed_amount, $user_details->email, $user_details->phone, $user_full_name, $unique_id, $user_preferred_currency, $user_details->id, $ipaddress);

                return redirect()->to($pay_with_flutterwave);
            } else {
                return redirect('/my_balance')->with('error_message', 'An Error occurred, Please try Again Later');
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('/my_balance')->with('error_message', $errorsArray);
        }
    }

    public function confirmUserPayments()
    {

        $transaction_id = $_GET['transaction_id'];
        $tx_ref = $_GET['tx_ref'];
        $status = $_GET['status'];

        if ($status === 'successful') {

            $decoded_response = $this->confirmPayments($transaction_id);

            if ($decoded_response['status'] === 'success') {

                if ($decoded_response['data']['tx_ref'] != $tx_ref) {
                    return redirect('/my_balance')->with('error_message', 'Transaction Confirmation Was Not Successful, An Error Occurred');
                }

                $condition = [
                    ['unique_id', $decoded_response['data']['tx_ref']]
                ];

                $transactionModel = $this->transactionModel->getSingleTransaction($condition);

                $conditions = [
                    ['unique_id', $transactionModel->user_unique_id],
                ];

                $user = $this->user->getSingleUser($conditions);

                $convertedPrice = $this->calculateExchangeRate($user, $transactionModel->amount, $type_of_action = 'sending_to_view');

                // $round_up_amount =  round($convertedPrice['data']['amount']);

                // $returned_amount = $decoded_response['data']['amount'];

                //display error
                if ($returned_amount != $transactionModel->amount || $returned_amount > $transactionModel->amount) {
                    $transactionModel->status = 'failed';
                    $transactionModel->save();
                    return redirect('/my_balance')->with('error_message', 'Amount Paid Is Not Equal To Actual Price');
                }

                if ($decoded_response['data']['currency'] !== $transactionModel->currency) {
                    $transactionModel->status = 'failed';
                    $transactionModel->save();
                    return redirect('/my_balance')->with('error_message', 'Currency Is Not Equal To That Of The Actual Price');
                }

                //update the PayForBookByUser table
                $transactionModel->flw_ref = $decoded_response['data']['flw_ref'];
                $transactionModel->status = 'confirmed';
                $transactionModel->account_token = $decoded_response['data']['account']['account_token'];
                $transactionModel->consumer_id = $decoded_response['data']['meta']['consumer_id'];
                $transactionModel->consumer_mac = $decoded_response['data']['meta']['consumer_mac'];
                $transactionModel->amount_settled = $decoded_response['data']['amount_settled'];
                $transactionModel->device_fingerprint = $decoded_response['data']['device_fingerprint'];
                $transactionModel->save();

                $add_to_user_balance = $user->balance + $transactionModel->amount;

                $user->balance = $add_to_user_balance;
                $user->save();

                return redirect('/my_balance')->with('success_message', 'The sum of ' . $transactionModel->amount . '(' . $transactionModel->currency . ')' . ' was successfully added to your account');
            } else {
                return redirect('/my_balance')->with('error_message', 'Payment Was Not Verified, An Error Occurred');
            }
        }
    }

    function handleTransferValidation(array $data)
    {

        $validator = Validator::make($data, [
            'withdrawalId' => 'required|string'
        ]);

        return $validator;
    }

    function handleTransfers(Request $request)
    {

        try {

            $validation = $this->handleTransferValidation($request->all());
            if ($validation->fails()) {
                //return Redirect::back()->withErrors($validation->messages());
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $bulk_data = [];

            $withdrawalId = explode('|', $request->withdrawalId);

            foreach ($withdrawalId as $k => $eachWithdrawalId) {

                $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachWithdrawalId);

                $withdrawalDetails->users;

                if ($withdrawalDetails === null) {
                    throw new Exception('Withdrawal could not be found!');
                    return;
                }

                if ($withdrawalDetails->amount > $withdrawalDetails->users->balance) {
                    throw new Exception('Insufficient Balance, Amount cannot be withdrawn!');
                    return;
                }
                if ($withdrawalDetails->status === 'confirmed') {
                    throw new Exception('Withdrawal at line ' . ($k + 1) . ' have already been processed before');
                    return;
                }

                $bulk_data[] = [
                    "bank_code" => $withdrawalDetails->users->bank_code,
                    "account_number" => $withdrawalDetails->users->account_number,
                    "amount" => $withdrawalDetails->amount * $withdrawalDetails->users->currency_details->rate_of_conversion,
                    "currency" => $withdrawalDetails->users->currency_details->second_currency,
                    "narration" => $withdrawalDetails->description,
                    "reference" => $withdrawalDetails->unique_id
                ];
            }

            if (count($bulk_data) > 0) {

                $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();

                if ($flutter_wave_details['error_code'] == 1) {
                    throw new Exception($flutter_wave_details['error']);
                    return;
                }
                $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

                $payment_data = [
                    "title" => env('APP_NAME') . ' Payment',
                    "bulk_data" => $bulk_data,
                ];

                $response = $this->commencePayment($payment_data, $secKey);

                if ($response['error_code'] == 1) {
                    throw new Exception($response['error']);
                    return;
                }

                //loop through and update payments to processing
                foreach ($withdrawalId as $k => $eachWithdrawalId) {
                    $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachWithdrawalId);
                    $withdrawalDetails->status = 'processing';
                    $withdrawalDetails->save();
                }

                $this->retrieveStatusOfBulkTransfer();

                //return Redirect::back()->with('success_message', $response['payment_response']['message']);
                return response()->json(['error_code' => 0, 'success_message' => $response['data']['payment_response']['message'], 'data' => $response['data']['payment_response']]);
            }
        } catch (Exception $exception) {

            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);
            //return Redirect::back()->with('error_message', $error);

        }
    }

    public function commencePayment($post_data, $secKey)
    {

        $data_string = json_encode($post_data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/bulk-transfers/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $secKey"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($resp['status'] === 'success') {
            return [
                'error_code' => 0,
                'error' => '',
                'data' => [
                    'payment_response' => $resp
                ]
            ];
        }

        return [
            'error_code' => 1,
            'error' => 'Payment processing failed',
            'data' => []
        ];
    }

    public function retrieveStatusOfBulkTransfer()
    {

        try {

            //get the flutterwave details
            $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
            if ($flutter_wave_details['error_code'] == 1) {
                throw new Exception($flutter_wave_details['error']);
                return;
            }
            $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

            //get all the processing withdrawals
            $conditions[] = ['status', '=', 'pending'];
            $pendingWithdrawalPayment = $this->transactionModel->getAllWithConditions($conditions);
            if (count($pendingWithdrawalPayment) > 0) {

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

                if ($results['status'] !== 'success') {
                    throw new Exception($results['message']);
                    return;
                }

                $allTransfers = $results['data']; //

                foreach ($pendingWithdrawalPayment as $k => $eachPendingPayment) { //loops through the pending payments

                    foreach ($allTransfers as $l => $eachTransferObject) {

                        if ($eachPendingPayment->unique_id === $eachTransferObject['reference']) {

                            if ($eachTransferObject['status'] === 'SUCCESSFUL') {

                                $amount = $eachTransferObject['amount'];
                                $eachPendingPayment->payment_status = 'confirmed';
                                $eachPendingPayment->save();

                                //update the school balance
                                $userDetails = $this->user->getOneModel($eachPendingPayment->user_unique_id);
                                $userDetails->balance = $userDetails->balance - $eachPendingPayment->amount;
                                $userDetails->save();
                            }
                        }
                    }
                }

                return [
                    'error_code' => 0,
                    'error' => ['pendingWithdrawalPayment' => $pendingWithdrawalPayment, 'allTransfers' => $allTransfers],
                    'data' => []
                ];
            }
        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return [
                'error_code' => 1,
                'error' => $error,
                'data' => []
            ];
        }
    }

    function handleTransferValidations(array $data)
    {

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;
    }

    public function markWithdrawalsAsPaid(Request $request)
    {
        try {

            $validation = $this->handleTransferValidations($request->all());
            if ($validation->fails()) {
                //return Redirect::back()->withErrors($validation->messages());
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $dataArray = explode('|', $request->dataArray);

            foreach ($dataArray as $eachDataArray) {

                //update the withdrawal status to confirmed
                $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachDataArray);
                $withdrawalDetails->status = 'confirmed';
                $withdrawalDetails->save();

                $withdrawalDetails->users;

                $withdrawalDetails->users->balance = $withdrawalDetails->users->balance - $withdrawalDetails->amount;
                $withdrawalDetails->users->save();
            }
            return response()->json(['error_code' => 0, 'success_statement' => 'Selected Withdrawals have been marked as paid']);
            // return ['error_code'=>1, 'error_message'=>'An error occurred, please try again'];

        } catch (Exception $exception) {

            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);
            //return Redirect::back()->with('error_message', $error);

        }
    }

    function handleDeleteValidations(array $data)
    {

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;
    }

    public function deleteTransactions(Request $request)
    {
        try {

            $validation = $this->handleDeleteValidations($request->all());
            if ($validation->fails()) {
                //return Redirect::back()->withErrors($validation->messages());
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $dataArray = explode('|', $request->dataArray);

            foreach ($dataArray as $eachDataArray) {

                //update the withdrawal status to confirmed
                $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachDataArray);
                $withdrawalDetails->delete();
            }
            return response()->json(['error_code' => 0, 'success_statement' => 'Selected transaction was deleted successfully']);

        } catch (Exception $exception) {

            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);
        }
    }
}
