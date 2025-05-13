<?php

namespace App\Providers;

use App\Services\CometChatService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CometChatService::class, function ($app) {
            return new CometChatService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (isset($_SERVER['HTTPS']) || request()->header('x-forwarded-proto') === 'https') {
        URL::forceScheme('https');
    }
    }
}
