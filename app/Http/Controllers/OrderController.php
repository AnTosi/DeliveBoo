<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

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
}