<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\AuthenticateSession;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    return response([
        'message' => 'Hello world',
    ], 200);
});

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::apiResource('users', UserController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    // {app}/auth/logout -> token has to be in authorization header
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api')->name('logout');
    // {app}/auth/me -> token has to be in authorization header
    Route::post('/me', [LoginController::class, 'getAuthUser'])->middleware('auth:api')->name('getAuthUser');
    // {app}/auth/refresh -> token has to be in authorization header
    Route::post('/refresh', [LoginController::class, 'refreshToken'])->middleware('auth:api')->name('refreshToken');
});

// Route::middleware(['auth', 'auth.session'])->group(function () {
//     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//     Route::apiResource('posts', PostController::class);
// });
