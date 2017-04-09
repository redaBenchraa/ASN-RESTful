<?php

namespace App\Providers\v1;

use App\Services\v1\GrpsService;
use Illuminate\Support\ServiceProvider;
class GrpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GrpsService::class,function($app){
            return new GrpsService();
        });
    }
}
