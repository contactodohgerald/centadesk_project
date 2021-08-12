<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public $base_url = 'http://127.0.0.1:8000';
    public $site_logo = 'https://centadesk.com/front_end/img/logo-main.png';
    public static $User_id = '';


    public function calculateRatings($array_value){
        $rating = []; $users = []; $new_rating = 0;
        if(count($array_value) > 0){

            foreach ($array_value as $key => $each_array_value){
                array_push($rating, $each_array_value->rating);
                array_push($users, $each_array_value->user_unique_id);
            }

            $new_value = array_sum($rating);

            $new_rating = $new_value / count($users);

        }

        return $new_rating;
    }

    public function generateRandomNumber()
    {
        return mt_rand(100000, 999999);
    }
}
