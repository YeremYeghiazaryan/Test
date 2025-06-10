<?php

use App\Http\Controllers\AuthController;


use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
Route::get('/',function(){
    return view('auth.login');
} );


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login-user');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'index'])->name('index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/create/post/{id}', [PostController::class, 'create'])->name('create-post');
    Route::post('/post/store', [PostController::class, 'store'])->name('store-post');
    Route::get('post/destroy', [PostController::class, 'destroyPost'])->name('remove-post');
    Route::get('post/show', [PostController::class, 'showAllPosts'])->name(  'show-all-posts');

    Route::get('/create/website', [WebsiteController::class, 'create'])->name('create-website');
    Route::post('/store/website', [WebsiteController::class, 'store'])->name('store-website');
    Route::get('website/destroy', [WebsiteController::class, 'destroy'])->name('remove-website');
    Route::get('/edit/{id}', [WebsiteController::class, 'edit'])->name('edit-website');
    Route::post('/update', [WebsiteController::class, 'update'])->name('update-website');
    Route::get('/website/show', [WebsiteController::class, 'showAllWebsites'])->name('show-all-websites');
    Route::get('/show/{id}', [WebsiteController::class, 'show'])->name('show-website');

});



