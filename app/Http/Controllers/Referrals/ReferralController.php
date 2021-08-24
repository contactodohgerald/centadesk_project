<?php

namespace App\Http\Controllers\Referrals;

use App\Models\User;
use App\Model\Bonus;
use App\Traits\BonusManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    use BonusManager;
    public function __construct(User $user, Bonus $bonus){
        $this->middleware('auth');
        $this->user = $user;
        $this->bonus = $bonus;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId = null)
    {
        $data = [];
        if($userId === null){
            $userDetails = auth()->user();
        }

        if($userId !== null){
            $userDetails = $this->user::where([
                ['unique_id', '=', $userId]
            ])->first();
        }

        $this->selectEarningFromDownlines('referred_id', 'user_referral_id', $userDetails->unique_id, [$userDetails], [], 0);

        $data['referral_earnings'] = session('array_of_downlines');
       
        return view('dashboard.referral_earnings',  $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_users()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function referralDetails($mainUserID, $referredUserId)
    {
        $data = [];

        $bonuses = $this->bonus::where([
            ['user_id', '=', $mainUserID],
            ['referred_id', '=', $referredUserId]
        ])->get();

        if(count($bonuses) > 0){
            foreach($bonuses as $k => $eachBonuses){
                $eachBonuses->referred;
                $eachBonuses->main_user;
                $eachBonuses->enrollment;
            }
        }

        $data['bonuses'] = $bonuses;

        return view('dashboard.referral_details',  $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
