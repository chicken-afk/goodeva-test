<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProductController;
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


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route Product
Route::get('/products', [ProductController::class, 'index'])->name('getProduct');
Route::get('/products-add', [ProductController::class, 'addProductPage'])->name('addProductPage');
Route::post('/product-post', [ProductController::class, 'store'])->name('postProduct');
Route::get('/stock-edit/{uuid}', [ProductController::class, 'editStock'])->name('editStock');
Route::get('/delete-product/{uuid}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
Route::get('/bundle-add', [ProductController::class, 'createBundlePage'])->name('createBundlePage');

// Route Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('getCategory');
Route::post('/categories', [CategoryController::class, 'add'])->name('postCategory');
Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
Route::post('/update-category', [CategoryController::class, 'updateCategory'])->name('updateCategory');

// Route Outlet
Route::get('/outlets', [OutletController::class, 'index'])->name('getOutlets');
Route::post('/outlets', [OutletController::class, 'add'])->name('postOutlet');
Route::get('/delete-outlet/{id}', [OutletController::class, 'deleteOutlet'])->name('deleteOutlet');
Route::post('/update-outlet', [OutletController::class, 'updateOutlet'])->name('updateOutlet');
