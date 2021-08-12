<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class priceModel extends Model
{
    use Notifiable;
    use SoftDeletes;
    //
    protected $table = 'price_tb';
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
    protected $fillable = ['unique_id', 'title', 'amount'];

    function getAllPricing($desc = 'desc', $id = 'id'){

        $pricing = priceModel::orderBy($id, $desc)->get();

        return $pricing;

    }

    function getSinglePricing($condition){

        $pricing = priceModel::where($condition)->first();

        return $pricing;

    }
}
