<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function showOrder(Request $request) {

       $listaOrdine = $request['qty'];
        
        $piatti = [];

        foreach ($listaOrdine as $id => $qty) {
            # code...
            $dish = Dish::find($id);

            $piatti[] = $dish;

        }

      
        return view('guest.restaurant.order', compact('piatti', 'listaOrdine'));
    }
}
