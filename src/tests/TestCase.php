<?php

namespace Jetimob\Juno\tests;

use Jetimob\Juno\Juno;
use Jetimob\Juno\JunoServiceProvider;
use Jetimob\Juno\Lib\Http\Authorization\AuthorizationRequest;
use Jetimob\Juno\Lib\Http\Balance\BalanceConsultRequest;
use Jetimob\Juno\Lib\Http\Balance\BalanceConsultResponse;
use Jetimob\Juno\Lib\Http\Charge\ChargeCancelRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCancelResponse;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultResponse;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationResponse;
use Jetimob\Juno\Lib\Http\ErrorResponse;
use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\Billing;
use Jetimob\Juno\Lib\Model\Charge;
use Jetimob\Juno\Lib\Model\ChargeResource;
use Jetimob\Juno\Lib\Model\ErrorDetail;
use Jetimob\Juno\Util\Console;

class TestCase extends \Orchestra\Testbench\TestCase
{
//
//    public function getEnvironmentSetUp($app)
//    {
//        return [
//            JunoServiceProvider::class,
//        ];
//    }
//
    protected function getPackageProviders($app)
    {
        return [JunoServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return ['juno' => \Jetimob\Juno\Facades\Juno::class];
    }

    protected function assertResponse(Response $response)
    {
        if ($response->failed()) {
            $this->debugFailedResponse($response);
        } else {
            Console::log($response);
        }

        $this->assertFalse($response->failed());
    }

    protected function debugFailedResponse(Response $response)
    {
        if (!($response instanceof ErrorResponse)) {
            return;
        }

        /** @var ErrorDetail $detail */
        foreach ($response->getDetails() as $detail) {
            Console::log($detail->getMessage());
        }
    }
//
//    public function testBalanceConsult()
//    {
//        /** @var Juno $juno */
//        $juno = $this->app->get('juno');
//        /** @var BalanceConsultResponse $response */
//        $response = $juno->request(BalanceConsultRequest::class);
//        Console::log($response);
//        $this->assertFalse($response->failed());
//    }
//
//    public function testChargeConsult()
//    {
//        /** @var Juno $juno */
//        $juno = $this->app->get('juno');
//        $request = new ChargeConsultRequest('chr_D9BA1D5958742EE41B64A383E2E00CCE');
//
//        /** @var ChargeConsultResponse $response */
//        $response = $juno->request($request);
//        Console::log($response);
//        $this->assertFalse($response->failed());
//    }
//
//    public function testChargeCancel()
//    {
//        /** @var Juno $juno */
//        $juno = $this->app->get('juno');
//        $request = new ChargeCancelRequest('chr_D9BA1D5958742EE41B64A383E2E00CCE');
//        /** @var ChargeCancelResponse $response */
//        $response = $juno->request($request);
//
//        if ($response->failed()) {
//            Console::log($response);
//            return;
//        }
//
//        if ($response->canceled()) {
//            Console::log('Successfully canceled!');
//        } else {
//            Console::log('FUCK ME');
//        }
//
//        $this->assertFalse($response->failed());
//    }
//
//    public function testChargeCreation()
//    {
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
//        Console::log($response);
//
//        $this->assertFalse($response->failed());
//    }
}
