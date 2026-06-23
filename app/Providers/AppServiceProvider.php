<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment(['production'])) {

            URL::forceRootUrl(config('app.url'));

            URL::forceScheme('https');
        }

        RateLimiter::for('report-submit', function (Request $request) {
            return Limit::perMinute(3)
                ->by($request->user()?->id ?: $request->ip());
        });
    }
}
