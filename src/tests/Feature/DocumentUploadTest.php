<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Lib\Http\Document\DocumentFileUploadRequest;
use Jetimob\Juno\tests\TestCase;

class DocumentUploadTest extends TestCase
{
    public function testDocumentUpload()
    {
        $request = new DocumentFileUploadRequest();
        $request->id = '';
        $file = fopen('', 'r');
        $request->files[] = $file;
        $this->assertResponse(Juno::request($request, ''));
    }
}
