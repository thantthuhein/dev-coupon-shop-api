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

// Coupons
Route::post('coupons', [App\Http\Controllers\CouponController::class, 'store']);
Route::get('coupons', [App\Http\Controllers\CouponController::class, 'index']);
Route::get('coupons/{coupon}', [App\Http\Controllers\CouponController::class, 'show']);
Route::put('coupons/{coupon}', [App\Http\Controllers\CouponController::class, 'update']);
Route::delete('coupons/{coupon}', [App\Http\Controllers\CouponController::class, 'destroy']);

// Shops
Route::post('shops', [App\Http\Controllers\ShopController::class, 'store']);
Route::get('shops', [App\Http\Controllers\ShopController::class, 'index']);
Route::get('shops/{shop}', [App\Http\Controllers\ShopController::class, 'show']);
Route::put('shops/{shop}', [App\Http\Controllers\ShopController::class, 'update']);
Route::delete('shops/{shop}', [App\Http\Controllers\ShopController::class, 'destroy']);

// CouponShops
Route::post('coupons/{coupon}/shops', [App\Http\Controllers\CouponShopController::class, 'store']);
Route::get('coupons/{coupon}/shops', [App\Http\Controllers\CouponShopController::class, 'index']);
Route::get('coupons/{coupon}/shops/{shop}', [App\Http\Controllers\CouponShopController::class, 'show']);
Route::delete('coupons/{coupon}/shops/{shop}', [App\Http\Controllers\CouponShopController::class, 'destroy']);

