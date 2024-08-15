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
//register
Route::get('/register', [AuthController::class, 'Register']);
Route::post('/register', [AuthController::class, 'RegisterAction']);

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/settings', [AdminController::class, 'settings']);
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('updateSettings');
        Route::get('/', [AdminController::class, 'Dashboard']);
        Route::prefix('/kelola-siswa')->group(function () {
            Route::get('/', [AdminController::class, 'ManageStudents']);
            Route::get('/{id}', [AdminController::class, 'viewStudent']);
            Route::post('/add', [AdminController::class, 'addStudent'])->name('add-student');
            Route::get('/edit/{id}', [AdminController::class, 'editStudent']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteStudent']);
            Route::post('/edit/{id}', [AdminController::class, 'updateStudent'])->name('update-student');
        });

        Route::prefix('/kelola-devisi')->group(function () {
            Route::get('/', [AdminController::class, 'ManageDivisions']);
            Route::post('/add', [AdminController::class, 'addDivision'])->name('add-division');
            Route::get('/edit/{id}', [AdminController::class, 'editDivision']);
            Route::post('/edit/{id}', [AdminController::class, 'updateDivision'])->name('update-division');
            Route::get('/delete/{id}', [AdminController::class, 'deleteDivision']);
        });

        Route::prefix('/kelola-sekolah')->group(function () {
            Route::get('/', [AdminController::class, 'ManageSchools']);
            Route::post('/add', [AdminController::class, 'addSchool'])->name('add-school');
            Route::get('/edit/{id}', [AdminController::class, 'editSchool']);
            Route::post('/edit/{id}', [AdminController::class, 'updateSchool'])->name('update-school');
            Route::get('/delete/{id}', [AdminController::class, 'deleteSchool']);
        });

        Route::prefix('/kelola-absensi')->group(function () {
            Route::get('/', [AdminController::class, 'ManageAbsents']);
            Route::get('/delete-absent/{id}', [AdminController::class, 'deleteAbsent']);
        });
    });



    Route::get('/auth/logout', [AuthController::class, 'Logout']);
});