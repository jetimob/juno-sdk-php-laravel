<?php

namespace Jetimob\Juno\tests;

use Jetimob\Juno\Juno;
use Jetimob\Juno\JunoServiceProvider;
use Jetimob\Juno\Lib\Http\Authorization\AuthorizationRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationResponse;
use Jetimob\Juno\Lib\Model\Billing;
use Jetimob\Juno\Lib\Model\Charge;
use Jetimob\Juno\Lib\Model\ChargeResource;
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

        $charge = new Charge();
        $charge->amount = 14.0;
        $charge->installments = 1;
        $charge->fine = 5;
        $charge->description = 'This is a description about the charge';
        $charge->dueDate = '2020-01-24';

        $billing = new Billing();
        $billing->name = 'Alan Weingartner';
        $billing->notify = false;
        $billing->document = '01566139058';
        $billing->email = 'alan.weingartner@gmail.com';

        /** @var ChargeCreationResponse $response */
        $response = $juno->request(new ChargeCreationRequest(
            $charge,
            $billing,
        ));

        $charges = $response->getCharges();

        foreach ($charges as $item) {
            Console::log($item->code);
            Console::log($item->id);
            Console::log($item->link);
        }

        $this->assertFalse($response->failed());
    }
}
