<?php

namespace App\Http\Controllers;
use App\Models\PostNotificationStatus;
use App\Models\SendSubscriber;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $postData = $request->validate([
            'name' => 'required',
            'website_id' => 'required|exists:websites,id|integer',
            'title' => 'required',
        ]);

        $post = Post::create($postData);

        PostNotificationStatus::create([
            'post_id' => $post->id
        ]);

        if ($post) {
            return response()->json([ 'post' => $post,'message' => 'post created'], 201);

        } else {
            return response()->json(['message' => 'post not created'], 500);
        }
    }
}
