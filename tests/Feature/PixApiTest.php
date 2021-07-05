<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\Pix\CreatePixKeyResponse;
use Jetimob\Juno\Api\Pix\PixApi;
use Jetimob\Juno\Exception\JunoRequestException;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class PixApiTest extends AbstractTestCase
{
    protected PixApi $api;
    protected const IDEMPOTENCE_KEY = '69F963C6-7487-4363-9406-A1DE2A9636D4';

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::pix();
    }

    /** @test */
    public function pixApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(PixApi::class, $this->api);
    }

    /** @test */
    public function createRandomKeyShouldSucceed(): void
    {
        $response = $this->api->createRandomPixKey(self::IDEMPOTENCE_KEY);
        $this->assertInstanceOf(CreatePixKeyResponse::class, $response);
    }
}
