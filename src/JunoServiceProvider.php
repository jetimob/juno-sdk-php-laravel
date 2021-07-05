<?php

declare(strict_types=1);

namespace Jetimob\Juno;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class JunoServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $src = realpath($raw = __DIR__ . '/../config/juno.php') ?: $raw;

        if ($this->app->runningInConsole()) {
            $this->publishes([$src => config_path('juno.php')]);
        }

        $this->mergeConfigFrom($src, 'juno');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jetimob.juno', function (Container $app) {
            return new Juno($app['config']['juno'] ?? []);
        });

        $this->app->alias('jetimob.juno', Juno::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'jetimob.juno',
        ];
    }
}
