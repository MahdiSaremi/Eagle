<?php

namespace Rapid\Eagle;

use Illuminate\Support\ServiceProvider;

class EagleServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(Eagle::class);
    }

}