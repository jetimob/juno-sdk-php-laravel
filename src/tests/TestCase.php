<?php

namespace Jetimob\Juno\tests;

use Jetimob\Juno\Juno;
use Jetimob\Juno\JunoServiceProvider;
use Jetimob\Juno\Lib\Http\Authorization\AuthorizationRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultResponse;
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

    public function testChargeConsult()
    {
        /** @var Juno $juno */
        $juno = $this->app->get('juno');
        $request = new ChargeConsultRequest('chr_05BD798260B93470E7B90A35FE955C46');

        /** @var ChargeConsultResponse $response */
        $response = $juno->request($request);
        Console::log($response);
        $this->assertFalse($response->failed());
    }

    public function testOk()
    {
        Console::log('FUCK');
//        /** @var Juno $juno */
//        $juno = $this->app->get('juno');
//
//        $charge = new Charge();
//        $charge->amount = 14.0;
//        $charge->installments = 1;
//        $charge->fine = 5;
//        $charge->description = 'This is a description about the charge';
//        $charge->dueDate = '2020-01-24';
//
//        $billing = new Billing();
//        $billing->name = 'Alan Weingartner';
//        $billing->notify = false;
//        $billing->document = '01566139058';
//        $billing->email = 'alan.weingartner@gmail.com';
//
//        /** @var ChargeCreationResponse $response */
//        $response = $juno->request(new ChargeCreationRequest(
//            $charge,
//            $billing,
//        ));
//
//        $charges = $response->getCharges();
//
//        foreach ($charges as $item) {
//            Console::log($item->code);
//            Console::log($item->id);
//            Console::log($item->link);
//        }
//
//        $this->assertFalse($response->failed());
    }
}
