<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\Webhook\WebhookApi;
use Jetimob\Juno\Api\Webhook\WebhookListResponse;
use Jetimob\Juno\Entity\WebhookResource;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class WebhookApiTest extends AbstractTestCase
{
    protected WebhookApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::webhook();
    }

    /** @test */
    public function webhookApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(WebhookApi::class, $this->api);
    }

    /** @test */
    public function listWebhooksShouldSucceed(): void
    {
        $response = $this->api->using(config('juno.resource_token'))->list();
        $this->assertInstanceOf(WebhookListResponse::class, $response);

        $webhooks = $response->getWebhooks();
        if (!empty($webhooks)) {
            $doc = $webhooks[0];
            $this->assertInstanceOf(WebhookResource::class, $doc);
        }
    }

    /** @test */
    public function deleteWebhooksShouldSucceed(): void
    {
        $response = $this->api->using(config('juno.resource_token'))->delete('');
        $this->assertSame(204, $response->getStatusCode());
    }

    /** @test */
    public function updateWebhooksShouldSucceed(): void
    {
        $response = $this->api->using(config('juno.resource_token'))->update(
            'wbh_E7E530E6041FCF95',
            'INACTIVE',
            ['TRANSFER_STATUS_CHANGED'],
        );
    }
}
