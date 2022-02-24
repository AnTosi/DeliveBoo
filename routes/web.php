<?php

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');


Route::get('/checkout', function () {
    return view('checkout')->name('checkout');
});

Auth::routes();

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('dashboard');

    Route::resource('dishes', DishController::class)->parameter('dishes', 'dish:slug');

    Route::resource('orders', OrderController::class);


    Route::get('/statistics', function () {
        return view('statistics')->name('statistics');
    });
});

Route::post('/payment/pay', 'OrderController@pay')->name('payment.pay');
Route::get('/payment/pay', 'OrderController@create')->name('payment.pay');

Route::get('/register', function () {

    $tags = Tag::all();
    return view('auth.register', compact('tags'));
})->name('register');

Route::post('/guest/order', 'OrderController@showOrder')->name('orders.showOrder');

Route::get('/{user:slug}', 'HomeController@show')->name('restaurant.show');


Route::get('/payment/make', 'PaymentController@make')->name('payment.make');
