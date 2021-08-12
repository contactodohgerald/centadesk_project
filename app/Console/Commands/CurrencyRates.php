<?php

namespace App\Console\Commands;

use App\Model\AppSettings;
use App\Model\CurrencyRatesModel;
use Illuminate\Console\Command;

class CurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Currency Rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AppSettings $appSettings, CurrencyRatesModel $currencyRatesModel)
    {
        parent::__construct();
        $this->appSettings = $appSettings;
        $this->currencyRatesModel = $currencyRatesModel;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->UpdateCurrencyRates();
        //$this->updatePrice();
    }

    function UpdateCurrencyRates(){

        //

        // Initialize CURL:
        $ch = curl_init('https://currencyrates.techocraft.com/get_currency_rates');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json);

        if($exchangeRates->status === true){

            foreach($exchangeRates->data as $k => $each_currency_rates){

                $existing_rate = CurrencyRatesModel::where('unique_id', $each_currency_rates->unique_id)->first();
                if($existing_rate !== null){

                    $insertRates = $existing_rate;
                    $insertRates->base_currency = $each_currency_rates->base_currency;
                    $insertRates->second_currency 	= $each_currency_rates->second_currency;
                    $insertRates->rate_of_conversion = 	$each_currency_rates->rate_of_conversion;
                    $insertRates->expression = 	$each_currency_rates->expression;
                    $insertRates->currency_name = $each_currency_rates->currency_name;
                    $insertRates->country_name = $each_currency_rates->country_name;
                    $insertRates->country_abbr = $each_currency_rates->country_abbr;
                    $insertRates->save();

                }else{

                    $insertRates = new CurrencyRatesModel();
                    $insertRates->unique_id = $each_currency_rates->unique_id;
                    $insertRates->base_currency = $each_currency_rates->base_currency;
                    $insertRates->second_currency 	= $each_currency_rates->second_currency;
                    $insertRates->rate_of_conversion = 	$each_currency_rates->rate_of_conversion;
                    $insertRates->expression = 	$each_currency_rates->expression;
                    $insertRates->currency_name = $each_currency_rates->currency_name;
                    $insertRates->country_name = $each_currency_rates->country_name;
                    $insertRates->country_abbr = $each_currency_rates->country_abbr;
                    $insertRates->save();

                }

            }

        }

    }
}
