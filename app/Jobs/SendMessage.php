<?php

namespace App\Jobs;

use App\Libs\SMS\Contracts\SmsProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected SmsProvider $provider, protected $phone, protected $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->provider->sendMessage($this->phone, $this->message);
    }
}
