<?php

namespace App\Providers;

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
        $this->app->bind('App\Modules\CovidData\Contracts\CovidDataRepositoryInterface', 'App\Modules\CovidData\Repositories\CovidDataRepository');
        $this->app->bind('App\Modules\HelpAndGuide\Contracts\HelpAndGuideRepositoryInterface', 'App\Modules\HelpAndGuide\Repositories\HelpAndGuideRepository');
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
