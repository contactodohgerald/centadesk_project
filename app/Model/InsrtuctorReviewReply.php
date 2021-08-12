<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsrtuctorReviewReply extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function getAllInstructorReviewReply($condition, $id = 'id', $desc = 'desc'){

        return InsrtuctorReviewReply::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleInstructorReviewReply($condition){

        return InsrtuctorReviewReply::where($condition)->first();

    }
}
