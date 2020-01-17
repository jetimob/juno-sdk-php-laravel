<?php

namespace Jetimob\Juno\tests;

use Jetimob\Juno\JunoServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {

    }

    public function getEnvironmentSetUp($app)
    {
        return [
            JunoServiceProvider::class,
        ];
    }

    public function getPackageProviders()
    {
        // environment setup
    }
}
