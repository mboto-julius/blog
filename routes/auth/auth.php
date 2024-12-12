<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('login', 'auth.login')->name('login');

Route::controller(AuthController::class)->group(function () {
    Route::post('authenticate', 'login')->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout')->name('logout');
    });
    Route::view('dashboard', 'backend.index')->name('dashboard');
});