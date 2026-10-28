<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (!defined('K_PATH_FONTS')) {
    define('K_PATH_FONTS', (string) realpath(base_path('resources/pdf-fonts')));
}

    //    if (env('APP_ENV') === 'production') {
    //     $this->app['request']->server->set('HTTPS','on'); // this line

    //     URL::forceScheme('https');
    // }
       
         
    }
}
