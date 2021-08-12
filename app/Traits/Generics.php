<?php

namespace App\Traits;

use App\Model\CurrencyRatesModel;
use App\Model\TransactionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


trait Generics{


    function createObject($array){
        return json_decode(json_encode($array));
    }

    function getAppSettings(){
        $user = null;
        if (Auth::check()) { $user = User::where('unique_id', Auth::user()->unique_id)->first(); }
        $appSettings = new \App\Model\AppSettings();
        $Settings = $appSettings->getSingleModel();
        return [
            'active8'=>'active',
            'title' => 'Register | Earnif Affliate Programme',
            'site_description' => env('APP_NAME').' is an affliate program that helps you earn commision for being an affliater',
            'keywords' => 'Affliate, Programme, Earnif, Referral, Investment, Nigeria, Enugu, Anambra, Lagos',
            'siteName' => $Settings->site_name,
            'siteDomain' => $Settings->site_url,
            'sitePhone' => $Settings->phone1,
            'sitePhone1' => $Settings->phone2,
            'siteEmail' => $Settings->email1,
            'siteEmai2' => $Settings->email2,
            'siteAddress' => $Settings->address1,
            'siteAddress1' => $Settings->address2,
            'siteFacebook' => $Settings->facebook,
            'siteTwitter' => $Settings->twitter,
            'siteInstagram' => $Settings->instagram,
            'siteLinkedin' => $Settings->linkedin,
            'affiliateCommission' => $Settings->affiliate_commission,
            'normalCompanyComission' => $Settings->normal_company_comission,
            'companyComissionForProductElsewhere' => $Settings->company_comission_for_product_elsewhere,
            'baseurl' => env('APP_URL'),
            'currencyArray'=>['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN',
            'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZAR'],
            'countryCodeArray'=>['BI', 'CA', 'DR', 'CV', 'EU', 'GB', 'GH', 'GM', 'GN', 'KE', 'LRD', 'MWK', 'MZN',
            'NG', 'RW', 'SL', 'ST', 'TZ', 'UG', 'US', 'XA', 'XO', 'ZM', 'ZM', 'ZW', 'ZA'],
            'user'=>$user
        ];
   
    }

    public function random_string ( $type = 'alnum', $len = 20 ){
        switch ( $type )
        {
            case 'alnum'	:
            case 'numeric'	:
            case 'nozero'	:

                switch ($type)
                {
                    case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric'	:	$pool = '0123456789';
                        break;
                    case 'nozero'	:	$pool = '123456789';
                        break;
                }

                $str = '';
                $mdstr = md5 ( uniqid ( mt_rand () ) );
                $mdstrstrlen = strlen($mdstr);
                for ( $i=0; $i < $len; $i++ )
                {
                    $str .= substr ( $pool, mt_rand ( 0, strlen ( $pool ) -1 ), 1 );
                }
                return $str.substr($mdstr, 0, $mdstrstrlen/2);
                break;
            case 'unique' : return md5 ( uniqid ( mt_rand () ) );
                break;
        }
    }

    //create a unique id
    public function createUniqueId($table_name, $column){

        /*$unique_id = Controller::picker();*/
        $unique_id = $this->random_string();

        //check for the database count from the database"unique_id"
        $rowcount = DB::table($table_name)->where($column, $unique_id)->count();

        if($rowcount == 0){

            if(empty($unique_id)){
                $this->createUniqueId($table_name, $column);
            }else{
                return $unique_id;
            }

        }else{
            $this->createUniqueId($table_name, $column);
        }

    }

    
    function createArrayForView($dataToBePassedToView = [], $status = 'success'){
        $data = $this->getAppSettings();
        if(count($dataToBePassedToView)  > 0){
            foreach($dataToBePassedToView as $k => $values){
                $data[$k] = $values;
            }
        }
        $data['status'] = $status === 'error' ? false : true;
        return $data;
    }

    function hashPassword($password){
        return hash('sha256', md5($password));
    }

    function returnCurrencyArray(){

        return ['currencyArray'=>['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN',
            'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZAR'],
         'countryCodeArray'=>['BI', 'CA', 'DR', 'CV', 'EU', 'GB', 'GH', 'GM', 'GN', 'KE', 'LRD', 'MWK', 'MZN',
            'NG', 'RW', 'SL', 'ST', 'TZ', 'UG', 'US', 'XA', 'XO', 'ZM', 'ZM', 'ZW', 'ZA']];

    }

    public  function createUniqueIdForReferral($length, $table_name, $column){

        $unique = $this->create8randomNumberAndString($length);

        //check for the database count from the database"unique_id"
        $rowcount = DB::table($table_name)->where($column, $unique)->count();

        if($rowcount == 0){
            return $unique;
        }else{
            $this->createUniqueIdForReferral($length, $table_name, $column);
        }
    }

    public  function create8randomNumberAndString($length){
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "123456123456789071234567890890";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; // if you need alphabetic also

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;

    }

    //get the currency exchange rate
    public function calculateExchangeRate($userObject, $amount_sent_in = 0, $type_of_action = 'sending_to_view'){
        //base currency is EUR
        //$type_of_action = ('sending_to_view', 'sending_to_db')

        $choosen_currency_id = $userObject->preferred_currency;

        //select the currency
        $currency_details = CurrencyRatesModel::find($choosen_currency_id);
        $rate = $currency_details->rate_of_conversion;

        //$type_of_action = ('sending_to_view', 'sending_to_db')
        if($type_of_action === 'sending_to_view'){
            //die($amount_sent_in);
            //1EUR = $rate for choosen currency
            //$amount_sent_in EUR = ?
            $amount = $amount_sent_in * $rate;
            //$amount = round($amount);
        }

        if($type_of_action === 'sending_to_db'){
            //1EUR = $rate for choosen currency
            //? EUR   =  $amount_sent_in;
            $amount = $amount_sent_in / $rate;
            //$amount = round($amount);
        }

        return [
            'error_code'=>0,
            'error'=>'',
            'data'=>[
                'amount'=>$amount,
                'currency'=>$currency_details->second_currency,
                'currency_id'=>$currency_details->id
            ]
        ];

    }

    function getAmountForView($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = $this->calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_view');
        return $amountDetails;

    }

    function getAmountForDatabase($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = $this->calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_db');
        return $amountDetails;

    }

    function getAllTransactionAmount($condition){

        $transactionModel = TransactionModel::where($condition)->sum('amount');

        return $transactionModel;

    }

    function getAmountForNotLoggedInUser($amount_sent_in = 0){
        //select the currency
        $currency_details = CurrencyRatesModel::find(50);
        $rate = $currency_details->rate_of_conversion;

        return $amount_sent_in * $rate;

    }

    public function commencePayment($post_data, $secKey){

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
            CURLOPT_POSTFIELDS =>$data_string,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $secKey"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if($resp['status'] === 'success'){
            return [
                'error_code'=>0,
                'error'=>'',
                'data'=>[
                    'payment_response'=>$resp
                ]
            ];
        }

        return [
            'error_code'=>1,
            'error'=>'Payment processing failed',
            'data'=>[]
        ];

    }

    function validateImage($acceptedFileType = ['jpeg','jpg','png','gif','webp'], $fileName = []){
        $errorMessage = [];
        if(count($fileName) > 0){
            foreach($fileName as $k => $eachFileName){
                $explodedFile = explode('.', $eachFileName);
                $fileLen = count($explodedFile);
                $fileExtention = $explodedFile[$fileLen - 1];
                if(!in_array($fileExtention, $acceptedFileType)){
                    $errorMessage[] = 'Image at position '.($k + 1).' must be of image type: '.implode(',', $acceptedFileType.'='.$fileExtention);
                }
            }
        }

        if(count($errorMessage) > 0){
            return [
                'status'=>false,
                'error'=>$errorMessage,
                'data'=>[]
            ];
        }
        return [
            'status'=>true,
            'error'=>'',
            'data'=>[]
        ];

    }

    function getState() {
        return ['Abia','Adamawa','Akwa ibom','Anambra','Bauchi','Bayelsa','Benue','Borno','CrossRiver','Delta','Ebonyi','Edo','Ekiti','Enugu','Gombe','Imo','Jigawa','Kaduna','Kano','Kastina','Kebbi','Kogi','Kwara','Lagos','Nasarawa','Niger','Ogun','Ondo','Osun','Oyo','Plateau','Rivers','Sokoto','Taraba','Yobe','Zamfara','Abuja','Other'];

    }

    function returnStateAlphabetically($collectionCenters){

        $existingState = $this->getState(); $collectionArray = [];
        foreach($collectionCenters as $k => $eachCollection){

            foreach($existingState as $l => $eachState){

                if(strpos(strtolower($eachCollection->state_region_province), strtolower($eachState)) !== false){
                    $collectionArray[strtolower($eachState)][] = $eachCollection;
                }

            }

        }
        return $collectionArray;

    }

    //this is the id for the main system currency
    function returnMainCurrencyUniqueId(){
        return 'RTA76f166edd'
;    }

    function randomStringCreator ( $type = 'alnum', $len = 8 )
    {
        switch ( $type )
        {
            case 'alnum'	:
            case 'numeric'	:
            case 'nozero'	:

                switch ($type)
                {
                    case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric'	:	$pool = '0123456789';
                        break;
                    case 'nozero'	:	$pool = '123456789';
                        break;
                }

                $str = '';
                for ( $i=0; $i < $len; $i++ )
                {
                    $str .= substr ( $pool, mt_rand ( 0, strlen ( $pool ) -1 ), 1 );
                }
                return $str;
                break;
            case 'unique' : return md5 ( uniqid ( mt_rand () ) );
                break;
        }
    }

    public function createUniqueId2($table_name, $column, $type = 'numeric', $len = 8){

        $unique_id = $this->randomStringCreator ( $type, $len);

        //check for the database count from the database"unique_id"
        $rowcount = DB::table($table_name)->where($column, $unique_id)->count();

        if($rowcount == 0){

            if(empty($unique_id)){
                $this->createUniqueId2($table_name, $column);
            }else{
                return $unique_id;
            }

        }else{
            $this->createUniqueId2($table_name, $column);
        }

    }

    //function that changes an associative array to an object
    function returnObject(array $array){
        return json_decode(json_encode($array));
    }

    function floattostr( $val )
    {
        preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o );
        return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:'');
    }


}
