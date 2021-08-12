<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class paymentAddress extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'payment_address_tb';
    protected $primaryKey = 'unique_id';
    protected $keyType = 'unique_id';
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
    protected $fillable = ['unique_id', 'xpub', 'address','updated_at'];


    /**
     * Function to get all data in this model[table]
     * $col -> column to sort by; $sort-> type of sorting.
     *
     * @param array $condition
     * @param string $col
     * @param string $sort
     * @return mixed
     */
    public function get_all($condition, $col, $sort)
    {
        $paymentAddress = paymentAddress::where($condition)->orderBy($col, $sort)->get();
        return $paymentAddress;
    }
}
