<?php

namespace Jetimob\Juno\Console;

use Illuminate\Console\Command;

class InstallJunoPackage extends Command
{
    protected $signature = 'juno:install';

    protected $description = 'Publishes Juno\'s configuration';

    public function handle()
    {
        $this->info('Publishing configuration.');
        $this->call('vendor:publish', [
            '--provider' => 'Jetimob\\Juno\\JunoServiceProvider',
            '--tag'      => 'config'
        ]);
        $this->info('Package successfully installed.');
    }
}
