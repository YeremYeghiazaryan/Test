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
        PostNotificationStatus::where('sent', false)->orderBy('created_at')->chunk(100, function ($postNotificationStatuses) {
            foreach ($postNotificationStatuses as $postNotificationStatus) {
                SendMailToSubscribersJob::dispatch($postNotificationStatus);
            }
        });

    }
}
