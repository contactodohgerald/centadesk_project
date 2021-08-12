<?php

namespace App\Console\Commands;

use App\Model\courseEnrollment;
use App\Model\InstructorsSubScribes;
use App\Traits\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TrackUsersLastTransaction extends Command
{
    use SendMail;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirm:user_transact_check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command checks the last time a user has made a transaction to know if it up to one year';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user, courseEnrollment $courseEnrollment, InstructorsSubScribes $instructorsubScribes)
    {
        parent::__construct();
        $this->user = $user;
        $this->courseEnrollment = $courseEnrollment;
        $this->instructorsubScribes = $instructorsubScribes;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->updateUsersLastTransactions();
    }

    public function updateUsersLastTransactions(){
        $condition = [
            ['status', 'active'],
            ['is_blocked', 'no'],
        ];
        $users = $this->user->getAllUsers($condition);
        if (count($users) > 0){
            foreach ($users as $key => $each_user){
                if ($each_user->user_type === 'student'){
                  $this->getLatestEnrol($each_user->unique_id, $users);
                }elseif($each_user->user_type === 'teacher'){
                    $subscribe_query = [
                        ['user_unique_id', $each_user->unique_id],
                    ];
                    $instructor_sub = $this->instructorsubScribes->getLatestSubscribes($subscribe_query);
                    if ($instructor_sub == null){
                        $this->getLatestEnrol($each_user->unique_id, $users);
                    }else{
                        $get_date_progress = Carbon::parse($instructor_sub->created_at)->diffInDays(Carbon::now());
                        if ($get_date_progress >= 365){
                            $each_user->status = 'inactive';
                            $each_user->yearly_subscription_status = 'no';
                            $each_user->subscription_date = null;
                            if($each_user->save()){
                                $full_name = $each_user->name.' '.$each_user->last_name;
                                $app_name = env('APP_NAME');
                                $message =  'Hello '.$full_name.', your yearly subscription to'.$app_name.' has expired and you '.$app_name.' has been deactivated. Write to our support for account activation.';
                                //write a function that sends the user an email upon account inactive
                                $this->sendMails("Account Status Notification", $message, $app_name, env('BASE_URL'), $each_user->email);
                            }
                        }
                    }
                }
            }
        }

    }

    function getLatestEnrol($unique_id, $each_user){
        $transaction_query = [
            ['user_enrolling', $unique_id],
        ];
        $courseEnrollment = $this->courseEnrollment->getLatestEnrolls($transaction_query);
        if ($courseEnrollment != null){
            $get_date_progress = Carbon::parse($courseEnrollment->created_at)->diffInDays(Carbon::now());
            if ($get_date_progress >= 365){
                $each_user->status = 'inactive';
                $each_user->yearly_subscription_status = 'no';
                $each_user->subscription_date = null;
                if ($each_user->save()){
                    $full_name = $each_user->name.' '.$each_user->last_name;
                    $app_name = env('APP_NAME');
                    $message =  'Hello '.$full_name.', it\'s been 1 (one) year since your last enrolled on a course, so your account has been deactivated you wont\'t be able to login. Write to our support for account reactivation.';
                    //write a function that sends the user an email upon account inactive
                    $this->sendMails("Account Status Notification", $message, $app_name, env('BASE_URL'), $each_user->email);
                }
            }
        }
    }
}
