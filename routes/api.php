<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'store']);

    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/logout', [LoginController::class, 'logout']);

    Route::post('/refresh-token', [LoginController::class, 'refreshToken']);
});

Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index']);

    Route::post('/', [ContactController::class, 'store']);

    Route::put('/{contactId}', [ContactController::class, 'update']);

    Route::delete('/{contactId}', [ContactController::class, 'destroy']);
});

Route::prefix('appointments')->group(function () {
    Route::get('/', [AppointmentController::class, 'index']);

    Route::post('/', [AppointmentController::class, 'store']);

    Route::put('/{appointmentId}', [AppointmentController::class, 'update']);

    Route::delete('/{appointmentId}', [AppointmentController::class, 'destroy']);
});
