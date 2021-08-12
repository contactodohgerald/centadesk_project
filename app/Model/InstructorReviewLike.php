<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorReviewLike extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllInstructorReviewLike($condition, $id = 'id', $desc = 'desc'){

        return InstructorReviewLike::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleInstructorReviewLike($condition){

        return InstructorReviewLike::where($condition)->first();

    }
}
