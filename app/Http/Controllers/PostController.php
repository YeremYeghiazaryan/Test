<?php

namespace App\Http\Controllers;

use App\Models\PostNotificationStatus;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function showAllPosts(Request $request)
    {
        $websiteId = $request->get('website_id');
        $posts = Post::where('website_id', $websiteId)->get();

        return response()->json([
            'status' => true,
            'data' => $posts
        ]);
    }

    public function create($id)
    {
        return view('dashboard.create_post', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $postData = $request->validate([
            'name' => 'required|min:5',
            'website_id' => 'required|exists:websites,id|integer',
            'title' => 'required',
        ], [
            'name.required' => 'name is required',
            'website_id.required' => 'website is required',
            'title.required' => 'title is required',
            'website_id.integer' => 'website is required',
            'website_id.exists' => 'website is required',
            'name.min' => 'name must be at least 5 characters',

        ]);

        $post = Post::create($postData);
        $subscribers = Subscription::where('website_id', $post->website_id)->get();
        foreach ($subscribers as $subscriber) {
            PostNotificationStatus::create([
                'post_id' => $post->id,
                'user_id' => $subscriber->user_id,
            ]);
        }
        return $post
            ? redirect()->route('index')->with('message', 'Created successfully!')
            : redirect()->back()->with('error', 'Failed to create post.');
    }

    public function destroyPost(Request $request)
    {
        $id = $request->get('post_id');
        $destroy = Post::destroy($id);
        if ($destroy) {
            return response()->json([
                'status' => true,
                'message' => 'Post deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
