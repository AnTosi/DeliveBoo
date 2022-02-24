<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{


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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}