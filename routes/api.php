<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'loginUser'])->name('login-user');
Route::post('/google/login', [AuthController::class, 'googleLogin'])->name('google-login');
Route::get('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout-user');

Route::post('/website/store', [WebsiteController::class, 'store'])->name('store-website');
Route::post('/website/update', [WebsiteController::class, 'update'])->name('update-website');
Route::post('/website/destroy', [WebsiteController::class, 'destroy'])->name('remove-website');
Route::get('/website/edit/{id}', [WebsiteController::class, 'edit'])->name('edit-website');
Route::get('/website/show', [WebsiteController::class, 'showAllWebsites'])->name('show-all-websites');
Route::get('/website/show/{id}', [WebsiteController::class, 'show'])->name('show-website');

Route::get('/post/create/{id}', [PostController::class, 'create'])->name('create-post');
Route::post('/post/store', [PostController::class, 'store'])->name('store-post');
Route::get('/post/show', [PostController::class, 'showAllPosts'])->name('show-all-posts');
Route::post('/post/destroy', [PostController::class, 'destroyPost'])->name('remove-post');
Route::get('/posts/verify/{id}', [PostController::class, 'verify'])->name('posts-verify');

Route::post('/website/subscribe', [SubscriptionController::class, 'subscribe']);

