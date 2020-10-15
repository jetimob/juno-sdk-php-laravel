<?php

namespace Jetimob\Juno\Lib\Http\Charge;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\ChargeResource;
use Jetimob\Juno\Lib\Model\Link;

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
 * Class ChargeCreationResponse
 * @package Jetimob\Juno\Lib\Http\Charge
 * @see https://dev.juno.com.br/api/v2#operation/createCharge
 */
class ChargeCreationResponse extends Response
{
    /** @var ChargeResource[] $charges */
    protected array $charges;

    /** @var Link[] $_links */
    protected ?array $_links = null;

    public function initComplexObjects(): void
    {
        $this->charges = $this->deserializeEmbeddedArray('charges', ChargeResource::class);
    }

    /**
     * @return ChargeResource[]
     */
    public function getCharges(): array
    {
        return $this->charges;
    }

    /**
     * @return Link[]
     */
    public function getLinks(): array
    {
        return $this->_links;
    }
}
