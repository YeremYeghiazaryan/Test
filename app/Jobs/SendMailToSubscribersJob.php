<?php

namespace App\Jobs;

use App\Mail\ContactMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;


class SendMailToSubscribersJob implements ShouldQueue
{
    use  Dispatchable, InteractsWithQueue, Queueable;

    public Collection $postNotificationStatuses;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection $postNotificationStatuses)
    {
        $this->postNotificationStatuses = $postNotificationStatuses;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->postNotificationStatuses as $postNotificationStatus) {
            $user = $postNotificationStatus->user;
            $post = $postNotificationStatus->post;
            Mail::to($user->email)->send(new ContactMessage($post));
            $postNotificationStatus->update([
                'sent' => true
            ]);
        }
    }
}
