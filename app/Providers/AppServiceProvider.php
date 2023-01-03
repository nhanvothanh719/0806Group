<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Schema;
use Illuminate\Routing\UrlGenerator;


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
    public function boot(UrlGenerator $url)
    {
        Paginator::useBootstrap();
        //Schema::defaultStringLength(191);
        if(env('REDIRECT_HTTPS'))
		{
			$url->forceScheme('https');
		}
    }
}
