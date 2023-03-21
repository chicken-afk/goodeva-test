<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Artisan;

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

/**
 * Login Page
 */
Route::get('/login', [AdminController::class, 'loginPage'])->name('loginPageAdmin');
Route::post('/login', [AdminController::class, 'login'])->name('loginAdmin');
Route::get('/logout', [AdminController::class, 'logout'])->name('logoutAdmin');


/**
 * Dashboard Page
 */

Route::middleware(['login'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route Product
    Route::get('/products', [ProductController::class, 'index'])->name('getProduct');
    Route::get('/products-add', [ProductController::class, 'addProductPage'])->name('addProductPage');
    Route::post('/product-post', [ProductController::class, 'store'])->name('postProduct');
    Route::get('/stock-edit/{uuid}', [ProductController::class, 'editStock'])->name('editStock');
    Route::get('/delete-product/{uuid}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
    Route::get('/bundle-add', [ProductController::class, 'createBundlePage'])->name('createBundlePage');
    Route::post('/bundle-store', [ProductController::class, 'storeBundle'])->name('storeBundle');

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

    /**Route Orders */
    Route::get('/orders', [OrderController::class, 'index'])->name('getOrders');
    Route::get('/order-datas', [OrderController::class, 'orderData'])->name('orderDataApi');
    Route::post('/payment', [OrderController::class, 'payment'])->name('paymentApi');

    /**Live Order Data */
    Route::get('/live-order', [OrderController::class, 'liveOrder'])->name('liveOrder');
    Route::get('/live-order-data', [OrderController::class, 'liveOrderData'])->name('liveOrderData');
    Route::post('/change-status', [OrderController::class, 'editStatus'])->name('editStatusInvoice');

    Route::get('/user-management', [UserManagementController::class, 'index'])->name('userManagement');
    Route::post('/user', [UserManagementController::class, 'store'])->name('postUser');
    Route::get('/delete-user/{uuid}', [UserManagementController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/update-user', [UserManagementController::class, 'updateUser'])->name('updateUsers');

    /**Setting */
    Route::get('/setting', [AdminController::class, 'setting'])->name('settingPage');
    Route::post('/setting-save', [AdminController::class, 'saveSetting'])->name('saveSetting');

    /**Statistic Route */
    Route::get('/statistic', [StatisticController::class, 'view'])->name('getStatistic');
    /**Chart Data Based On Omset Per Month */
    Route::get('/statistic-omset', [StatisticController::class, 'statisticOmset'])->name('statisticOmset');
    /**Chart Data Based On Outlet*/
    Route::get('/statistic-outlet', [StatisticController::class, 'statisticOutlet'])->name('statisticOutlet');
    /**Chart Data Based On Product*/
    Route::get('/statistic-product', [StatisticController::class, 'statisticProduct'])->name('statisticProduct');
});



/**
 * Route For Users
 */

Route::get('/', [UserController::class, 'view'])->name('userPage');
Route::get('/carts', [UserController::class, 'carts'])->name('cartPage');
Route::post('/carts', [UserController::class, 'storeCart'])->name('storeCart');
Route::get('/invoice', [UserController::class, 'invoice'])->name('invoice');

/** Artisan **/
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Application storage Link Added!';
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared!';
});

Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    return 'Application config cleared!';
});
