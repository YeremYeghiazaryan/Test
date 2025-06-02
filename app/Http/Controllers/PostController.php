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
        ]);

        $post = Post::create($postData);
        if ($post) {
            sendMailSubscribers::dispatch($post);

        } else {
            return response()->json(['message' => 'Error'], 500);
        }
    }
}
