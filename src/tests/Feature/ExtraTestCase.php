<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraBanksInfoRequest;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraBusinessAreasRequest;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraBusinessAreasResponse;
use Jetimob\Juno\tests\TestCase;
use Jetimob\Juno\Util\Console;

class ExtraTestCase extends TestCase
{
    public function testBusinessAreas()
    {
        /** @var ExtraBusinessAreasResponse $response */
        $response = Juno::request(ExtraBusinessAreasRequest::class, '');
        $this->assertResponse($response);
    }

    public function testBanksInfo()
    {
        $response = Juno::request(ExtraBanksInfoRequest::class, '');
        $this->assertResponse($response);
    }
}
