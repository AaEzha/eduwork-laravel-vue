<?php

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionController;

// use App\Models\Book;

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   

Route::resource('catalogs', CatalogController::class);
// Route::get('/catalogs',[CatalogController::class, 'index']);
// Route::get('/catalogs/create',[CatalogController::class, 'create']);
// Route::post('/catalogs',[CatalogController::class, 'store']);
// Route::get('/catalogs/{catalog}/edit',[CatalogController::class, 'edit']);
// Route::put('/catalogs/{catalog}',[CatalogController::class, 'update']);
// Route::delete('/catalogs/{catalog}',[CatalogController::class, 'destroy']);
Route::get('/home', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('home');
Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
Route::resource('publishers', PublisherController::class);
Route::resource('authors', AuthorController::class);
Route::resource('transactions', TransactionController::class);
// Route::resource('dashboard', AdminController::class);

Route::get('api/authors', [AuthorController::class, 'api']);
Route::get('api/publishers', [PublisherController::class, 'api']);
Route::get('api/members', [MemberController::class, 'api']);
Route::get('api/books', [BookController::class, 'api']);
Route::get('api/transactions', [TransactionController::class, 'api']);

// Route::get('create_transaction', function(){
//     $book = Book::findOrFail(1);

//     $book->transactions()->create([
        
//     ]);
// });