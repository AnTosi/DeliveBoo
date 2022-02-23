<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree;

class PaymentController extends Controller
{
    //
    public function make(Request $request)
    {
        # code...
        {
            $payload = $request->input('payload', false);
            $nonce = $payload['nonce'];

            $gateway = new \Braintree\Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'd6w59t89p77r3whk',
                'publicKey' => 'r4kg59c6ftzcsvs2',
                'privateKey' => 'decfa4484e30f7d017c8c6bf182d8e23',
            ]);

            $status = $gateway->transaction()->sale([
                'amount' => '10.00',
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true,
                ],
            ]);
            return response()->json($status);
        }
    }
}
