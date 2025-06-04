<?php

namespace App\Console\Commands;


use App\Jobs\SendMailToSubscribersJob;
use App\Models\PostNotificationStatus;
use Illuminate\Console\Command;


class SendNotificationToSubscribersCommand extends Command
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
        $postNotificationStatuses = PostNotificationStatus::where('sent', false)->orderBy('created_at')->get();

        foreach ($postNotificationStatuses as $postNotificationStatus) {
            $post = $postNotificationStatus->post;
            SendMailToSubscribersJob::dispatch($post);
        }
    }
}
