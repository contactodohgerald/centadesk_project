<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function getAllReviews($condition, $id = 'id', $desc = 'desc'){

        return Review::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleReview($condition){

        return Review::where($condition)->first();

    }
}
