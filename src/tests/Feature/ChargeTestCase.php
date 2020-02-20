<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Exception\JunoAccessTokenRejection;
use Jetimob\Juno\Exception\JunoException;
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
        $billing->name = 'Nome do cabra';
        $billing->document = '01566139058';
        $billing->birthDate = '1994-04-07 07:00';

        $billing->email = 'alan.weingartner@gmail.com';
        $billing->notify = false;
        $billing->phone = '54999006794';

        $charge = new Charge();
        $charge->description    = 'Referente ao mês de [...]';
        $charge->amount         = 10000.00;
        $charge->dueDate        = Juno::formatDate(2020, 5, 2);

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
            $response = Juno::request(new ChargeConsultRequest(''));
            $this->assertResponse($response);
        } catch (\Exception $e) {
            Console::log($e);
        }
    }
}
