<?php

namespace App\Traits;
use App\Mail\ContactUsMail;
use App\Mail\Notification;
use App\Mail\WithdrawMail;
use Illuminate\Support\Facades\Mail;

trait SendMail {

    public function sendMails($heading, $message, $site_name, $base_url, $userEmail){

        $details = [

            'heading' => $heading,
            'message' => $message,
            'site_name' => $site_name,
            'base_url' => $base_url,

        ];

        Mail::to($userEmail)->send(new \App\Mail\sendMail($details));
    }

    public function sendTransactionMail($heading, $message, $site_name, $base_url, $userEmail){

        $details = [

            'heading' => $heading,
            'message' => $message,
            'site_name' => $site_name,
            'base_url' => $base_url,

        ];

        Mail::to($userEmail)->send(new WithdrawMail($details));
    }

    public function sendAdminEmailForAccountResolve($heading, $message, $site_name, $base_url, $userEmail){

        $details = [

            'heading' => $heading,
            'message' => $message,
            'site_name' => $site_name,
            'base_url' => $base_url,

        ];

        Mail::to($userEmail)->send(new Notification($details));
    }

    public function contactUsMailSend($heading, $subject, $phone, $email, $full_name, $message, $site_name, $base_url, $userEmail){

        $details = [

            'heading' => $heading,
            'subject' => $subject,
            'phone' => $phone,
            'email' => $email,
            'full_name' => $full_name,
            'message' => $message,
            'site_name' => $site_name,
            'base_url' => $base_url,

        ];

        Mail::to($userEmail)->send(new ContactUsMail($details));
    }

}
