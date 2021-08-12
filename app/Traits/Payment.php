<?php

namespace App\Traits;

trait Payment{


    function pay_with_flutterwave($redirect_url, $amount, $email, $phone, $name, $tx_ref, $currency, $consumer_id, $consumer_mac){
        $url = 'https://api.flutterwave.com/v3/payments';

// this is only part of the data you need to sen
        $customer_data = array(
            "tx_ref" => $tx_ref,
            "amount" => $amount,
            "currency"=> $currency,
            "redirect_url"=>$redirect_url,
            "payment_options"=>"card, account, banktransfer, paga, barter, mobilemoney, ussd",
            "meta" => array (
                "consumer_id" => $consumer_id,
                "consumer_mac" => $consumer_mac,
            ),
            "customer" => array (
                "email" => $email,
                "phonenumber" => $phone,
                "name" => $name,
            ),
            "customizations" => array (
                "title" => env('APP_NAME'),
                "description" => "Account Top Up",
                "logo" => $this->site_logo,
            ));
// And then encoded as a json string
        $data_string = json_encode($customer_data);
        $secKey = env('FL_KEY', 'FLWSECK_TEST-229b6298ca8ca07934ee2db37ff7750d-X');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept:application/json',
            "Authorization: Bearer $secKey",
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        $decoded_response = json_decode($result, true);

        if ($decoded_response['status'] === 'success'){
            return $decoded_response['data']['link'];
        }
        return false;
    }

    function confirmPayments($transaction_id)
    {
        $secKey = env('FL_KEY', 'FLWSECK_TEST-229b6298ca8ca07934ee2db37ff7750d-X');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$transaction_id}/verify",
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

        $decoded_response = json_decode($response, true);

        return $decoded_response;
    }

    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


}
