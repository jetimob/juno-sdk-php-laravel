<?php

namespace Jetimob\Juno\Api\Charge;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\ChargeResource;

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
 * @link https://dev.juno.com.br/api/v2#operation/createCharge
 */
class CreateChargeResponse extends EmbeddedResponse
{
    /** @var ChargeResource[] $charges */
    protected array $charges;

    public function chargesItemType(): string
    {
        return ChargeResource::class;
    }

    /**
     * @return ChargeResource[]
     */
    public function getCharges(): array
    {
        return $this->charges ?? [];
    }
}
