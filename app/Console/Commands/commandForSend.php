<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use App\Jobs\sendMailSubscribers;
use Illuminate\Support\Facades\Cache;

class commandForSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mailSubscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastPostTime = Cache::get('last_post_time', now()->subMinutes(2));
        $newPosts = Post::where("created_at", ">", $lastPostTime)->orderBy('created_at')->get();

        if($newPosts->isNotEmpty()) {
            foreach ($newPosts as $post) {
                sendMailSubscribers::dispatch($post);
            }
            Cache::put('last_post_time', $newPosts->last()->created_at);
        }

    }
}
