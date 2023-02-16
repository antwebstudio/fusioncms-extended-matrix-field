<?php

namespace Addons\ExtendedMatrixFieldtype\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    /**
     * Register any addon services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any addon services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $addonName = 'ExtendedMatrixFieldtype';
        $basePath = dirname(dirname(dirname(__FILE__)));

        if (!File::isDirectory(public_path("addons"))) {
            File::makeDirectory(public_path("addons"));
        }

        if (!File::exists(public_path("addons/{$addonName}"))) {
            // Create symlink
            File::link(
                "{$basePath}/public",
                public_path("addons/{$addonName}")
            );
        }

        \Fusion::asset('/addons/ExtendedMatrixFieldtype/js/app.js');
        fieldtypes()->register(\Addons\ExtendedMatrixFieldtype\Fieldtypes\ExtendedMatrixFieldtype::class);
    }
}