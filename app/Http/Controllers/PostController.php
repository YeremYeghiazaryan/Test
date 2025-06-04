<?php

namespace App\Http\Controllers;

use App\Jobs\sendMailSubscribers;
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
        if ($post) {
            return response()->json([ 'post' => $post,'message' => 'post created'], 201);

        } else {
            return response()->json(['message' => 'post not created'], 500);
        }
    }
}
