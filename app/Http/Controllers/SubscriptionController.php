<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'website_id' => 'required|integer|exists:websites,id',
        ]);

        $validatedUser = Subscription::where($validatedData)->first();

        if (!$validatedUser) {
            $userSubscribe = Subscription::create($validatedData);
            if ($userSubscribe) {
                return response()->json(['message' => 'Subscription created'], 201);
            }
        } else {
            return response()->json(['message' => 'The user is already subscribed'], 500);
        }
    }
}
