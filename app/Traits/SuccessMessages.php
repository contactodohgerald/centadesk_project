<?php
namespace App\Traits;

trait SuccessMessages{

    //method that return the messages
    function returnSuccessMessage($keyword){
        $messageArray = [
            'successful_registration'=>'Hi, an account activation mail have been sent to your email address. Please provide the code in the mail in the box below'
        ];
        return $messageArray[$keyword];
    }
}