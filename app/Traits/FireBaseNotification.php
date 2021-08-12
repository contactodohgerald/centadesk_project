<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Model\Firebase;
use App\Model\NotificationModel;
use App\Model\NotificationReadModel;
use App\Model\Push;
use Carbon\Carbon;

const FIREBASE_API_KEY = 'AAAAIFtMvZo:APA91bE-I-GM6-yIBuWBxXcYY5avMHpPLKz_Hv21ldwuuFQYPoLHQPs3n_tVil7KvwaDhiLqhb6tLwnw4c6DZgwjj5bXsMDuhaUpxgGyZ7WroFHXKAe9UzvPaKFrb4LCtt1K-WmhIDfA';
//'AAAAeZhwtKc:APA91bEP5tff5NRoQ_dsmmSyvz6d4K-HICY_E0dW46YThEqdV9r5DoGfrGcoYTligaVoTuj6HpTbcGCbxh2InllDbfvjvzkV6op74aBV82HHug3ob4oDbKegZ4L84l82XDcaGbul1wwu';

trait FireBaseNotification{

    // function makes curl request to firebase servers
    public function sendPushNotification($fields) {

        //require_once __DIR__ . '/config.php';

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//json_encode($fields)
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }

    //method that takes care of the notification
    public function NotificationsHandler($title, $link, $notification_type, $notification_details = [], $notification_details_key = [], $user_to_recieve_notification = [], $push_type = 'individual'){

        if(count($notification_details) != count($notification_details_key)){
            return false;
        }

        $unique_id = $this->createUniqueId('notification_models', 'unique_id');

        $notification = new NotificationModel();
        $notification->unique_id = $unique_id;
        $notification->title_ = $title;
        $notification->link = $link;
        $notification->notification_type = $notification_type;
        $notification->notification_details = implode('|', $notification_details);
        $notification->notification_details_key = implode('|', $notification_details_key);
        $notification->is_deleted = 'no';
        if($notification->save()){

            //create an associative array of the two different arrays of notification_type and  notification_details
            $notification_details_array = array_combine($notification_details_key, $notification_details);

            $message = [
                'notification_type'=>$notification_type,
                'type_of_reciever'=>'all',
                'unique_id'=>NotificationModel::where('unique_id', $unique_id)->first()->id,
                'link'=>$link,
                'description'=>$notification_details_array['course_desc'],
                'notification_details'=>$notification_details_array,
                'date_affected'=>Carbon::now()->toDateTimeString(),
            ];

            //send the notifications to selected users
            foreach ($user_to_recieve_notification as $k => $each_user_to_recieve_notification){

                //get there
                $fcm_unique_codes = [
                    $each_user_to_recieve_notification->andriod_fcm_key ?? '',
                    $each_user_to_recieve_notification->ios_fcm_key ?? '',
                    $each_user_to_recieve_notification->web_fcm_key ?? ''
                ];

                for($i = 0; $i < count($fcm_unique_codes); $i++){

                    if(!empty($fcm_unique_codes[$i])){

                        //call the firebase handler
                        $this->fireBaseMessage($title, $message, $push_type, FALSE, $fcm_unique_codes[$i], '');

                    }

                }

            }

        }

    }

    public function NotificationSelector($notification_type, $unique_id = ''){

        $errors = [];

        $user_id = Controller::$User_id;;

        //update a particular notification
        if(!empty($unique_id)){
            $this->updateNotifcationReadStatus($notification_type, $user_id, $unique_id);
        }

        //get the notification details select object
        $notification_details = $this->selectNotificationDetails($notification_type, $unique_id);

        if($notification_details->count() == 0){
            $errors[] = 'No Data Was Returned';
        }

        //if the error count is 0
        if(count($errors) == 0){

            //check id the unique id is returned and update the user read details
            //$unique_id
            $notification_details_array = $notification_details->get();

            foreach($notification_details_array as $k => $each_notification_details_array){

                $each_notification_details_array->school_details;

                //explode the notification and its keys
                $exploded_notification_details = explode('|', $each_notification_details_array->notification_details);
                $exploded_notification_details_key = explode('|', $each_notification_details_array->notification_details_key);
                $each_notification_details_array->notification_details_array = array_combine($exploded_notification_details_key, $exploded_notification_details);

                //select the read receipt $user_id
                $each_notification_details_array->read_receipt = NotificationReadModel::where('notification_id', $each_notification_details_array->id)->where('user_id', $user_id)->first();

            }

            return response()->json(['error_code'=>0, 'success_statement'=>'Notification Details were Returned', 'data'=>['notification_details'=>$notification_details_array]]);

        }

        if(count($errors) > 0){
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$errors]]]);
        }

    }

    function selectNotificationDetails($notification_type, $unique_id){

        $notification_details = '';

        if (empty($unique_id)) {
            $notification_details = NotificationModel::where('notification_type', $notification_type)->orderBy('id', 'desc');
        }

        if (!empty($unique_id)) {
            $notification_details = NotificationModel::where('notification_type', $notification_type)->where('unique_id ', $unique_id)->orderBy('id', 'desc');
        }

        return $notification_details;

    }

    public function fireBaseMessage($title = '', $message = '', $push_type = '', $include_image = FALSE, $regId = '', $image_url = ''){

        $pusher = new Push();
        $fire_base = new Firebase();

        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');

        /*require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();*/
        //$this->firebase->; $this->push->

        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        // notification title
        //$title = isset($_GET['title']) ? $_GET['title'] : '';

        // notification message
        //$message = isset($_GET['message']) ? $_GET['message'] : '';

        // push type - single user / topic
        //$push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';

        // whether to include to image or not
        //$include_image = isset($_GET['include_image']) ? TRUE : FALSE;


        $pusher->setTitle($title);
        $pusher->setMessage($message);
        if ($include_image) {
            $pusher->setImage($image_url);
        } else {
            $pusher->setImage('');
        }
        $pusher->setIsBackground(FALSE);
        $pusher->setPayload($payload);


        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $pusher->getPush();
            $response = $fire_base->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $pusher->getPush();
            //$regId = isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $fire_base->send($regId, $json);
        }

        if ($json != '') {
            //echo json_encode($json);
        }

        if ($response != '') {

            //echo json_encode($response);
        }

    }

    public function updateNotifcationReadStatus($type_of_receiver, $user_id, $unique_id){

        //get the notification details select object
        $notification_details = $this->selectNotificationDetails($type_of_receiver, $unique_id);

        if($notification_details->count() == 0){
            $errors[] = 'No Data Was Returned';
        }

        //if the error count is 0
        if($notification_details->count() > 0){

            //check id the unique id is returned and update the user read details
            // unique_id 	notification_id 	user_id 	is_deleted 	deleted_at 	created_at 	updated_at
            $notification_details_array = $notification_details->first();

            $updateReadStatus = new NotificationReadModel();
            $updateReadStatus->unique_id = $this->createUniqueId('notification_read_models', 'unique_id');
            $updateReadStatus->notification_id = $notification_details_array->id;
            $updateReadStatus->user_id = $user_id;
            $updateReadStatus->is_deleted = 'no';
            $updateReadStatus->save();

        }

    }

}
