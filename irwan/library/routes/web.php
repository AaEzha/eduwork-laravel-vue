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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);

Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
Route::get('/create', [App\Http\Controllers\CatalogController::class, 'create']);
Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
Route::get('/edit', [App\Http\Controllers\CatalogController::class, 'edit']);
Route::put('/edit', [App\Http\Controllers\CatalogController::class, 'update']);
Route::delete('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);

Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index']);
Route::get('/createpublisher', [App\Http\Controllers\PublisherController::class, 'create']);
Route::post('/publishers', [App\Http\Controllers\PublisherController::class, 'store']);
Route::get('/edit', [App\Http\Controllers\PublisherController::class, 'edit']);
Route::put('/edit', [App\Http\Controllers\PublisherController::class, 'update']);
Route::delete('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'destroy']);

Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index']);
Route::get('/createauthor', [App\Http\Controllers\AuthorController::class, 'create']);
Route::post('/author', [App\Http\Controllers\AuthorController::class, 'store']);
Route::get('/edit', [App\Http\Controllers\AuthorController::class, 'edit']);
Route::put('/edit', [App\Http\Controllers\AuthorController::class, 'update']);
Route::delete('/author/{author}', [App\Http\Controllers\AuthorController::class, 'destroy']);