<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Braintree;

class OrderController extends Controller
{
    //
    public function showOrder(Request $request)
    {

        $listaOrdine = $request['qty'];

        $piatti = [];

        $prezzo_totale = 0;
        $prezzo_piatto = [];

        foreach ($listaOrdine as $id => $qty) {
            $dish = Dish::find($id);

            $prezzo_piatto[] = $dish->price * $qty;

            $piatti[] = $dish;
        }

        foreach ($prezzo_piatto as $prezzo) {
            $prezzo_totale += $prezzo;
        }

        // dd($prezzo_totale);

        return view('guest.restaurant.order', compact('piatti', 'listaOrdine', 'prezzo_totale'));
    }

    public function pay()
    {
        # code...
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'd6w59t89p77r3whk',
            'publicKey' => 'r4kg59c6ftzcsvs2',
            'privateKey' => 'decfa4484e30f7d017c8c6bf182d8e23',
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('payment.pay', compact('token'));
    }
}
