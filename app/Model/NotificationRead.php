<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationRead extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllNotificationRead($condition, $id = 'id', $desc = 'desc'){

        return NotificationRead::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleNotificationRead($condition){

        return NotificationRead::where($condition)->first();

    }
}
