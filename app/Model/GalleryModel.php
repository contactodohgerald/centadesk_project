<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryModel extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function getAllGallery($condition, $id = 'id', $desc = 'desc'){

        return GalleryModel::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleGallery($condition){

        return GalleryModel::where($condition)->first();

    }

    public function getGalleryByPaginate($number, $condition = null, $id = 'id', $desc = 'desc'){

        return GalleryModel::where($condition)->orderBy($id, $desc)->simplePaginate($number);

    }

    function selectSingleGallery($id){
        return GalleryModel::find($id);
    }

}
