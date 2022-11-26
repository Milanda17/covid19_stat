<?php

namespace App\Modules\CovidData\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('covidData', 'Resources/Lang', 'app'), 'covidData');
        $this->loadViewsFrom(module_path('covidData', 'Resources/Views', 'app'), 'covidData');
        $this->loadMigrationsFrom(module_path('covidData', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('covidData', 'Config', 'app'));
        }
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
