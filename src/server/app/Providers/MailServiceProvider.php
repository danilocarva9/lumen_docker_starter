<?php

namespace App\Providers;

use App\Jobs\SendEmailJob;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service the package provides.
        $this->app->bind(SendEmailJob::class, function ($app) {
            return new SendEmailJob($params = []);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
    }
}
