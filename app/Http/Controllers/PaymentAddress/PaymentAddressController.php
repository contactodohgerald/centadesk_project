<?php

namespace App\Http\Controllers\PaymentAddress;

use App\course_model;
use Exception;
use Illuminate\Http\Request;
use App\Model\paymentAddress;
use App\Http\Controllers\Controller;
use App\Traits\appFunction;
use App\Traits\Generics;
use Illuminate\Support\Facades\Validator;

class PaymentAddressController extends Controller
{
    use appFunction, Generics;

    public function __construct(paymentAddress $paymentAddress)
    {
        $this->paymentAddress = $paymentAddress;
    }


    /**
     * Function will store payment address with the xpub it was created for.
     *
     * @param string $xpub
     * @param string $address
     * @return void
     */
    public function create($xpub, $address)
    {
        try {
            if (empty($xpub) || empty($address)) {
                throw new Exception($this->errorMsgs(29)['msg']);
            }

            $unique_id =  $this->createUniqueId('payment_address_tb', 'unique_id');
            $payment_address = paymentAddress::create([
                'unique_id' => $unique_id,
                'xpub' => $xpub,
                'address' => $address,
            ]);

            if (!$payment_address->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Payment Address Added!';
                return ["message" => $error, 'status' => true];
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return ["errors" => $error, 'status' => false];
        }
    }

    /**
     * Function to return a previously used address.
     *
     * @return void
     */
    public function get_prev_addresses($xpub)
    {
        try {
            if (empty($xpub)) {
                throw new Exception($this->errorMsgs(29)['msg']);
            }

            $condition = [
                ['xpub', $xpub]
            ];
            $address = $this->paymentAddress->get_all($condition,'updated_at','asc')->first();
            if(!$address){
                throw new Exception($this->errorMsgs(30)['msg']);
            }else{
                $payment_address = paymentAddress::find($address->unique_id);
                $payment_address->updated_at = date('Y-m-d H:i:s');
                $payment_address->save();

                // return $address;
                return ["address"=> $address->address, "status"=> true];
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return ["errors" => $error, 'status' => false];
        }
    }
}
