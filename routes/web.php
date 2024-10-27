<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresidentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/president/dashboard', [PresidentController::class, 'index'])->name('president.dashboard');

use App\Http\Controllers\Auth\AuthenticatedSessionController;  

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');  
Route::post('/login', [AuthenticatedSessionController::class, 'store']);  
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');