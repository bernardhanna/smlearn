<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SpacedRepetitionService;

class SpacedRepetitionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SpacedRepetitionService::class, function ($app) {
            return new SpacedRepetitionService();
        });
    }

    public function boot()
    {
        //
    }
}
