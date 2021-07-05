<?php

namespace Jetimob\Juno\Api\Balance;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Saldo
 */
class BalanceResponse extends JunoResponse
{
    /**
     * @var float $balance Soma do saldo a liberar e saldo disponível.
     */
    protected float $balance;

    /**
     * @var float $withheldBalance Saldo a liberar. Valor referente aos recebimentos do cartão de crédito que fica
     * "em espera" durante o prazo de retenção acordado para esse meio de pagamento. Finalizado o prazo de retenção,
     * esse valor é transferido automaticamente para o saldo disponível.
     */
    protected float $withheldBalance;

    /**
     * @var float $transferableBalance Saldo disponível. Valor referente aos recebimentos, independentemente do tipo de
     * pagamento, que já podem ser utilizados na transferência ou pagamento de contas.
     */
    protected float $transferableBalance;

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return float
     */
    public function getWithheldBalance(): float
    {
        return $this->withheldBalance;
    }

    /**
     * @return float
     */
    public function getTransferableBalance(): float
    {
        return $this->transferableBalance;
    }
}
