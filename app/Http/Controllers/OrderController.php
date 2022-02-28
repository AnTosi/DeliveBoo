<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Carbon\Carbon;


class OrderController extends Controller
{

    public function showOrder(Request $request)
    {

        $listaOrdine = $request['qty'];

        $piatti = [];

        $prezzo_totale = 0;
        $prezzo_piatto = [];

        $restaurant = null;

        if ($listaOrdine) {

            foreach ($listaOrdine as $id => $qty) {
                $dish = Dish::find($id);

                $restaurant = User::find($dish->user_id);

                $prezzo_piatto[] = $dish->price * $qty;

                $piatti[] = $dish;
            }
        }

        if ($prezzo_piatto) {

            foreach ($prezzo_piatto as $prezzo) {
                $prezzo_totale += $prezzo;
            }
        }

        // dd($prezzo_totale);

        return view('guest.restaurant.order', compact('piatti', 'listaOrdine', 'prezzo_totale', 'restaurant'));
    }

    public function pay(Request $request, Gateway $gateway)
    {
        $piatti = json_decode($request['piatti']);

        $orders_quantity = json_decode($request['ordini']);


        $val_data = $request->validate([
            'customer_name' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'dish_price' => ['required'],
            'total_price' => ['required'],
            'user_id' => ['required'],

        ]);
        $order = new Order;

        $order->customer_name = $val_data['customer_name'];
        $order->email = $val_data['email'];
        $order->address = $val_data['address'];
        $order->data = Carbon::now();
        $order->dish_price = $val_data['dish_price'];
        $order->total_price = $val_data['total_price'];
        $order->user_id = $val_data['user_id'];
        $order->save();

        $restaurant = User::find($request['user_id']);

        $dishes = [];

        foreach ($piatti as $piatto) {
            # code...
            $dish = Dish::find($piatto->id);

            $dishes[] = $dish;
        }

        foreach ($dishes as $dish) {
            # code...
            foreach ($orders_quantity as $key => $value) {
                # code...
                if ($key == $dish->id) {
                    # code...
                    $dish->orders()->attach(
                        $order,
                        ['order_id' => $order->id, 'quantity' => $value]
                    );
                }
            }
        }

        /* $dish->orders()->attach($order, ['order_id' => $order->id, 'quantity' => $qty]); */

        $token = $gateway->ClientToken()->generate();


        return view('payment.pay', compact('order', 'token', 'restaurant'));
    }

    public function make(Request $request, Gateway $gateway, Order $order)
    {
        # code...
        {
            $payload = $request->input('payload', false);
            $nonce = $payload['nonce'];


            $status = $gateway->transaction()->sale([
                'amount' => '10',
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true,
                ],
            ]);

            // if ($status->success) {
            //     $transaction = $status->transaction;

            //     return redirect()->route('guest.restaurant.order')->with('message', "Transazione avvenuta con successo! L'ID della transazione è: $transaction->id");
            // } else {
            //     $errorString = "";

            //     foreach ($status->errors->deepAll() as $error) {
            //         $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            //     }

            //     return back()->withErrors('Transazione fallita! Il motivo è: ' . $status->message);
            // }
            return response()->json($status);
        }
    }

    public function success()
    {
        return view('guest.successfulPayment')->with('message', 'Your payment has been completed successfully!');
    }

    public function failed()
    {
        return view('guest.failedPayment')->with('message', 'Your payment failed!');
    }
}