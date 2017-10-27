<?php

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
    return view('welcome');
});

Route::get('/order/{order}/{transition}', function (App\Order $order, $transition)
{ 
    // make sure you have autheticated user by route middleware or Auth check

    try {
        $order->transition($transition);
    } catch(Exception $e) {
        return abort(500, $e->getMessage());
    }
    return $order->history()->get();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
