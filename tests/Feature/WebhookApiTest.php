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
    public function listWebhooksShouldSucceed(): string
    {
        $response = $this->api->list();
        $this->assertInstanceOf(WebhookListResponse::class, $response);

        $webhooks = $response->getWebhooks();
        if (!empty($webhooks)) {
            $doc = $webhooks[0];
            $this->assertInstanceOf(WebhookResource::class, $doc);
        }

        $this->assertIsArray($webhooks);

        $firstWebhookFoundId = $webhooks[0]->getId();

        return $firstWebhookFoundId;
    }

    /** 
     * @test 
     * @depends listWebhooksShouldSucceed
    */
    public function updateWebhooksShouldSucceed(string $firstWebhookFoundId): void
    {
        $response = $this->api->using(config('juno.resource_token'))->update(
            $firstWebhookFoundId,
            'INACTIVE',
            ['TRANSFER_STATUS_CHANGED'],
        );
    }

    /** 
     * @test 
     * @depends listWebhooksShouldSucceed
    */
    public function deleteWebhooksShouldSucceed(string $firstWebhookFoundId): void
    {
        $response = $this->api->delete($firstWebhookFoundId);
        $this->assertSame(204, $response->getStatusCode());
    }
}
