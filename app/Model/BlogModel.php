<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogModel extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    public function blogComments(){
        return $this->hasMany('App\Model\BlogPostComment', 'blog_unique_id');
    }

    function getAllBlogPost($condition, $id = 'id', $desc = 'desc'){
        return BlogModel::where($condition)->orderBy($id, $desc)->get();
    }

    function getSingleBlogPost($condition){
        return BlogModel::where($condition)->first();
    }

    function getBlogByPaginate($number, $condition = null, $id = 'id', $desc = 'desc'){

        return BlogModel::where($condition)->orderBy($id, $desc)->simplePaginate($number);

    }
}
