<?php

namespace App\Providers\v1;

use App\Services\v1\ConversationService;
use Illuminate\Support\ServiceProvider;

class ConversationServiceProvider extends ServiceProvider
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
        $this->app->bind(ConversationService::class,function($app){
            return new ConversationService();
        });
    }
}
