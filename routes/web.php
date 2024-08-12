<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'Login']);
Route::get('/dashboard', [AdminController::class, 'Dashboard']);