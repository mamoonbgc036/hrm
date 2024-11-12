<?php

namespace App\Providers;

use App\Library\StationInterface;
use App\Repository\StationRepository;
use Illuminate\Support\ServiceProvider;

class StationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StationInterface::class, StationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
