<?php

namespace NFLScores\Providers;

use DateTime;
use DateTimeZone;
use Illuminate\Support\ServiceProvider;
use NFLScores\Http\NFLHttpClient;
use NFLScores\Models\NFL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NFL::class, function ($app) {
            return new NFL(new NFLHttpClient(), new DateTime('now', new DateTimeZone('US/Eastern')));
        });
    }
}
