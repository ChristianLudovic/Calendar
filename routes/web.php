<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/auth/{provider}', [AuthController::class, 'redirectToProvider'])->name('auth.redirect');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
});

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
    Route::get('/logout', [AuthController::class, 'logout']);
});


