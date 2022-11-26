<?php

namespace App\Modules\HelpAndGuide\Providers;

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
        $this->loadTranslationsFrom(module_path('helpAndGuide', 'Resources/Lang', 'app'), 'helpAndGuide');
        $this->loadViewsFrom(module_path('helpAndGuide', 'Resources/Views', 'app'), 'helpAndGuide');
        $this->loadMigrationsFrom(module_path('helpAndGuide', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('helpAndGuide', 'Config', 'app'));
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
