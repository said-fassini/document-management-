<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresidentController;
use App\Http\Controllers\BureauController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;  

 

use App\Http\Controllers\DgsController;




// Define the route for the home dashboard
//Prisident route
Route::get('/home', [PresidentController::class, 'home'])->name('president.home');
Route::get('/create-user', [PresidentController::class, 'createUser'])->name('president.create-User');
Route::get('/view-docs', [PresidentController::class, 'viewDocuments'])->name('president.view-Docs');
Route::get('/view-services', [PresidentController::class, 'viewServices'])->name('president.view-Services');
Route::get('/view-actions', [PresidentController::class, 'viewActions'])->name('president.view-Actions');
Route::post('/president/store-user', [PresidentController::class, 'storeUser'])->name('president.storeUser');
Route::get('/president/dashboard', [PresidentController::class, 'index'])->name('president.dashboard');

//route auth

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');  
Route::post('/', [AuthenticatedSessionController::class, 'store']);  
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//bereau dorder root
Route::middleware(['auth'])->prefix('bureau')->group(function () {
    Route::get('/home', [BureauController::class, 'home'])->name('bureau.home');
    Route::get('/received', [BureauController::class, 'received'])->name('bureau.received');
    Route::post('/received', [BureauController::class, 'received'])->name('bureau.received');
    Route::post('/download/{id}', [BureauController::class, 'download'])->name('bureau.download');
    Route::post('/forward/{id}', [BureauController::class, 'forward'])->name('bureau.forward');
    Route::get('/archive', [BureauController::class, 'archive'])->name('bureau.archive');
     Route::get('/bureau/archive', [BureauController::class, 'showArchive'])->name('bureau.archive');

});


// services route

Route::middleware(['auth'])->group(function () {
    Route::get('/service/index', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/receive', [ServiceController::class, 'receive'])->name('service.receive');
    Route::get('/service/archive', [ServiceController::class, 'archive'])->name('service.archive');
    Route::get('/service/upload', [DocumentController::class, 'showUploadForm'])->name('service.upload');
    Route::post('/service/upload', [DocumentController::class, 'upload'])->name('service.upload.submit');
    Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
    Route::patch('/documents/mark-as-read/{id}', [DocumentController::class, 'markAsRead'])->name('documents.markAsRead');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dgs', [DgsController::class, 'home'])->name('dgs.home');
    Route::get('/received', [DgsController::class, 'received'])->name('dgs.received');
    Route::post('/received', [DgsController::class, 'received'])->name('dgs.received');
    Route::post('/download/{id}', [DgsController::class, 'download'])->name('dgs.download');
    Route::post('/forward/{id}', [DgsController::class, 'forward'])->name('dgs.forward');
    Route::get('/archive', [DgsController::class, 'showArchive'])->name('dgs.archive');
});
