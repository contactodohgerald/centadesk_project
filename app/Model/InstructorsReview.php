<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorsReview extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function getAllInstructorReview($condition, $id = 'id', $desc = 'desc'){

       return InstructorsReview::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleInstructorReview($condition){

        return InstructorsReview::where($condition)->first();

    }

}
