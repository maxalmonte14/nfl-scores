<?php

namespace Tests\Fakes;

use DateTime;
use DateTimeZone;
use NFLScores\Models\NFL;
use NFLScores\Providers\AppServiceProvider;

class FakeServiceProvider extends AppServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(NFL::class, function ($app) {
            return new NFL(new FakeNFLHttpClient(), new DateTime('2018-10-30', new DateTimeZone('US/Eastern')));
        });
    }
}
