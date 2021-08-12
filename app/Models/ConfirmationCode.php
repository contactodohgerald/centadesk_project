<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Mail\AccountActivation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use App\Traits\Generics;
use App\Model\AppSettings;
use Carbon\Carbon;

class ConfirmationCode extends Model
{
    use HasFactory, SoftDeletes, Generics;

    public function createActivationCode($userObject, $type = "account-activation") {

//try {

    //check if there is an existing code for current type of action
    $codeDetails = ConfirmationCode::where([
        ["user_unique_id", "=", $userObject->unique_id],
        ["status", "=", "un-used"],
        ["type", "=", $type],
    ])->first();


    //check if the query returned null
    if($codeDetails !== null){
        $codeDetails->status = 'failed';
        $codeDetails->save();
    }

    $uniqueId = $this->createUniqueId('confirmation_codes', 'unique_id');
    //unique_id user_unique_id 	token 	type 	status

    $token = $this->randomStringCreator ( 'numeric', 4);

    //call the function that creates the confirmation code
    $dataToSave = $this->returnObject([
        'unique_id' => $uniqueId,
        'user_unique_id' => $userObject->unique_id,
        'token' => $token,
        'type' => $type
    ]);

    $this->createConfirmationCode($dataToSave);

    return [
        'status'=> true,
        'message'=> "Code was successfully created",
        'data'=> $token,
      ];
//    } catch (\Exception $e) {
//      return [
//        'status'=> false,
//        'message'=> $e->getMessage(),
//        'data'=> [],
//      ];
//    }
  }

  function  verifyTokenValidity($token, string $token_type, $userObject):array {
        try{

            //validate the token in the db
            $tokenDetails = ConfirmationCode::where([
                ["user_unique_id", "=", $userObject->unique_id],
                ["token", "=", $token],
                ["type", "=", $token_type],
            ])->first();

            if($tokenDetails === null){//send the error message to the view
                return [
                    'status'=>false,
                    'message'=>"Invalid Token Supplied",
                    'message_type'=> "invalid_token"
                ];
            }

            //add ten minutes to the time for the code that was created
            $currentTime = Carbon::now()->toDateTimeString();
            $expirationTime = Carbon::parse($tokenDetails->created_at)->addMinutes(10)->toDateTimeString();

            //compare the dates
            if ($currentTime > $expirationTime) {
                return [
                    'status'=> false,
                    'message'=> "Token has expired",
                    'message_type'=> "expired_token",
                ];
            }

            //mark token as used token
            $tokenDetails->status = "used";
            $tokenDetails->save();

        //return the true status to the front end
          return [
                'status'=> true,
                'message'=> "Valid Token",
          ];

        }catch(\Exception $e){

            return [
                'status'=> false,
                'message'=> $e->getMessage(),
            ];

        }
  }

    //create new onfirmation code
    function createConfirmationCode($request){
        $confirmationCode = new ConfirmationCode();
        $confirmationCode->unique_id = $request->unique_id;
        $confirmationCode->user_unique_id = $request->user_unique_id;
        $confirmationCode->token = $request->token;
        $confirmationCode->type = $request->type;
        $confirmationCode->status = 'un-used';
        $confirmationCode->save();
        return $confirmationCode;
    }

    //send the email to the user involved
    function sendActivationMail($token, $userObject){
        $appSettings = new AppSettings();
        $userObject['settings'] = $appSettings->getSingleModel();
        $userObject['code'] = $token;
        Mail::to($userObject)->send(new AccountActivation($userObject));
    }
}
