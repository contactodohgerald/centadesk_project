<?php

namespace App;

use App\course_category_model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class course_model extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'course_tb';
    protected $primaryKey = 'unique_id';
    protected $keyType = 'string';
    public $incrementing = false;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unique_id', 'category_id','user_id', 'name', 'description', 'cover_image', 'intro_video', 'pricing','short_caption','course_urls','status','ratings','views','like','shares','is_bestseller'];


    /**
     * Get the category asssociated with a particular course.
     *
     * @return void
     */
    public function category(){
        return $this->belongsTo('App\course_category_model', 'category_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function price(){
        return $this->belongsTo('App\priceModel', 'pricing');
    }

    public function review(){
        return $this->hasMany('App\Model\Review', 'course_unique_id');
    }

    public function courseEnrollment(){
        return $this->hasMany('App\Model\courseEnrollment', 'course_id');
    }

    public function getAllCourse($condition, $id = 'id', $desc = 'desc'){

        return course_model::where($condition)->orderBy($id, $desc)->get();

    }

    public function getAllCourseWithLimit($condition){

        return course_model::latest()->where($condition)->get();

    }

    public function getCourseByPaginate($number, $condition = null, $id = 'id', $desc = 'desc'){

        return course_model::where($condition)->orderBy($id, $desc)->simplePaginate($number);

    }

    public function getSingleCourse($condition){

        return course_model::where($condition)->first();

    }

    function selectSingleCourse($id){
        return course_model::find($id);
    }
}
