<?php

use App\Http\Controllers\BasketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use \App\Http\Middleware\Cors;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('products', [ProductController::class, 'index']);
Route::get('product', [ProductController::class, 'findById']);
Route::post('addToCart', [BasketController::class, 'store']);
Route::post('baskets', [BasketController::class, 'selectCartItemByEmail']);
Route::get('cart', [BasketController::class, 'index']);


Route::middleware(Cors::class)->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('normalWay', [ProductController::class, 'normalWay']);
});

/*Route::middleware('auth:api')->group(function () {
    Route::resource('products', ProductController::class);
});*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});







