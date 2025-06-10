<?php

namespace App\Jobs;

use App\Mail\ContactMessage;
use App\Models\Post;
use App\Models\PostNotificationStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class SendMailToSubscribersJob implements ShouldQueue
{
    use  Dispatchable, InteractsWithQueue, Queueable;

    public PostNotificationStatus $postNotificationStatus;

    /**
     * Create a new job instance.
     */
    public function __construct(PostNotificationStatus $postNotificationStatus)
    {
        $this->postNotificationStatus = $postNotificationStatus;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->postNotificationStatus->user;
        $post = $this->postNotificationStatus->post;
        Mail::to($user->email)->send(new ContactMessage($post));
        $this->postNotificationStatus->update([
            'sent' => true
        ]);
    }
}
