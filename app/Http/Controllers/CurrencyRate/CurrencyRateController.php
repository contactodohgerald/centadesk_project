<?php

namespace App\Http\Controllers\CurrencyRate;

use App\Http\Controllers\Controller;
use App\Model\CurrencyRatesModel;
use App\Traits\Generics;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyRateController extends Controller
{
    //
    use Generics;

    function __construct()
    {
        $this->middleware('auth');
    }
    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'preferred_currency' => 'required',
        ]);

    }

    public function updateUserPreferredCurrency(Request $request){

        $users = auth()->user();

        $data = $request->all();

        try{
            $this->Validator($request);//validate fields


            $users->preferred_currency = $data['preferred_currency'];

            if ($users->save()){
                return redirect('/main_settings_page')->with('success_message', 'Preferred Currency Was Successfully Updated');
            }else{
                return redirect('/main_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('main_settings_page')->with('error_message', $errorsArray);

        }

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function currencyRatesUpdate(){

        //http://data.fixer.io/api/latest?access_key=365f857077fb096dd742d756da77226d&format=1
        $endpoint = 'latest';
        $access_key = 'API_KEY';

        // Initialize CURL:
        $ch = curl_init('http://data.fixer.io/api/latest?access_key=2930bdda637705d31e327a3da12f3ca5&format=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);

        if($exchangeRates['success'] == true){

            //print_r($exchangeRates['rates']); die();
            foreach($exchangeRates['rates'] as $k => $currency_rates){

                $existing_rate = CurrencyRatesModel::where('second_currency', $k);
                if($existing_rate->count() == 0){

                    $unique_id = $this->createUniqueId('currency_rates_models', 'unique_id');

                    $insertRates = new CurrencyRatesModel();

                    $insertRates->unique_id = $unique_id;
                    $insertRates->base_currency = $exchangeRates['base'];
                    $insertRates->second_currency 	= $k;
                    $insertRates->rate_of_conversion = $currency_rates;
                    $insertRates->expression = 	'1 '.$exchangeRates['base'].' = '.$currency_rates.' '.$k;
                    $insertRates->is_deleted = 'no';
                    $insertRates->deleted_on = Carbon::now()->toDateTimeString();

                    if ($insertRates->save()){
                        return redirect()->back()->with('success_message', 'Currencies Rate have been successfully updated');
                    }else{
                        return redirect()->back()->with('error_message', 'An Error occurred, Please try Again Later');
                    }
                }else{

                    $insertRates = $existing_rate->get();
                    foreach($insertRates as $key => $rates){
                        CurrencyRatesModel::where('id', $rates->id)->update(
                            [
                                'base_currency'=>$exchangeRates['base'],
                                'second_currency'=>$k,
                                'rate_of_conversion'=>$currency_rates,
                                'expression'=>'1 '.$exchangeRates['base'].' = '.$currency_rates.' '.$k,
                                'is_deleted'=>'no',
                                'deleted_on'=>Carbon::now()->toDateTimeString(),
                                'updated_at'=>Carbon::now()->toDateTimeString()
                            ]
                        );
                    }

                    return redirect()->back()->with('success_message', 'Currencies Rate have been successfully updated');

                }
            }
        }

    }
}
