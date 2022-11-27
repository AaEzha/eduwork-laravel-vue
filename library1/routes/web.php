<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionController;
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
    return view('welcome');
});

Auth::routes();

Route::resource('/home', HomeController::class);
Route::resource('/catalogs', CatalogController::class);
Route::resource('/books', BookController::class);
Route::get('/api/books', [BookController::class, 'api']);


Route::resource('/members', MemberController::class);
Route::get('/api/members', [MemberController::class, 'api']);

Route::resource('/authors', AuthorController::class);
Route::get('/api/authors', [AuthorController::class, 'api']);

Route::resource('/publishers', PublisherController::class);
Route::get('/api/publishers', [PublisherController::class, 'api']);

Route::resource('/transactions', TransactionController::class);
// Route::get('/api/transactions', [TransactionController::class, 'api']);

