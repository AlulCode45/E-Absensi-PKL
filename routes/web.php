<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'Login']);
Route::post('/login', [AuthController::class, 'LoginAction']);
Route::get('/absent', [AbsentController::class, 'absent']);
Route::post('/absent', [AbsentController::class, 'absentAction']);

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'Dashboard']);
        Route::get('/kelola-siswa', [AdminController::class, 'ManageStudents']);
        Route::get('/kelola-siswa/{id}', [AdminController::class, 'viewStudent']);
        Route::post('/kelola-siswa/add', [AdminController::class, 'addStudent'])->name('add-student');
        Route::get('/edit-student/{id}', [AdminController::class, 'editStudent']);
        Route::get('/delete-student/{id}', [AdminController::class, 'deleteStudent']);
        Route::post('/edit-student/{id}', [AdminController::class, 'updateStudent'])->name('update-student');
    });



    Route::get('/auth/logout', [AuthController::class, 'Logout']);
});