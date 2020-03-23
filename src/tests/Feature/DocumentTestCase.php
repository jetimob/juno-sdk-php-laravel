<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Document\DocumentFileUploadRequest;
use Jetimob\Juno\Lib\Http\Document\DocumentListRequest;
use Jetimob\Juno\tests\TestCase;

class DocumentTestCase extends TestCase
{
    public function testDocumentUpload()
    {
        $request = new DocumentFileUploadRequest();
        $request->id = '';
        $file = fopen('', 'r');
        $request->files[] = $file;
        $this->assertResponse(Juno::request($request, ''));
    }

    public function testList()
    {
        $request = new DocumentListRequest();
        $this->assertResponse(Juno::request($request, ''));
    }
}
