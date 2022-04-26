<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\TransactionNotification;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
Route::get('/catalogs/create', [App\Http\Controllers\CatalogController::class, 'create']);
Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
Route::get('/catalogs/{catalog}/edit', [App\Http\Controllers\CatalogController::class, 'edit']);
Route::put('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'update']);
Route::delete('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);

Route::resource('/authors', App\Http\Controllers\AuthorController::class);
Route::resource('/publishers', App\Http\Controllers\PublisherController::class);
Route::resource('/books', App\Http\Controllers\BookController::class);
Route::resource('/members', App\Http\Controllers\MemberController::class);
Route::resource('/transactions', App\Http\Controllers\TransactionController::class);
Route::get('test_spatie', [App\Http\Controllers\AdminController::class, 'test_spatie']);

Route::get('api/authors', [App\Http\Controllers\AuthorController::class, 'api']);
Route::get('api/publishers', [App\Http\Controllers\PublisherController::class, 'api']);
Route::get('api/books', [App\Http\Controllers\BookController::class, 'api']);
Route::get('api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::get('api/transactions', [App\Http\Controllers\TransactionController::class, 'api']);

Route::get('/spatie', function () {
    $role = Spatie\Permission\Models\Role::whereName('officer')->exists() ? Spatie\Permission\Models\Role::whereName('officer')->first() : Spatie\Permission\Models\Role::create(['name' => 'officer']);
    $permission = Spatie\Permission\Models\Permission::where(['name' => 'index transactions'])->exists() ?  Spatie\Permission\Models\Permission::where(['name' => 'index transactions'])->first() : Spatie\Permission\Models\Permission::create(['name' => 'index transactions']);

    $role->givePermissionTo($permission);
    $permission->assignRole($role);

    $user = auth()->user();
    $user->assignRole('officer');

    $user = User::with('roles')->get();

    $user = User::where('id', 2)->first();
    if ($user) $user->removeRole('officer');

    return response()->json('Sukses');
});
