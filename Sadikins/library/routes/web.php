<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionDetailController;

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
// Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('members');

Route::resource('publishers', PublisherController::class);
Route::resource('catalogs', CatalogController::class);
Route::resource('authors', AuthorController::class);
Route::resource('members', MemberController::class);
Route::resource('books', BookController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('transaction_details', TransactionDetailController::class);


// Route::get('catalogs', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalogs');
// Route::get('catalogs/create', [App\Http\Controllers\CatalogController::class, 'create'])->name('catalogs.create');
// Route::post('catalogs', [App\Http\Controllers\CatalogController::class, 'store'])->name('catalogs.store');
// Route::get('catalogs/{catalog:id}/edit', [App\Http\Controllers\CatalogController::class, 'edit'])->name('catalogs.edit');
// Route::put('catalogs/{catalog:id}/edit', [App\Http\Controllers\CatalogController::class, 'update'])->name('catalogs.update');
// Route::delete('catalogs/{catalog:id}', [App\Http\Controllers\CatalogController::class, 'destroy'])->name('catalogs.destroy');

// Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index'])->name('publishers');
// Route::get('publishers/create', [App\Http\Controllers\PublisherController::class, 'create'])->name('publishers.create');
// Route::post('publishers', [App\Http\Controllers\PublisherController::class, 'store'])->name('publishers.store');
// Route::get('publishers/{publisher:id}/edit', [App\Http\Controllers\PublisherController::class, 'edit'])->name('publishers.edit');
// Route::put('publishers/{publisher:id}/edit', [App\Http\Controllers\PublisherController::class, 'update'])->name('publishers.update');
// Route::delete('publishers/{publisher:id}', [App\Http\Controllers\PublisherController::class, 'destroy'])->name('publishers.destroy');

// Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors');
// Route::get('authors/create', [App\Http\Controllers\AuthorController::class, 'create'])->name('authors.create');
// Route::post('authors', [App\Http\Controllers\AuthorController::class, 'store'])->name('authors.store');
// Route::get('authors/{author:id}/edit', [App\Http\Controllers\AuthorController::class, 'edit'])->name('authors.edit');
// Route::put('authors/{author:id}/edit', [App\Http\Controllers\AuthorController::class, 'update'])->name('authors.update');
// Route::delete('authors/{author:id}', [App\Http\Controllers\AuthorController::class, 'destroy'])->name('authors.destroy');

// Route::get('books', [App\Http\Controllers\BookController::class, 'index'])->name('books');
// Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions');
// Route::get('transaction-details', [App\Http\Controllers\TransactionDetailController::class, 'index'])->name('transaction-details');
