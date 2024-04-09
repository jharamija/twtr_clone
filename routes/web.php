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

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::apiResource('posts', PostController::class);
});
