<?php

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
Route::get('/member', [App\Http\Controllers\MemberController::class, 'index'])->name('member');
Route::get('catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
Route::get('/author', [App\Http\Controllers\AuthorController::class, 'index'])->name('author');
Route::get('/publisher', [App\Http\Controllers\PublisherController::class, 'index'])->name('publisher');
Route::get('book', [App\Http\Controllers\BookController::class, 'index'])->name('book');
Route::get('transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
Route::get('transaction-detail', [App\Http\Controllers\TransactionDetailController::class, 'index'])->name('transaction-detail');
