<?php

namespace Addons\ExtendedMatrixFieldtype\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Addons\ExtendedMatrixFieldtype\Http\Controllers';

    /**
     * Bootstrap any addon services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the addon.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
        $this->mapDataTableRoutes();
    }

    /**
     * Define the "web" routes for the addon.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace . '\Web',
        ], function ($router) {
            require dirname(dirname(__DIR__)).'/routes/web.php';
        });
    }

    /**
     * Define the "api" routes for the addon.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace . '\API',
            'prefix'     => 'api',
        ], function ($router) {
            require dirname(dirname(__DIR__)).'/routes/api.php';
        });
    }

    /**
     * Define the "datatable" routes for the addon.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDataTableRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace . '\DataTable',
            'prefix'     => 'datatable',
        ], function ($router) {
            require dirname(dirname(__DIR__)).'/routes/datatable.php';
        });
    }
}