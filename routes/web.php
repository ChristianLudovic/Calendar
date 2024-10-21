<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
use App\Livewire\Components\LoginCard;
use App\Livewire\Components\OverviewCalendar;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (){
    Route::get('/', function(){
        return view('index');
    } )->name('index');
    Route::get('/login/{provider}', [AuthController::class, 'redirectToProvider'])->name('socialite.redirect');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
});

Route::get('/home', [HomeController::class, 'index'])->middleware(Authenticate::class)->name('home');

Route::get('/logout', [AuthController::class, 'logout']);

