<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraBanksInfoRequest;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraBanksInfoResponse;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraBusinessAreasRequest;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraBusinessAreasResponse;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraCompanyTypesRequest;
use Jetimob\Juno\Lib\Http\ExtraData\ExtraCompanyTypesResponse;
use Jetimob\Juno\tests\TestCase;

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
        /** @var ExtraBanksInfoResponse $response */
        $response = Juno::request(ExtraBanksInfoRequest::class, '');
        $this->assertResponse($response);
    }

    public function testCompanyTypes()
    {
        /** @var ExtraCompanyTypesResponse $response */
        $response = Juno::request(ExtraCompanyTypesRequest::class, '');
        $this->assertResponse($response);
    }
}
