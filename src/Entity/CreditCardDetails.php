<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class CreditCardDetails
{
    use Serializable;

    /**
     * @var string $creditCardId Id do cartão de crédito gerado a partir da Tokenização. Caso seja utilizado esse
     * parâmetro, não deve ser enviado o creditCardHash.
     */
    protected string $creditCardId;

    /**
     * @var string $creditCardHash Hash do cartão de crédito gerado a partir da comunicação da Biblioteca de
     * Criptografia. Caso seja utilizado esse parâmetro, não deve ser enviado o creditCardId.
     */
    protected string $creditCardHash;

    /**
     * @return string
     */
    public function getCreditCardId(): string
    {
        return $this->creditCardId;
    }

    /**
     * @return string
     */
    public function getCreditCardHash(): string
    {
        return $this->creditCardHash;
    }

    /**
     * @param string $creditCardId Id do cartão de crédito gerado a partir da Tokenização. Caso seja utilizado esse
     * parâmetro, não deve ser enviado o creditCardHash.
     * @return CreditCardDetails
     */
    public function setCreditCardId(string $creditCardId): CreditCardDetails
    {
        $this->creditCardId = $creditCardId;
        return $this;
    }

    /**
     * @param string $creditCardHash Hash do cartão de crédito gerado a partir da comunicação da Biblioteca de
     * Criptografia. Caso seja utilizado esse parâmetro, não deve ser enviado o creditCardId.
     * @return CreditCardDetails
     */
    public function setCreditCardHash(string $creditCardHash): CreditCardDetails
    {
        $this->creditCardHash = $creditCardHash;
        return $this;
    }

    public static function new(string $creditCardId, string $creditCardHash): self
    {
        return (new static())
            ->setCreditCardId($creditCardId)
            ->setCreditCardHash($creditCardHash);
    }
}
