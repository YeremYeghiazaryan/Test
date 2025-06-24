<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
Route::redirect('/', '/login')->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/post/create/{id}', [PostController::class, 'createIndex'])->name('create-post.dashboard');

Route::get('/website/edit/{id}', [WebsiteController::class, 'editIndex'])->name('edit-website.dashboard');
Route::get('/website/create', [WebsiteController::class, 'create'])->name('create-website');
Route::get('/dashboard', [WebsiteController::class, 'index'])->name('dashboard');
Route::get('/website/show/{id}', [WebsiteController::class, 'showIndex'])->name('show-website.dashboard');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
