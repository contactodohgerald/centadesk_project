<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AppSettings{

    var $active8 = 'active';

 function getAppSettings(){
    $user = null;
    if (Auth::check()) { 
         $user = User::where('unique_id', Auth::user()->unique_id)->first(); 
    }
     $appSettings = new \App\Model\AppSettings();
     $Settings = $appSettings->getSingleModel();
     return [
         'title' => 'Register | Centadesk',
         'site_description' => env('APP_NAME').' is Online Multi-Level Learning Platform',
         'keywords' => 'Online Learning, Online, Learning, Platform',
         'siteName' => $Settings->company_name,
         'siteDomain' => $Settings->company_url,
         'sitePhone' => $Settings->company_phone_1,
         'siteEmail' => $Settings->company_email_1,
         'siteAddress' => $Settings->company_address,
         'siteLogo' => $Settings->site_logo,
         'siteFacebook' => $Settings->facebook_url,
         'siteTwitter' => $Settings->twitter_url,
         'siteInstagram' => $Settings->instagram_url,
         'siteYoutube' => $Settings->youtube_url,
         'siteWhatsApp' => $Settings->whatsApp_phone,
         'baseurl' => env('APP_URL'),
         'currencyArray'=>['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN',
         'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZAR'],
         'countryCodeArray'=>['BI', 'CA', 'DR', 'CV', 'EU', 'GB', 'GH', 'GM', 'GN', 'KE', 'LRD', 'MWK', 'MZN',
         'NG', 'RW', 'SL', 'ST', 'TZ', 'UG', 'US', 'XA', 'XO', 'ZM', 'ZM', 'ZW', 'ZA'],
         'user'=>$user
     ];

 }


}