<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ChartController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/orders', OrderController::class);
Route::resource('/products', ProductController::class);
Route::resource('/suppliers', SupplierController::class);
Route::resource('/users', UserController::class);
Route::resource('/transactions', TransactionController::class);
Route::get('/barcode', [App\Http\Controllers\ProductController::class, 'getproductbarcodes'])->name('products.barcode');
Route::resource('/charts', ChartController::class);
Route::delete('/multiple_deleted',  [ChartController::class, 'deletemultiple'])->name('multiple_deleted');
Route::resource('/customers', CustomerController::class);
Route::resource('/sections', SectionController::class);
Route::delete('/deleteselected',  [SectionController::class, 'deletemultiple'])->name('deleteselected');
Route::resource('/categories', CategoryController::class);
Route::resource('/subcategories', SubCategoryController::class);
Route::get('test_spatie', [App\Http\Controllers\UserController::class, 'test_spatie']);
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout']);
Route::get('receipt', function () {
    return view('receipt');
});
