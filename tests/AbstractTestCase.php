<?php

namespace Jetimob\Juno\Tests;

use Illuminate\Support\Str;
use Jetimob\Juno\JunoServiceProvider;
use Orchestra\Testbench\TestCase;

class AbstractTestCase extends TestCase
{
    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();
        $this->assertTrue(
            Str::contains(config('juno.http.guzzle.base_uri'), 'sandbox'),
            'Os testes DEVEM ser executados apenas em ambiente sandbox!',
        );
    }

    /** @inheritDoc */
    protected function getPackageProviders($app)
    {
        return [JunoServiceProvider::class];
    }
}
