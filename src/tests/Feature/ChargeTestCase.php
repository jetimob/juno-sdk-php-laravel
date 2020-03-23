<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationResponse;
use Jetimob\Juno\Lib\Model\Billing;
use Jetimob\Juno\Lib\Model\Charge;
use Jetimob\Juno\tests\TestCase;
use Jetimob\Juno\Util\Console;

class ChargeTestCase extends TestCase
{
    public function testCreation()
    {
        $billing = new Billing();
        $billing->name = '';
        $billing->document = '';
        $billing->birthDate = Juno::formatDateTime(1990, 4, 7);

        $billing->email = '';
        $billing->notify = false;
        $billing->phone = '';

        $charge = new Charge();
        $charge->description    = '';
        $charge->amount         = 10000.00;
        $charge->dueDate        = Juno::formatDate(2050, 5, 4);

        $charge->maxOverdueDays = 29;
        $charge->fine           = 0.0;
        $charge->interest       = 0.0;

        /** @var ChargeCreationResponse $chargeResponse */
        $chargeResponse = Juno::request(new ChargeCreationRequest($charge, $billing), '');
        $this->assertResponse($chargeResponse);

        if ($chargeResponse->succeeded()) {
            Console::Log($chargeResponse->getCharges()[0]);
        }
    }

    public function testConsult()
    {
        try {
            $response = Juno::request(new ChargeConsultRequest(''), '');
            $this->assertResponse($response);
        } catch (\Exception $e) {
            Console::log($e);
        }
    }
}
