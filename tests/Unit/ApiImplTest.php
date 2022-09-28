<?php

namespace Jetimob\Juno\Tests\Unit;

use Jetimob\Juno\Exception\RuntimeException;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class ApiImplTest extends AbstractTestCase
{
    /** @test */
    public function unknownApiCallShouldThrowException(): void
    {
        $this->expectException(RuntimeException::class);
        Juno::undefinedApi();
    }

    /** @test */
    public function dateToStringShouldNotInvokeMagicCall(): void
    {
        $this->assertIsString(Juno::dateToString(1994, 01, 01));
    }
}
