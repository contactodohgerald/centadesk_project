<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSettings extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['account_xpub','unique_id'];

    public function getSingleAppSettings($condition){

        $appSettings = AppSettings::where($condition)->first();

        return $appSettings;

    }

    //get single model
    function getSingleModel($id = 'ozV4GtwTx6AMa0yiIQk4ef025573572a01ea'){
        return AppSettings::where('unique_id',$id)->first();
    }


}
