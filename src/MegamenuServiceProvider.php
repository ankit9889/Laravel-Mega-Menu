<?php

namespace Mvsofttech\Megamenu;

use Illuminate\Support\ServiceProvider;

class MegamenuServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/views','mvsoft');

        $this->mergeConfigFrom(__DIR__.'/config/megamenu.php','mvsoft');

        $this->publishes([
            __DIR__.'/config/megamenu.php'=> config_path('megamenu.php'),
        ]);

        $this->publishes([
            __DIR__.'/assets'=> public_path('assets'),
        ]);
    }

    public function register()
    {

    }

}
