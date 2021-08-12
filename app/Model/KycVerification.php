<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KycVerification extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function getAllKycVerification($condition, $id = 'id', $desc = 'desc'){

        $KycVerification = KycVerification::where($condition)->orderBy($id, $desc)->get();

        return $KycVerification;

    }

    function getSingleKycVerification($condition){

        $KycVerification = KycVerification::where($condition)->first();

        return $KycVerification;

    }
}
