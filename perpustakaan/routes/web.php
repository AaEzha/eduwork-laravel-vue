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

Route::get('/home', [HomeController::class, 'index']);

Route::get('/catalogs', [CatalogController::class, 'index']);
Route::get('/catalogs/create', [CatalogController::class, 'create']);
Route::post('/catalogs', [CatalogController::class, 'store']);
Route::get('/catalogs/{catalog}/edit', [CatalogController::class, 'edit']);
Route::put('/catalogs/{catalog}', [CatalogController::class, 'update']);
Route::delete('/catalogs/{catalog}', [CatalogController::class, 'destroy']);

Route::resource('/publishers', PublisherController::class);

Route::resource('/authors', AuthorController::class);
// Route::get('/authors', [AuthorController::class, 'index']);
// Route::get('/authors/create', [AuthorController::class, 'create']);
// Route::post('/authors', [AuthorController::class, 'store']);
// Route::get('/authors/{author}/edit', [AuthorController::class, 'edit']);
// Route::put('/authors/{author}', [AuthorController::class, 'update']);
// Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/members', [MemberController::class, 'index']);
Route::get('/transactions', [TransactionController::class, 'index']);
