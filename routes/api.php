<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/post/store', [PostController::class, 'store']);
Route::post('/website/subscribe', [SubscriptionController::class, 'subscribe']);
















