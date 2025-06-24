<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailToOwnerJob;
use App\Models\PostNotificationStatus;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class
PostController extends Controller
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

    public function createINdex($id)
    {
        return view('dashboard.create_post', ['id' => $id]);
    }

    public function create($id)
    {
        $website = Website::find($id);
        if (!$website) {
            return response()->json([
                'status' => false,
                'message' => 'Website not found.'
            ], 404);
        }
        if ($website->user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }
        return response()->json([
            'status' => true,
            'data' => $website
        ]);
    }

    public function store(Request $request)
    {

        $postData = $request->validate([
            'name' => 'required|min:5|max:255',
            'website_id' => 'required|exists:websites,id|integer',
            'title' => 'required|max:255',
        ]);
        $post = Post::create($postData);

        if ($post) {
            SendMailToOwnerJob::dispatch($post);
        }

        return response()->json(["status" => true, "data" => $post]);
    }

    public function verify($id)
    {
        $post = Post::findOrFail($id);

        if (!$post->verified) {
            $post->verified = true;
            $post->save();

            $subscribers = Subscription::where('website_id', $post->website_id)->get();

            foreach ($subscribers as $subscriber) {
                PostNotificationStatus::create([
                    'post_id' => $post->id,
                    'user_id' => $subscriber->user_id,
                ]);
            }
        }

        return redirect()->route('show-website.dashboard', ['id' => $post->website_id])->with('message', 'Verified successfully');
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
