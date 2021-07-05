<?php

namespace Jetimob\Juno\Api\Charge;

use Jetimob\Juno\Api\JunoResponse;

/**
 * The successful request returns only a 204 with no content;
 * @link https://dev.juno.com.br/api/v2#operation/cancelById
 */
class CancelChargeResponse extends JunoResponse
{
    public function canceled(): bool
    {
        return $this->getStatusCode() === 204;
    }
}
