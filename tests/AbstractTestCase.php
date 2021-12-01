<?php

namespace Jetimob\Juno\Tests;

use Illuminate\Support\Str;
use Jetimob\Juno\Facades\Juno;
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
        Juno::getHttpInstance()->overwriteConfig(
            'oauth_access_token_repository',
            \Jetimob\Http\Authorization\OAuth\Storage\FileCacheRepository::class,
        );
    }

    /** @inheritDoc */
    protected function getPackageProviders($app)
    {
        return [JunoServiceProvider::class];
    }
}
