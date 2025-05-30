<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('banners', [App\Http\Controllers\Api\BannerController::class, 'banner']);
Route::apiResource('products', App\Http\Controllers\Api\ProductController::class);

// middleware group
Route::group(['middleware' => ['auth:sanctum'], 'as' => 'api.'], function () {
    Route::apiResource('orders', App\Http\Controllers\Api\OrderController::class)->names('orders');
    Route::apiResource('customers', App\Http\Controllers\Api\CustomerController::class)->names('customers');

    Route::get('profile', [App\Http\Controllers\Api\ProfileController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Api\ProfileController::class, 'update']);

    Route::post('orders-payment/{order}', [App\Http\Controllers\Api\OrderController::class, 'payment']);
});
