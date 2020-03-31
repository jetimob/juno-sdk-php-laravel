<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Webhook\WebhookCreationRequest;
use Jetimob\Juno\Lib\Http\Webhook\WebhookDeletionRequest;
use Jetimob\Juno\Lib\Http\Webhook\WebhookListRequest;
use Jetimob\Juno\Lib\Http\Webhook\WebhookPatchRequest;
use Jetimob\Juno\Lib\Http\Webhook\WebhookTypeListRequest;
use Jetimob\Juno\Lib\Model\WebhookEventType;
use Jetimob\Juno\tests\TestCase;

class WebhookTestCase extends TestCase
{
    public function testTypeList()
    {
        $this->assertResponse(Juno::request(WebhookTypeListRequest::class, ''));
    }

    public function testList()
    {
        $this->assertResponse(Juno::request(WebhookListRequest::class, ''));
    }

    public function testCreation()
    {
        $req = new WebhookCreationRequest();
        $req->eventTypes = [WebhookEventType::PAYMENT_NOTIFICATION];
        $req->url = '';

        $this->assertResponse(Juno::request($req, ''));
    }

    public function testDeletion()
    {
        $this->assertResponse(Juno::request(new WebhookDeletionRequest(''), ''));
    }

    public function testPatch()
    {
        $req = new WebhookPatchRequest('');
        $req->status = 'ACTIVE';
        $req->eventTypes = [WebhookEventType::PAYMENT_NOTIFICATION, WebhookEventType::TRANSFER_STATUS_CHANGED];
        $this->assertResponse(Juno::request($req, ''));
    }
}