<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\User;
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

        $restaurant = null;

        foreach ($listaOrdine as $id => $qty) {
            $dish = Dish::find($id);

            $restaurant = User::find($dish->user_id);

            $prezzo_piatto[] = $dish->price * $qty;

            $piatti[] = $dish;
        }

        foreach ($prezzo_piatto as $prezzo) {
            $prezzo_totale += $prezzo;
        }

        // dd($prezzo_totale);

        return view('guest.restaurant.order', compact('piatti', 'listaOrdine', 'prezzo_totale', 'restaurant'));
    }

    public function pay(Request $request)
    {
        # code...
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'd6w59t89p77r3whk',
            'publicKey' => 'r4kg59c6ftzcsvs2',
            'privateKey' => 'decfa4484e30f7d017c8c6bf182d8e23',
        ]);

        $token = $gateway->ClientToken()->generate();

        $val_data = $request->validate([
            'customer_name' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'dish_price' => ['required'],
            'total_price' => ['required'],
            'user_id' => ['required'],

        ]);


        $order = Order::create([
            'customer_name' => $val_data['customer_name'],
            'email' =>$val_data['email'],
            'address' =>$val_data['address'],
            'dish_price' =>$val_data['dish_price'],
            'total_price' => $val_data['total_price'],
            'user_id' => $val_data['user_id'],
        ]);

        
        

        return view('payment.pay', compact('token', 'order'));
    }
}
