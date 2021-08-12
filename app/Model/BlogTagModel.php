<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTagModel extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllBlogTags($id = 'id', $desc = 'desc'){
        return BlogTagModel::orderBy($id, $desc)->get();
    }

    function getSingleBlogTags($condition){
        return BlogTagModel::where($condition)->first();
    }
}
