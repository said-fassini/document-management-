<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresidentController;

// Define the route for the home dashboard
Route::get('/', [PresidentController::class, 'home'])->name('home');

Route::get('/home', [PresidentController::class, 'home'])->name('president.home');
Route::get('/create-user', [PresidentController::class, 'createUser'])->name('president.create-User');
Route::get('/view-docs', [PresidentController::class, 'viewDocuments'])->name('president.view-Docs');
Route::get('/view-services', [PresidentController::class, 'viewServices'])->name('president.view-Services');
Route::get('/view-actions', [PresidentController::class, 'viewActions'])->name('president.view-Actions');
Route::post('/president/store-user', [PresidentController::class, 'storeUser'])->name('president.storeUser');
