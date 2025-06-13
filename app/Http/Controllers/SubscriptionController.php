<?php

namespace App\Http\Controllers;


use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'website_id' => 'required|integer|exists:websites,id',
        ], ['user_id.exists' => 'User does not exist',
            'user_id.required' => 'User ID is required',
            'user_id.integer' => 'User ID must be integer',
            'website_id.required' => 'Website ID is required',
            'website_id.integer' => 'Website ID must be integer',
            'website_id.exists' => 'Website ID does not exist',
        ]);


        $validatedUser = Subscription::where($validatedData)->first();

        if (!$validatedUser) {
            $userSubscribe = Subscription::create($validatedData);
            if ($userSubscribe) {
                return response()->json(['message' => 'Subscription created'], 201);
            } else {
                return response()->json(['message' => 'Subscription creation failed'], 500);
            }
        } else {
            return response()->json(['message' => 'The user is already subscribed'], 500);
        }
    }
}
