<?php

namespace Jetimob\Juno;

use Illuminate\Support\ServiceProvider;
use Jetimob\Juno\Console\InstallJunoPackage;
use Jetimob\Juno\Console\ClearCache;

class JunoServiceProvider extends ServiceProvider
{
    private function getConfigPath(): string
    {
        return sprintf('%s/../config/config.php', __DIR__);
    }

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->mergeConfigFrom($this->getConfigPath(), 'juno');

        $this->app->bind('juno', function ($app) {
            return new Juno($app->config->get('juno'));
        });
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // publishes config file
            $this->publishes([
                $this->getConfigPath() => config_path('juno.php')
            ], 'config');

            $this->commands([
                InstallJunoPackage::class,
                ClearCache::class,
            ]);
        }
    }
}
