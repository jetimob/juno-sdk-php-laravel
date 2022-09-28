<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\AdditionalData\AdditionalDataApi;
use Jetimob\Juno\Entity\BankResource;
use Jetimob\Juno\Entity\BusinessAreaResource;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class AdditionalDataApiTest extends AbstractTestCase
{
    protected AdditionalDataApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::additionalData();
    }

    /** @test */
    public function additionalDataApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(AdditionalDataApi::class, $this->api);
    }

    /** @test */
    public function listBanksShouldSucceed(): void
    {
        $response = $this->api->banks();
        $this->assertNotNull($response);
        $banks = $response->getBanks();
        $this->assertNotEmpty($banks);
        $this->assertInstanceOf(BankResource::class, $banks[0]);
        $this->assertNotEmpty($banks[0]->getName());
        $this->assertNotEmpty($banks[0]->getNumber());
    }

    /** @test */
    public function listBusinessAreasShouldSucceed(): void
    {
        $response = $this->api->businessAreas();
        $this->assertNotNull($response);
        $businessAreas = $response->getBusinessAreas();
        $this->assertNotEmpty($businessAreas);
        $this->assertInstanceOf(BusinessAreaResource::class, $businessAreas[0]);
        $this->assertNotEmpty($businessAreas[0]->getCode());
        $this->assertNotEmpty($businessAreas[0]->getCategory());
        $this->assertNotEmpty($businessAreas[0]->getActivity());
    }

    /** @test */
    public function listCompanyTypesShouldSucceed(): void
    {
        $response = $this->api->companyTypes();
        $this->assertNotNull($response);
        $companyTypes = $response->getCompanyTypes();
        $this->assertNotEmpty($companyTypes);
        $this->assertIsString($companyTypes[0]);
    }
}
