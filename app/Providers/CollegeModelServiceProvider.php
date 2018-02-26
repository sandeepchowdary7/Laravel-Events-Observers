<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Enrollment;

class CollegeModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Enrollment::observe(\App\Observer\CollegeObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
