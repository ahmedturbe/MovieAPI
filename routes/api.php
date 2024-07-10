<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\ActorController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\MovieController;
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
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('movies', [MovieController::class, 'index']);
    Route::get('movies/{slug}', [MovieController::class, 'show']);
    Route::post('movies', [MovieController::class, 'store']);
    Route::put('movies/{slug}', [MovieController::class, 'update']);
    Route::post('movies/{slug}/follow', [MovieController::class, 'follow']);
    Route::post('movies/{slug}/unfollow', [MovieController::class, 'unfollow']);
    Route::post('movies/{slug}/favorite', [MovieController::class, 'favorite']);
    Route::post('movies/{slug}/unfavorite', [MovieController::class, 'unfavorite']);
    Route::apiResource('/categories', CategoryController::class);
    Route::get('actors', [ActorController::class, 'index']);
});
