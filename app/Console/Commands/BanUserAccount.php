<?php

namespace App\Console\Commands;

use App\Traits\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BanUserAccount extends Command
{
    use SendMail;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ban:user_account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command gets all the users and check if their account has been up to two weeks and no payment have been made and blocks the account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->banUserAccountAfterWeeksOfNonSubscription();
    }

    public function banUserAccountAfterWeeksOfNonSubscription(){
        $condition = [
            ['status', 'active'],
            ['is_blocked', 'no'],
        ];
        $users = $this->user->getAllUsers($condition);

        foreach ($users as $key => $each_users){
            $get_date_progress = Carbon::parse($each_users->created_at)->diffInDays(Carbon::now());
            $now = Carbon::now()->addDays(7);
            if ($each_users->yearly_subscription_status === 'no'){
                if ($get_date_progress >= 7){
                    if ($each_users->user_type === 'student' || $each_users->user_type === 'teacher'){
                        $each_users->status = 'inactive';
                        $each_users->account_activation_date_counter = $now->toDateTimeString();
                        if ($each_users->save()){
                            $full_name = $each_users->name.' '.$each_users->last_name;
                            $app_name = env('APP_NAME');
                            $message =  'Hello '.$full_name.', your'.$app_name.' account has been dormant for more than a week now, and has been deactivated, kindly write to our support for account reactivation.';
                            //write a function that sends the user an email upon account inactive
                            $this->sendMails("Account Status Notification", $message, $app_name, env('BASE_URL'), $each_users->email);
                        }
                    }
                }elseif($get_date_progress >= 14){
                    $each_users->status = 'banned';
                    if ($each_users->save()){
                        $full_name = $each_users->name.' '.$each_users->last_name;
                        $app_name = env('APP_NAME');
                        $base = env('BASE_URL');
                        $message =  'Hello '.$full_name.', your'.$app_name.' account has been banned for actively been dormant for more than two week now. You can always write to our support team @'.$base.'contact_us';
                        //write a function that sends the user an email upon account inactive
                        $this->sendMails("Account Status Notification", $message, $app_name, $base, $each_users->email);
                    }
                }
            }
        }


    }
}
