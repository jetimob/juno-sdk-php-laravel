<?php

namespace Jetimob\Juno\Lib\Http\Charge;

use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Model\Billing;
use Jetimob\Juno\Lib\Model\Charge;

/**
 * Crie cobranças com ou sem split para boleto e cartão de crédito.
 *
 * Para criar cobranças com split podem ser informados um ou mais destinatários, onde o recipientToken corresponde a
 * cada conta digital envolvida.
 *
 * Os parâmetros amount e percentage definem, respectivamente, a divisão do valor do split de maneira fixa ou
 * percentual, não podendo ser enviados juntos na requisição.
 *
 * Caso a divisão de valores resulte em um número com mais de 2 casas decimais, a partilha de valores não ocorre de
 * maneira exata, desse modo é preciso definir quem ficará com o remanecente em amountRemainder.
 *
 * Class ChargeCreationRequest
 * @package Jetimob\Juno\Lib\Http\Charge
 * @see https://dev.juno.com.br/api/v2#operation/createCharge
 */
class ChargeCreationRequest extends Request
{
    protected Charge $charge;

    protected Billing $billing;

    protected array $bodySchema = ['charge', 'billing'];

    /**
     * ChargeCreationRequest constructor.
     * @param Charge $charge
     * @param Billing $billing
     */
    public function __construct(Charge $charge, Billing $billing)
    {
        parent::__construct();
        $this->charge = $charge;
        $this->billing = $billing;
    }


    protected function method(): string
    {
        return Method::POST;
    }

    protected function urn(): string
    {
        return 'charges';
    }
}
