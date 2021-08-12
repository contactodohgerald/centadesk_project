<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function referred(){
        return $this->belongsTo('App\User', 'referred_id');
    }

    function main_user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    function enrollment(){
        return $this->belongsTo('App\Model\courseEnrollment', 'investment_id');
    }


}
