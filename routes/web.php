<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'Login']);
Route::post('/login', [AuthController::class, 'LoginAction']);

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard', [AdminController::class, 'Dashboard']);
    Route::get('/auth/logout', [AuthController::class, 'Logout']);
});