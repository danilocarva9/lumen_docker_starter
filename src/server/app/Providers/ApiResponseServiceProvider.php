<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Responses\ApiResponse;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'laravel-api-response');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/laravel-api-response'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service the package provides.
        $this->app->singleton('ApiResponse', function ($app) {
            return new ApiResponse;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ApiResponse'];
    }
}