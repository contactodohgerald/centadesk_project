<?php

namespace App\Model;

use App\Model\BankCodesModel;
use App\Traits\Generics;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayBox extends Model
{
    //
    use Generics;
    function selectFlutterwave(){

        $flutterWaveDetails = PaymentGatewayBox::where('keyword', 'flutter_wave')->where('school_id', 0)->first();
        return $flutterWaveDetails;

    }

    public STATIC function recreateGatewayMangerField($each_payment_gateway){

        $exploded_gateway_manager = explode(',', $each_payment_gateway->gateway_manager);

        $exploded_gateway_manager_array = [];
        $keys = ['public_key', 'secret_key', 'encryption_key'];
        for($i = 0; $i < count($exploded_gateway_manager); $i++){

            $exploded_gateway_manager_array[$keys[$i]] = $exploded_gateway_manager[$i];

        }

        return $exploded_gateway_manager_array;

    }

    public STATIC function getFlutterWaveBankDetailsForDatabase($school_id = 0){

        $available_country_code = ['NG', 'GH', 'KE', 'UG', 'ZA', 'TZ'];

        //get the flutter wave public key
        $flutter_wave_details = PaymentGatewayBox::where('school_id', $school_id)->where('keyword', 'flutter_wave')->first();
        $flutter_wave_details_array = PaymentGatewayBox::recreateGatewayMangerField($flutter_wave_details);

        $country_bank_codes_array = [];

        //loop through the country codes and get the bank codes
        foreach($available_country_code as $k => $each_country_code){

            //get the bank details from flutter wave
            $url = 'https://api.ravepay.co/v2/banks/'.$each_country_code.'?public_key='.$flutter_wave_details_array['public_key'];

            $headers = array(
                'Content-Type: application/json'
            );
            // Open connection
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            //$body = '{}';

            //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            //curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Timeout in seconds
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            // Execute post
            $result = curl_exec($ch);

            if ($result === FALSE) {
                return [
                    'error_code'=>1,
                    'error'=>'Curl failed: ' . curl_error($ch),
                    'data'=>[]
                ];
            }

            // Close connection
            curl_close($ch);

            $results = json_decode($result);

            if(count($results->data->Banks) > 0){

                $country_bank_codes_array[$each_country_code] = $results->data->Banks;

                foreach($results->data->Banks as $bank_details){
                    //insert into db bank_codes 	bank_name 	country 	is_deleted 	deleted_at 	created_at 	updated_at

                    $particularBankDetails = BankCodesModel::where('bank_codes', $bank_details->Code)->where('type_of_gateway', 'flutterwave')->first();

                    if($particularBankDetails === null){
                        $unique_id = $this->createUniqueId('bank_codes_models', 'unique_id');
                        $bank_codes = new BankCodesModel();
                        $bank_codes->unique_id = $unique_id;
                        $bank_codes->bank_codes = $bank_details->Code;
                        $bank_codes->bank_name = $bank_details->Name;
                        $bank_codes->country = $each_country_code;
                        $bank_codes->type_of_gateway = 'flutterwave';
                        $bank_codes->is_deleted = 'no';
                        $bank_codes->deleted_at = Carbon::now()->toDateTimeString();;
                        $bank_codes->save();
                    }

                    if($particularBankDetails !== null){
                        $particularBankDetails->bank_codes = $bank_details->Code;
                        $particularBankDetails->bank_name = $bank_details->Name;
                        $particularBankDetails->country = $each_country_code;
                        $particularBankDetails->type_of_gateway = 'flutterwave';
                        $particularBankDetails->is_deleted = 'no';
                        $particularBankDetails->deleted_at = Carbon::now()->toDateTimeString();;
                        $particularBankDetails->save();
                    }

                }

            }

        }

        return [
            'error_code'=>0,
            'error'=>'',
            'data'=>$country_bank_codes_array
        ];

    }

    public STATIC function getFlutterWaveDetails(){

        //select the school details, housing the bank ddetails
        $payment_details = PaymentGatewayBox::select('gateway_manager')
            ->where('school_id', 0)
            ->where('keyword', 'flutter_wave');

        if($payment_details->count() == 0){
            return [
                'error_code'=>1,
                'error'=>'Flutter Wave is not available',
                'data'=>[]
            ];
        }

        if($payment_details->count() > 0){

            $payment_details_array = $payment_details->first();

            $gate_way_manager_fields = PaymentGatewayBox::recreateGatewayMangerField($payment_details_array);

            return [
                'error_code'=>0,
                'error'=>'Flutter Wave is not available',
                'data'=>[
                    'gate_way_manager_fields'=>$gate_way_manager_fields
                ]
            ];

        }

    }
}
