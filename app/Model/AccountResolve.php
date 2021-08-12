<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountResolve extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    public function getAllOfComplain($condition, $id = 'id', $desc = 'desc'){

        $complains = AccountResolve::where($condition)->orderBy($id, $desc)->get();

        return $complains;

    }

    public function getSingleOfComplain($condition){

        $complains = AccountResolve::where($condition)->first();

        return $complains;

    }
}
