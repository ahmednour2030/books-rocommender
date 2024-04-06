<?php

namespace App\Libs\SMS\Contracts;

interface SmsProvider
{
    /**
     * @param $phone
     * @param $message
     */
    public function sendMessage($phone, $message);
}
