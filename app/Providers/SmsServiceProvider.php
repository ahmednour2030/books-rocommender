<?php

namespace App\Providers;

use App\Libs\SMS\Contracts\SmsProvider;
use App\Models\ReadingIntervals;
use App\Observers\SmsObserver;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Get Class for active sms provider
        $provider = config('sms.providers')[strtolower(config('sms.provider'))];

        // bin sms provider you can send via provider
        $this->app->bind(SmsProvider::class, $provider);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ReadingIntervals::observe(SmsObserver::class);
    }
}
