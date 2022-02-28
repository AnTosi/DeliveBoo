<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\User;

class StatisticController extends Controller
{
    //
    public function index()
    {

        // $user = User::find(Auth::id());
        // $orders = $user->orders()->orderByDesc('id')->paginate(12);

        // foreach ($orders as $index => $value) {
        //     # code...
        // }



        return view('admin.statistics');
    }
}
