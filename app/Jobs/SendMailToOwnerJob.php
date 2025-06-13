<?php

namespace App\Jobs;


use App\Mail\OwnerMessage;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailToOwnerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

        public Post $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->post->website->user;
        $email = $user->email;
        Mail::to($email)->send(new OwnerMessage($this->post));
    }
}
