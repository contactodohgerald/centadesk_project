<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorsSubScribes extends Model
{
    //b
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllInstructorsSubScribes($condition, $id = 'id', $desc = 'desc'){

        return InstructorsSubScribes::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleInstructorsSubScribes($condition){

        return InstructorsSubScribes::where($condition)->first();

    }

    function getLatestSubscribes($condition){
        return InstructorsSubScribes::where($condition)
            ->latest()
            ->first();

    }
}
