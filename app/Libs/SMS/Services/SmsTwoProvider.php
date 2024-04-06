<?php

namespace App\Libs\SMS\Services;

use App\Libs\SMS\Contracts\SmsProvider;
use Illuminate\Support\Facades\Log;

class SmsTwoProvider implements SmsProvider
{
    public function sendMessage($phone, $message): void
    {
        // TODO: I'm using log instead of fake api not working well.

        Log::info('sms for user', ['provider' => 'two', 'message' => $message]);
    }
}
