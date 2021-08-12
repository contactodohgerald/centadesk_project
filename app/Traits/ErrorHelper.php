<?php
namespace App\Traits;

trait ErrorHelper{

    function convertErrorToString($error){
        if(is_array($error)){
            $error = implode(':', $error);
        }
        return $error;
    }

}