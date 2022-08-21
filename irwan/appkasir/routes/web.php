<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Product;
use App\Http\Livewire\Cart;


Route::get('/', function () {
	return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    Route::get('/products', Product::class);
    Route::get('/cart', Cart::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
