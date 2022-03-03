<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionController;

use App\Models\Book;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   

Route::get('/books', [BookController::class,'index']);
Route::get('/members', [MemberController::class, 'index']);
Route::get('/catalogs', [CatalogController::class, 'index']);
Route::get('/publishers', [PublisherController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/transactions', [TransactionController::class,'index']);


// Route::get('create_transaction', function(){
//     $book = Book::findOrFail(1);

//     $book->transactions()->create([
        
//     ]);
// });