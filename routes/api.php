<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Jobs\sendMailSubscribers;
use Illuminate\Support\Facades\Route;

Route::post('/post/store', [PostController::class, 'store']);
Route::post('/website/subscribe', [SubscriptionController::class, 'subscribe']);

