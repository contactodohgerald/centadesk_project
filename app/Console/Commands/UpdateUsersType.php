<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class UpdateUsersType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:user_type_id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command updates the users agent level base on the number of referrals he / she has';

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
        $this->updateUserAgentLevel();
    }


    public function updateUserAgentLevel(){
        $condition = [
            ['status', 'active'],
            ['is_blocked', 'no'],
        ];
        $users = $this->user->getAllUsers($condition);

        if(count($users) > 0){
            foreach ($users as $each_user){

                $query = [
                    ['referred_id', $each_user->user_referral_id],
                ];

                $count = $this->user->getAllUsers($query);

                if(count($count) < 50){
                    $each_user->agent_level_id = 'zuLKShyeijlyoMX7wWsP151f8b495dec34f5';
                    
                }else if(count($count) >= 50 && count($count) < 99){
                    $each_user->agent_level_id = '31f3Ibex3rbQuqj3ubaeae463f657bdd8d21';
                    
                }else if(count($count) >= 100 && count($count) < 199){
                    $each_user->agent_level_id = 'yMcRB9jYCtkAYsvnPq8I9cbaada2a9559ec4';
                    
                }else if(count($count) >= 200 && count($count) < 999){
                    $each_user->agent_level_id = 'NvlSLS84KSYxrz0Sijm7afb1596bd766c184';
                   
                }else if(count($count) > 1000){
                    $each_user->agent_level_id = 'pKnXYM6rIhCS5ldSQm9Cfcebcbee89638a83';
                    
                }

                $each_user->save();

            }
        }

    }
}
