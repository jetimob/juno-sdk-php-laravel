<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\Payment\PaymentApi;
use Jetimob\Juno\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class PaymentApiTest extends AbstractTestCase
{
    protected PaymentApi $api;

    public function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::payment();
    }

    public function paymentApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(PaymentApi::class, $this->api);
    }
}
