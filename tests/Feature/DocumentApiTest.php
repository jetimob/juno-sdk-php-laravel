<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\Document\DocumentApi;
use Jetimob\Juno\Api\Document\DocumentListResponse;
use Jetimob\Juno\Api\Document\FindDocumentResponse;
use Jetimob\Juno\Api\Document\UploadDocumentResponse;
use Jetimob\Juno\Entity\DocumentResource;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class DocumentApiTest extends AbstractTestCase
{
    protected DocumentApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::document();
    }

    /** @test */
    public function documentApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(DocumentApi::class, $this->api);
    }

    /** @test */
    public function listDocumentsShouldSucceed(): void
    {
        $response = $this->api->list();
        $this->assertInstanceOf(DocumentListResponse::class, $response);
        $docs = $response->getDocuments();

        if (!empty($docs)) {
            $doc = $docs[0];
            $this->assertInstanceOf(DocumentResource::class, $doc);
        }
    }

    public function findDocumentShouldSucceed(): void
    {
        $response = $this->api->find('');
        $this->assertInstanceOf(FindDocumentResponse::class, $response);
        $this->assertNotEmpty($response->getId());
        $this->assertNotEmpty($response->getType());
        $this->assertNotEmpty($response->getDescription());
        $this->assertNotEmpty($response->getApprovalStatus());
    }

    public function uploadDocumentShouldSucceed(): void
    {
        // qualquer arquivo de formato válido: pdf, doc, docx, jpg, jpeg, png, bmp e tiff
        $file = fopen('', 'rb');
        $this->assertNotFalse($file);
        $response = $this->api->using('')->upload('', [$file]);
        $this->assertInstanceOf(UploadDocumentResponse::class, $response);
        $this->assertNotEmpty($response->getId());
        $this->assertSame('VERIFYING', $response->getApprovalStatus());
    }
}
