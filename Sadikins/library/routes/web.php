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
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('members');
Route::get('catalogs', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalogs');
Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors');
Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index'])->name('publishers');
Route::get('books', [App\Http\Controllers\BookController::class, 'index'])->name('books');
Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions');
Route::get('transaction-details', [App\Http\Controllers\TransactionDetailController::class, 'index'])->name('transaction-details');
