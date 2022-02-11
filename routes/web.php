<?php

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

Route::get('/', function () {
    return view('guest.welcome');
});

Route::resource('menu', MenuController::class)->only(['index', 'show']);

Route::get('/checkout', function () {
    return view('checkout')->name('checkout');
});

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('dishes', DishController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('tags', TagController::class);
    Route::get('/statistics', function () {
        return view('statistics')->name('statistics');
    });
});