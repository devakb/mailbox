<?php

namespace Devakb\Mailbox;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/mailbox.php';

    public function boot()
    {


        $this->commands([
            \Devakb\Mailbox\App\Console\Commands\InstallComponentCommand::class,
        ]);



        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');


        $this->publishes([
            self::CONFIG_PATH => config_path('mailbox.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/public' => public_path(),
            __DIR__.'/resources/views' => base_path('resources/views'),
            __DIR__.'/database/migrations' => base_path('migrations'),
            __DIR__.'/App/Models' => app_path('Models'),
            __DIR__.'/App/Http/Controllers' => app_path('Http/Controllers'),
        ], 'initComponent');




    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'mailbox'
        );

    }
}
