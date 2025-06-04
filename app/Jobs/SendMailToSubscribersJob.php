<?php

namespace App\Jobs;

use App\Mail\ContactMessage;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class SendMailToSubscribersJob implements ShouldQueue
{
    use  Dispatchable, InteractsWithQueue, Queueable;

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
        $website = $this->post->website;
        $website->subscribers()
            ->orderBy('users.id')
            ->chunkById(1000, function ($subscribers) {
                foreach ($subscribers as $user) {
                    Mail::to($user->email)->send(new ContactMessage($this->post));
                }
            });

        $this->post->postNotificationStatus()->update([
            'sent' => true
        ]);
    }
}
