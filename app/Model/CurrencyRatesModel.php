<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurrencyRatesModel extends Model
{
    //

    public function getAllCurrency(){

        $currency_rates = CurrencyRatesModel::select('id', 'unique_id', 'second_currency','currency_name','country_name','country_abbr')->get();

        return $currency_rates;

    }
}
