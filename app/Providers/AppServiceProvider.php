<?php

namespace App\Providers;

use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $view->with([
                /*'user' => Auth::user(),*/
                'divisions' => Division::orderBy('name', 'ASC')->get(),
                'districts' => District::orderBy('name', 'ASC')->get(),
                'upazilas' => Upazila::orderBy('name', 'ASC')->get(),
                'villages' => Village::orderBy('name', 'ASC')->get()
            ]);
        });
    }
}
