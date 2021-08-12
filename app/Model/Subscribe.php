<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscribe extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function getAllSubscribers($condition, $id = 'id', $desc = 'desc'){

        return Subscribe::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleSubscribers($condition){

        return Subscribe::where($condition)->first();

    }
}
