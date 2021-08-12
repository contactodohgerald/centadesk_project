<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllLikes($condition, $id = 'id', $desc = 'desc'){

        $likes = Like::where($condition)->orderBy($id, $desc)->get();

        return $likes;

    }

    function getSingleLikes($condition){

        $likes = Like::where($condition)->first();

        return $likes;

    }
}
