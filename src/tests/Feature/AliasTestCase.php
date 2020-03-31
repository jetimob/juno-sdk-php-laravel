<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationRequest;
use Jetimob\Juno\Lib\Model\Billing;
use Jetimob\Juno\Lib\Model\Charge;
use Jetimob\Juno\tests\TestCase;

class AliasTestCase extends TestCase
{
    public function testAs()
    {
        $billing = new Billing();
        $billing->name = '';
        $billing->document = '';
        $billing->birthDate = '';

        $billing->email = '';
        $billing->notify = false;
        $billing->phone = '';

        $charge = new Charge();
        $charge->description    = '';
        $charge->amount         = 0.00;
        $charge->dueDate        = '';

        $charge->maxOverdueDays = 1;
        $charge->fine           = 0;
        $charge->interest       = 0;

        $this->assertResponse(Juno::request(new ChargeCreationRequest($charge, $billing), ''));
    }

    public function testBillet()
    {
        $this->assertResponse(Juno::request(new ChargeConsultRequest(''), ''));
    }
}
