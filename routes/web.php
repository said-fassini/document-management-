<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresidentController;
use App\Http\Controllers\BureauController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;  

 
// Define the route for the home dashboard
// Route::get('/', [PresidentController::class, 'home'])->name('home');

Route::get('/home', [PresidentController::class, 'home'])->name('president.home');
Route::get('/create-user', [PresidentController::class, 'createUser'])->name('president.create-User');
Route::get('/view-docs', [PresidentController::class, 'viewDocuments'])->name('president.view-Docs');
Route::get('/view-services', [PresidentController::class, 'viewServices'])->name('president.view-Services');
Route::get('/view-actions', [PresidentController::class, 'viewActions'])->name('president.view-Actions');
Route::post('/president/store-user', [PresidentController::class, 'storeUser'])->name('president.storeUser');



Route::get('/president/dashboard', [PresidentController::class, 'index'])->name('president.dashboard');


Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');  
Route::post('/', [AuthenticatedSessionController::class, 'store']);  
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// routes/web.php


Route::middleware(['auth'])->prefix('bureau')->group(function () {
    Route::get('/home', [BureauController::class, 'home'])->name('bureau.home');
    Route::get('/received', [BureauController::class, 'received'])->name('bureau.received');
    Route::post('/received', [BureauController::class, 'received'])->name('bureau.received');
    Route::post('/download/{id}', [BureauController::class, 'download'])->name('bureau.download');
    Route::post('/forward/{id}', [BureauController::class, 'forward'])->name('bureau.forward');
    //Route::get('/archive', [BureauController::class, 'archive'])->name('bureau.archive');
     Route::get('/bureau/archive', [BureauController::class, 'showArchive'])->name('bureau.archive');

});
