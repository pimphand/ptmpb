<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('banners', [App\Http\Controllers\Api\BannerController::class, 'banner']);
Route::apiResource('products', App\Http\Controllers\Api\ProductController::class);

//middleware group
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('orders', App\Http\Controllers\Api\OrderController::class);
    Route::apiResource('customers', App\Http\Controllers\Api\CustomerController::class);
});
