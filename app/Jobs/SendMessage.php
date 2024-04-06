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

    protected SmsProvider $provider;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $phone, protected $message)
    {
    }

    /**
     * @param SmsProvider $provider
     * @return void
     */
    public function handle(SmsProvider $provider): void
    {
        $this->provider = $provider;
        $this->provider->sendMessage($this->phone, $this->message);
    }
}
