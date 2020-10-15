<?php

namespace Jetimob\Juno\Lib\Http\Charge;

use Jetimob\Juno\Lib\Http\Response;

/**
 * Class ChargeCancelResponse
 * The successful request returns only a 204 with no content;
 * @package Jetimob\Juno\Lib\Http\Charge
 * @see https://dev.juno.com.br/api/v2#operation/cancelById
 */
class ChargeCancelResponse extends Response
{
    public function canceled(): bool
    {
        return $this->getStatusCode() === 204;
    }
}
