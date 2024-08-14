<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
//logout
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//category
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);

//product
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);

// address
Route::apiResource('addresses', App\Http\Controllers\Api\AddressController::class)->middleware('auth:sanctum');

//order
Route::post('/order', [App\Http\Controllers\Api\OrderController::class, 'order'])->middleware('auth:sanctum');

//callback
Route::post('/callback', [App\Http\Controllers\Api\CallbackController::class, 'callback']);

// check status order by id order
Route::get('/order/status/{id}', [App\Http\Controllers\Api\OrderController::class, 'checkStatusOrder'])->middleware('auth:sanctum');

//  update fcm id
Route::post('/update-fcm', [App\Http\Controllers\Api\AuthController::class, 'updateFcmId'])->middleware('auth:sanctum');

// get order by user
Route::get('/orders', [App\Http\Controllers\Api\OrderController::class, 'getOrderByUser'])->middleware('auth:sanctum');

// get order by id
Route::get('/order/{id}', [App\Http\Controllers\Api\OrderController::class, 'getOrderById'])->middleware('auth:sanctum');

// get detail product by id
Route::get('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);

// get all products by category id
Route::get('/category/{id}', [App\Http\Controllers\Api\CategoryController::class, 'showByCategory']);
Route::get('/feature/{id}', [App\Http\Controllers\Api\CategoryController::class, 'showByCategory']);

// search prdouct by name
Route::get('/search', [App\Http\Controllers\Api\ProductController::class, 'search']);

// get all products by Feature Id
Route::get('/feature/{id}', [App\Http\Controllers\Api\FeatureController::class, 'showByFeature']);
