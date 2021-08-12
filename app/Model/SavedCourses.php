<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavedCourses extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllSaveCourse($condition, $id = 'id', $desc = 'desc'){

        $saveCourse = SavedCourses::where($condition)->orderBy($id, $desc)->get();

        return $saveCourse;
    }

    function getSingleSaveCourse($condition){

        $saveCourse = SavedCourses::where($condition)->first();

        return $saveCourse;
    }

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }
    
    public function courses(){
        return $this->belongsTo('App\course_model', 'book_unique_id');
    }

   
}
