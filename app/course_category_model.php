<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class course_category_model extends Model
{
    //
    use Notifiable;
    use SoftDeletes;

    protected $table = 'course_category_tb';
    protected $primaryKey = 'unique_id';
    protected $keyType = 'string';
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
    protected $fillable = ['unique_id', 'name', 'description'];

    public function courses(){
        return $this->hasMany('App\course_model', 'category_id')->where('status', 'confirmed');
    }

    function getAllCategories($desc = 'desc', $id = 'id'){

        $categories = course_category_model::orderBy($id, $desc)->get();

        return $categories;

    }

    function getSingleCategories($condition){

        $categories = course_category_model::where($condition)->first();

        return $categories;

    }
}
