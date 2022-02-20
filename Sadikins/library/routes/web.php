<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionController;
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
    // $role = Role::first();
    // $role->givePermissionTo('manage transactions');
    // return $role;
    // $user = User::with('roles')->get();
    // return $user;
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('home');
// Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('members');

Route::resource('publishers', PublisherController::class);
Route::resource('catalogs', CatalogController::class);
Route::resource('authors', AuthorController::class);
Route::resource('members', MemberController::class);
Route::resource('books', BookController::class);
Route::resource('transactions', TransactionController::class);

Route::get('/api/authors', [AuthorController::class, 'api']);
Route::get('/api/publishers', [PublisherController::class, 'api']);
Route::get('/api/members', [MemberController::class, 'api']);
Route::get('/api/books', [BookController::class, 'api']);
Route::get('/api/transactions', [TransactionController::class, 'api']);
