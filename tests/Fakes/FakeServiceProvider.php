<?php

namespace Tests\Fakes;

use Illuminate\Support\ServiceProvider;

class FakeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \Tests\Fakes\FakeFinishedCommand::class,
            \Tests\Fakes\FakeLiveCommand::class,
            \Tests\Fakes\FakeTodayCommand::class,
            \Tests\Fakes\FakeWeekCommand::class,
        ]);
    }
}
