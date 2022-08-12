<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\JWTAuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('test', function () {
    dd('TEST');
});
Route::get('login', [JWTAuthController::class, 'unauthenticated'])->name('login');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [JWTAuthController::class, 'register']);
    Route::post('login', [JWTAuthController::class, 'login']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
    Route::post('refresh', [JWTAuthController::class, 'refresh']);
    Route::get('profile', [JWTAuthController::class, 'profile']);
});

Route::resource('users', UserController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::resource('items', ItemController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

