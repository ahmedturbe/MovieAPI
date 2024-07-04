<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\ActorController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\FavoriteController;
use App\Http\Controllers\Api\V1\FollowController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});
Route::prefix('v1')
->middleware('auth:api')
->group(function () {
    Route::apiResource('/actors', ActorController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/movies', MovieController::class);
    Route::controller(FavoriteController::class)->group(function () {
        Route::post('favorites', 'store');
        Route::delete('favorites', 'destroy');
    });
    Route::controller(FollowController::class)->group(function () {
        Route::post('follows', 'store');
        Route::delete('follows', 'destroy');
    });
});

