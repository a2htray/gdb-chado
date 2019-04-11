<?php

namespace A2htray\GDBChado;

use A2htray\GDBChado\Commands\GenerateChadoModelCommand;
use A2htray\GDBChado\Commands\InitChadoCommand;
use Illuminate\Support\ServiceProvider;

define('PACKAGE_CHADO_PREFIX', 'chado');

class GDBChadoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitChadoCommand::class,
                GenerateChadoModelCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
