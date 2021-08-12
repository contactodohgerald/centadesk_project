<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Notification;
use App\Model\NotificationRead;
use App\Traits\Generics;

class NotificationController extends Controller
{
    //
    use Generics;
    
    function __construct(Notification $notification, NotificationRead $notificationRead){
        $this->notification = $notification;
        $this->notificationRead = $notificationRead;
        
    }

    public function getAllNotification($user_unique_id = null){

        if($user_unique_id != null){
            $notification = $this->notification->getAllNotification([
                ['deleted_at', null]
            ]);
   
            if(count($notification) > 0){
                foreach($notification as $each_notification){
                    $each_notification->users;

                    $each_notification->dates = $each_notification->created_at->diffForHumans();

                    $notificationReads = $this->notificationRead->getAllNotificationRead([
                        ['Notification_unique_id', $each_notification->unique_id],
                        ['user_unique_id', $user_unique_id],
                    ]);

                    if(count($notificationReads) > 0){
                        $each_notification->read_status = 'read';
                    }else{
                        $each_notification->read_status = 'unread';
                    }
                }
            }
            
            return response()->json(['error_code'=>0, 'success_statement'=>'Notification was returned successfully!', 'notification_data'=>$notification]);

            
        }       

    }

    public function notificationPage($user_unique_id = null){

        if($user_unique_id != null){
            $notification = $this->notification->getAllNotification([
                ['deleted_at', null]
            ]);
   
            if(count($notification) > 0){
                foreach($notification as $each_notification){
                    $each_notification->users;

                    $each_notification->dates = $each_notification->created_at->diffForHumans();

                    $notificationReads = $this->notificationRead->getAllNotificationRead([
                        ['Notification_unique_id', $each_notification->unique_id],
                        ['user_unique_id', $user_unique_id],
                    ]);

                    if(count($notificationReads) > 0){
                        $each_notification->read_status = 'read';
                    }else{
                        $each_notification->read_status = 'unread';
                    }
                }
            }

            $view = [
                'notification'=>$notification
            ];

            return view('dashboard.notifications',  $view);

            
        }

    }

    public function addNotificationRead(Request $request)
    {
        try {

            $notificationReads = $this->notificationRead->getAllNotificationRead([
                ['Notification_unique_id', $request->notifiId],
                ['user_unique_id', $request->userId],
            ]);

            if(count($notificationReads) > 0){
                return response()->json(['error_code' => 0, 'success_statement' => 'Status Updated']);
            }else{
                $notification_read = new NotificationRead();
                $uniqueId = $this->createUniqueId('notification_reads', 'unique_id');

                $notification_read->unique_id = $uniqueId;
                $notification_read->user_unique_id = $request->userId;
                $notification_read->Notification_unique_id = $request->notifiId;

                $notification_read->save();
            }

            return response()->json(['error_code' => 0, 'success_statement' => 'Status Updated']);
        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);
        }
    }

    function handleTransferValidations(array $data)
    {

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;
    }

    public function deletNotification(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $validation = $this->handleTransferValidations($request->all());
            if ($validation->fails()) {
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $dataArray = explode('|', $request->dataArray);

            foreach ($dataArray as $eachDataArray) {

                $notification = $this->notification->selectSingleNotification($eachDataArray);
                
                $notification->delete();
            }
            return response()->json(['error_code' => 0, 'success_statement' => 'Selected notification was successfully deleted ']);

        } catch (Exception $exception) {

            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);

        }
    }

}
