<?php

namespace Jetimob\Juno\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Jetimob\Juno\Juno;

class ClearCache extends Command
{
    protected $signature = 'juno:clear-cache';

    protected $description = 'Clears Juno cache';

    public function handle()
    {
        Cache::forget(Juno::AUTHZ_CACHE_KEY);
        $this->info('Juno\'s cache is now clean.');
    }
}
