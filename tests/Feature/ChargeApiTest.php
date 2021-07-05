<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\Charge\ChargeApi;
use Jetimob\Juno\Api\Charge\ChargeListResponse;
use Jetimob\Juno\Api\Charge\CreateChargeResponse;
use Jetimob\Juno\Api\Charge\ListChargesRequest;
use Jetimob\Juno\Entity\Address;
use Jetimob\Juno\Entity\Billing;
use Jetimob\Juno\Entity\Charge;
use Jetimob\Juno\Entity\ChargeResource;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class ChargeApiTest extends AbstractTestCase
{
    protected ChargeApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::charge();
    }

    /** @test */
    public function chargeApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(ChargeApi::class, $this->api);
    }

    /** @test */
    public function createChargeShouldSucceed(): void
    {
        $amount = 11.1;
        $response = $this->api->create(
            Charge::newWithAmount('Descrição do pagamento', $amount),
            Billing::new(
                'Cecília Marcela Brito',
                '09060298993',
                'ceciliamarcelabrito-82@mciimoveis.com.br',
                Address::new(
                    'Rua Vieira Portuense',
                    '880',
                    'São Paulo',
                    'SP',
                    '04347080'
                )->setNeighborhood('Jardim Oriental')
            ),
        );
        $this->assertInstanceOf(CreateChargeResponse::class, $response);

        $charges = $response->getCharges();
        $this->assertNotEmpty($charges);
        $ch0 = $charges[0];
        $this->assertEquals($amount, $ch0->getAmount());
    }

    /** @test */
    public function chargesListShouldSucceed(): void
    {
        $response = $this->api->list();
        $this->assertNotNull($response);
        $this->assertInstanceOf(ChargeListResponse::class, $response);
        $charges = $response->getCharges();

        if (!empty($charges)) {
            $this->assertInstanceOf(ChargeResource::class, $charges[0]);
        }
    }

    /** @test */
    public function chargesListWithQueryParamsShouldSucceed(): void
    {
        $queryParams = new ListChargesRequest();
        $queryParams->setOrderBy('amount');
        $queryParams->setShowPaid(true);
        $queryParams->setPage(2);
        $response = $this->api->list($queryParams);
        $this->assertNotNull($response);
        $this->assertInstanceOf(ChargeListResponse::class, $response);
    }
}
