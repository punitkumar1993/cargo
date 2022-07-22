<?php

namespace App\Providers;

use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Blade;
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
    public function boot(Charts $charts)
    {
        Builder::defaultStringLength(191);
        Blade::aliasComponent('layouts.components.content-header', 'head');
        $charts->register([
            \App\Charts\GoogleAnalyticChart::class,
            \App\Charts\DeviceChart::class
        ]);
    }
}
