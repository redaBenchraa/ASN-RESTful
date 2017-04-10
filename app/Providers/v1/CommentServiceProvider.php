<?php

namespace App\Providers\v1;

use App\Services\v1\CommentService;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
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
        $this->app->bind(CommentService::class,function($app){
            return new CommentService();
        });
    }
}
