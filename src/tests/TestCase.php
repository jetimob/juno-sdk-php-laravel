<?php

namespace Jetimob\Juno\tests;

use Jetimob\Juno\Juno;
use Jetimob\Juno\JunoServiceProvider;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationResponse;
use Jetimob\Juno\Lib\Model\Billing;
use Jetimob\Juno\Lib\Model\Charge;
use Jetimob\Juno\Util\Console;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

    }
//
//    public function getEnvironmentSetUp($app)
//    {
//        return [
//            JunoServiceProvider::class,
//        ];
//    }
//
    public function getPackageProviders($app)
    {
        return [JunoServiceProvider::class];
    }

    public function testOk()
    {
        /** @var Juno $juno */
        $juno = $this->app->get('juno');
        /** @var ChargeCreationResponse $response */
        $test = $juno->requestAccessToken();
        Console::log($test);
        $this->assertIsBool(true);
    }
}
