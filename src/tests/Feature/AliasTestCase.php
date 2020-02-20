<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeConsultResponse;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationRequest;
use Jetimob\Juno\Lib\Http\Charge\ChargeCreationResponse;
use Jetimob\Juno\Lib\Model\Billing;
use Jetimob\Juno\Lib\Model\Charge;
use Jetimob\Juno\tests\TestCase;
use Jetimob\Juno\Util\Console;

class AliasTestCase extends TestCase
{
    public function testAs()
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
        $charge->amount         = 25.00;
        $charge->dueDate        = '2020-01-30';

        $charge->maxOverdueDays = 29;
        $charge->fine           = 0;
        $charge->interest       = 0;

        try {
            /** @var ChargeCreationResponse $response */
            $response = Juno::as('517AE567EB6E9A0C3D70DD631778F84DF4F7158BF71DD3F7A53311D3DCC2545E')->request(
                new ChargeCreationRequest($charge, $billing),
            );
            $this->assertResponse($response);
            Console::log($response);
        } catch (\ServerException $e) {
            Console::log($e->getMessage());
        }
    }

    public function testBillet()
    {
        try {
            /** @var ChargeConsultResponse $response */
            $response = Juno::as('517AE567EB6E9A0C3D70DD631778F84DF4F7158BF71DD3F7A53311D3DCC2545E')->request(
                new ChargeConsultRequest('chr_2767A60A4DF5ABCBBDE97667BB451450')
            );
            $this->assertResponse($response);
        } catch (\Exception $e) {
            Console::log($e);
        }
    }
}
