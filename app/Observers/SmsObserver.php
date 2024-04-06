<?php

namespace App\Observers;

use App\Jobs\SendMessage;
use App\Libs\SMS\Contracts\SmsProvider;
use App\Models\User;

class SmsObserver
{
    /**
     * @param $model
     * @return void
     */
    public function created( $model): void
    {
        // TODO: you can join relationship user and get name and phone instead of this query.

        $user = User::query()->find($model->user_id);

        $message =  "Thank you $user->name";

        SendMessage::dispatch(phone:$user->phone, message:$message);
    }
}
