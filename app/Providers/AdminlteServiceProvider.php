<?php

namespace App\Providers;

use App\Helpers\Settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AdminlteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('settings')) {
            if (Settings::get('favicon')) {
                config(['adminlte.use_full_favicon' => false]);
                config(['adminlte.use_custom_favicon' => true]);
                config(['adminlte.path_favicon' => url('icon/' . Settings::get('favicon'))
                ]);
            }
        }
    }
}
