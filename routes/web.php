<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginBlade'])->name('loginBlade');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'indexBlade'])->name('indexBlade');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/create', [WebsiteController::class, 'create'])->name('createWebsiteBlade');
    Route::post('/store', [WebsiteController::class, 'store'])->name('storeWebsite');
    Route::get('/show', [WebsiteController::class, 'showAllWebsites'])->name('showAllWebsites');
    Route::get('/destroy', [WebsiteController::class, 'destroy'])->name('destroyWebsite');
    Route::get('/edit/{id}', [WebsiteController::class, 'edit'])->name('editWebsiteBlade');
    Route::post('/update', [WebsiteController::class, 'update'])->name('updateWebsite');


});
