<?php

namespace Jetimob\Juno\Api\Balance;

use Jetimob\Juno\Api\AbstractApi;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Saldo
 */
class BalanceApi extends AbstractApi
{
    /**
     * Consulta o saldo de uma Conta Digital Juno.
     *
     * @link https://dev.juno.com.br/api/v2#operation/getBalance
     * @return BalanceResponse
     */
    public function get(): BalanceResponse
    {
        return $this->mappedGet('balance', BalanceResponse::class);
    }
}
