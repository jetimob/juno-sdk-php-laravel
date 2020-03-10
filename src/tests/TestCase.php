<?php

namespace Jetimob\Juno\tests;

use Jetimob\Juno\JunoServiceProvider;
use Jetimob\Juno\Lib\Http\ErrorResponse;
use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\ErrorDetail;
use Jetimob\Juno\Util\Console;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [JunoServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return ['juno' => \Jetimob\Juno\Facades\Juno::class];
    }

    protected function assertResponse(Response $response)
    {
        Console::log($response);

        if ($response->failed()) {
            $this->debugFailedResponse($response);
        }

        $this->assertFalse($response->failed());
    }

    protected function debugFailedResponse(Response $response)
    {
        if (!($response instanceof ErrorResponse)) {
            return;
        }

        /** @var ErrorDetail $detail */
        foreach ($response->getDetails() as $detail) {
            Console::log($detail->getMessage());
        }
    }
}
