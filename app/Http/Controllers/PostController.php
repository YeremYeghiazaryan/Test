<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailToOwnerJob;
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
            'name' => 'required|min:5|max:255',
            'website_id' => 'required|exists:websites,id|integer',
            'title' => 'required|max:255',
        ], [
            'name.max' => 'The name may not be greater than 255 characters.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'name.required' => 'name is required',
            'website_id.required' => 'website is required',
            'title.required' => 'title is required',
            'website_id.integer' => 'website is required',
            'website_id.exists' => 'website is required',
            'name.min' => 'name must be at least 5 characters',

        ]);


        $post = Post::create($postData);
        if ($post) {
            SendMailToOwnerJob::dispatch($post);
        }
        return $post
            ? redirect()->route('index')->with('message', 'Created successfully!')
            : redirect()->back()->with('error', 'Failed to create post.');
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

        return redirect()->route('show-website',['id' => $post->website_id])->with('message', 'Verified successfully');
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
