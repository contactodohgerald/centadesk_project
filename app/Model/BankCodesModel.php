<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankCodesModel extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getAllBankCodes($condition, $oderBy = 'bank_name'){

        $banks = BankCodesModel::where($condition)->orderBy($oderBy)->get();

        return $banks;

    }
}
