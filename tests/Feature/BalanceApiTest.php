<?php

namespace Jetimob\Juno\Tests\Feature;

use GuzzleHttp\Exception\ClientException;
use Jetimob\Juno\Api\Balance\BalanceApi;
use Jetimob\Juno\Api\Balance\BalanceResponse;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class BalanceApiTest extends AbstractTestCase
{
    protected BalanceApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::balance();
    }

    /** @test */
    public function balanceApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(BalanceApi::class, $this->api);
    }

    /** @test */
    public function balanceResponseShouldSucceed(): void
    {
        $response = $this->api->get();
        $this->assertInstanceOf(BalanceResponse::class, $response);
        $this->assertIsFloat($response->getBalance());
        $this->assertIsFloat($response->getTransferableBalance());
        $this->assertIsFloat($response->getWithheldBalance());
    }

    /** @test */
    public function requestWithoutCredentialsShouldFail(): void
    {
        $this->expectException(ClientException::class);
        $this->api->using('')->get();
    }
}
