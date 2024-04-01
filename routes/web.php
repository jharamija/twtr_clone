<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    return response([
        'message' => 'Hello world',
    ], 200)->header('Access-Control-Allow-Origin', 'http://localhost:5173', 'Access-Control-Allow-Credentials', 'true');
});

Route::apiResource('users', UserController::class);

Route::apiResource('posts', PostController::class);
