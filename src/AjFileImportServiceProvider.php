<?php

namespace Ajency\Ajfileimport;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

//Added to schedule the job queue
use View;

class AjFileImportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //include __DIR__.'/routes.php';
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations'); //Load migration from package directory
        //$this->loadViewsFrom(realpath(__DIR__.'/../views'), 'ajfileimport');
        $this->loadViewsFrom(realpath(__DIR__ . '/views'), 'ajfileimport');
        $this->setupRoutes($this->app->router);

        $this->publishes([
            __DIR__ . '/config' => config_path('ajimportdata'),
        ]);

        /*$this->app->booted(function () {
    $schedule = $this->app->make(Schedule::class);
    $schedule->command('php artisan queue:work --queue=validateunique,validatechildinsert,insertvalidchilddata,tempupdatechildid,masterinsert')->everyMinute();
    });*/

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        //$this->app->make('Ajency\Ajfileimport\AjFileImportController');

        $this->mergeConfigFrom(
            __DIR__ . '/config/ajimportdata.php', 'ajimportdata-conf'
        );
        //add namespaced views as mail class was not able to find view folder
        View::addNamespace('AjcsvimportView', realpath(__DIR__ . '/views'));
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Ajency\Ajfileimport\Controllers'], function ($router) {
            require __DIR__ . '/routes.php';
        });
    }

}
