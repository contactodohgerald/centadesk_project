<?php

namespace App\Model;

use App\Traits\FireBaseNotification;
use Illuminate\Database\Eloquent\Model;

class Firebase extends Model
{
    //
    use FireBaseNotification;

    // sending push message to single user by firebase reg id
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'notification'=>['title'=>$message['title'], 'body'=>$message['message']['description']],
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'notification'=>['title'=>$message['title'], 'body'=>$message['message']['description']],
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => $registration_ids,
            'notification'=>['title'=>$message['title'], 'body'=>$message['message']['description']],
            'data' => $message,
        );

        return $this->sendPushNotification($fields);
    }
}
