<?php
  namespace App\Traits;

use App\User;
use App\Model\Bonus;
use App\Traits\Generics;
use App\Http\Controllers\Controller;


    trait BonusManager{
        //unique_id,type,amount,user_id,referred_id,downline_number,investment_id,status,amount_paid,percentage
        use Generics;

        function saveBonus($amount, $uplineReferralId, $enrollmentUniqueId, $loggedDetails, $userReferralIdColumnName, $referrerIdColumnName, $agentsTypeColumn, $bonusArray, $counter = 0, $type = 'bonus'){

            // $bonusArray = [
            //     'zuLKShyeijlyoMX7wWsP151f8b495dec34f5'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],//normal
            //     '31f3Ibex3rbQuqj3ubaeae463f657bdd8d21'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],//silver
            //     'yMcRB9jYCtkAYsvnPq8I9cbaada2a9559ec4'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],//diamond
            //     'NvlSLS84KSYxrz0Sijm7afb1596bd766c184'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],//golden
            //     'pKnXYM6rIhCS5ldSQm9Cfcebcbee89638a83'=>[5, 3, 2.6, 2.4, 2.2, 2, 1.8, 1.6, 1.4, 1.2, 1, 0.9, 0.8, 0.7, 0.6, 0.5, 0.4, 0.3, 0.2, 0.1],//special
            // ];

        if($uplineReferralId !== null && $uplineReferralId !== ''){

                $userDetails = User::where($userReferralIdColumnName, $uplineReferralId)->first();


                if($userDetails !== null){

                    $agentTypeId = $userDetails->$agentsTypeColumn;

                    if($counter < count($bonusArray[$agentTypeId])){
                        $yearly_subscription_status = $userDetails->yearly_subscription_status;//check if user has a yearly subscription

                        //check to make sure the users yearly subscription status is truex
                        if($yearly_subscription_status === 'yes'){
                            $controller = new Controller();

                            //ascertain the type of agent being dealt with
                            $selectedBonusArray = $bonusArray[$agentTypeId];//pick the array of bonus to be adminsterred

                            $bonusAmount = $amount * ($selectedBonusArray[$counter] / 100);
                            $bonusModel = new Bonus();
                            $bonusModel->unique_id = $this->createUniqueId('course_enrollments_tb', 'unique_id');
                            $bonusModel->type = $type;
                            $bonusModel->amount = $bonusAmount;
                            $bonusModel->user_id = $userDetails->unique_id;
                            $bonusModel->referred_id = $loggedDetails->unique_id;
                            $bonusModel->downline_number  = ($counter + 1);
                            $bonusModel->investment_id = $enrollmentUniqueId;
                            $bonusModel->status = 'done';
                            $bonusModel->amount_paid = $amount;
                            $bonusModel->percentage = $selectedBonusArray[$counter];
                            $bonusModel->agent_type_id = $agentTypeId;
                            $bonusModel->save();

                            //add the money to the user account
                            $userDetails->balance = $bonusAmount + $userDetails->balance;
                            $userDetails->save();

                        }

                        //call the function again
                        $counter++;
                        $uplineReferralId = $userDetails->$referrerIdColumnName;
                        $this->saveBonus($amount, $uplineReferralId, $enrollmentUniqueId, $loggedDetails, $userReferralIdColumnName, $referrerIdColumnName, $agentsTypeColumn, $bonusArray, $counter, $type);
                    }

                }

            }

        }//Silver Agent, Diamond Agent, Golden Agent, Special Agent

        public function selectDownlines($referrerIdColumnName, $userReferralIdColumnName, $userArray = [], $downlinesArray = [], $counter = 0)
        {
            $downlineForAllUser = [];
            if(count($userArray) > 0){
                foreach($userArray as $k => $eachUser){//loop through the users

                    $downlineForOneUser = User::where($referrerIdColumnName, $eachUser->$userReferralIdColumnName)->get();
                    if(count($downlineForOneUser) > 0){

                        foreach($downlineForOneUser as $l => $eachDownLineForAUser){
                            $downlineForAllUser[] = $eachDownLineForAUser;
                        }

                    }

                }
                $downlinesArray[($counter + 1)] = $downlineForAllUser;
                $userArray = $downlineForAllUser;
                if(count($downlineForAllUser) == 0){
                    //session(['array_of_downlines' => $downlinesArray]);
                }
                $counter++;
                //$this->selectDownlines($userArray, $downlinesArray, $counter);
                $this->selectDownlines($referrerIdColumnName, $userReferralIdColumnName, $userArray, $downlinesArray, $counter);
            }
            else{
                session(['array_of_downlines' => $downlinesArray]);
            }

        }


        public function selectEarningFromDownlines($referrerIdColumnName, $userReferralIdColumnName, $mainUserId, $userArray = [], $downlinesArray = [], $counter = 0)
        {
            $downlineForAllUser = [];
            if(count($userArray) > 0){
                foreach($userArray as $k => $eachUser){//loop through the users
                    //'user_ref_id', ''
                    $downlineForOneUser = User::where($referrerIdColumnName, $eachUser->$userReferralIdColumnName)->get();
                    if(count($downlineForOneUser) > 0){

                        foreach($downlineForOneUser as $l => $eachDownLineForAUser){
                            //select the amount investments
                            $bonusModel = new Bonus();
                            $bonusDetails = $bonusModel::where('user_id', $mainUserId)->where('referred_id', $eachDownLineForAUser->unique_id)->orderBy('id', 'desc')->get();
                            $eachDownLineForAUser->bonus_details = $bonusDetails;
                            $downlineForAllUser[] = $eachDownLineForAUser;
                        }

                    }

                }


                if(count($downlineForAllUser) > 0){
                    $downlinesArray[($counter + 1)] = $downlineForAllUser;
                }
                $userArray = $downlineForAllUser;

                if(count($downlineForAllUser) == 0){
                    session(['array_of_downlines' => $downlinesArray]);
                    //return $downlinesArray;
                }
                $counter++;
                //$this->selectDownlines($userArray, $downlinesArray, $counter);
                $this->selectEarningFromDownlines($referrerIdColumnName, $userReferralIdColumnName, $mainUserId, $userArray, $downlinesArray, $counter);
            }
            // else{
            //     session(['array_of_downlines' => $downlinesArray]);
            // }

        }


    }
    //https://stackoverflow.com/questions/40418025/trying-to-create-a-binary-tree-but-my-downline-is-not-in-the-correct-order
?>