<?php

use App\Models\Subscription;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/asd', function () {
    $users = \App\Models\User::get();
    foreach ($users as $user) {
        Subscription::create([
            'user_id' => $user->id,
            'website_id' => 1,
        ]);
    }
});
