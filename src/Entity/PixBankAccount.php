<?php

namespace Jetimob\Juno\Entity;

class PixBankAccount extends BankAccount
{
    /**
     * @var string|null $ispb Código ISPB da Instituição destino.
     * IMPORTANTE:
     * Se a Instituição destino não possuir código COMP (bankNumber), o código ISPB (ispb) deve ser informado.
     */
    protected ?string $ispb = null;

    /**
     * @return string|null
     */
    public function getIspb(): ?string
    {
        return $this->ispb;
    }

    /**
     * @param string|null $ispb Código ISPB da Instituição destino.
     * IMPORTANTE:
     * Se a Instituição destino não possuir código COMP (bankNumber), o código ISPB (ispb) deve ser informado.
     * @return PixBankAccount
     */
    public function setIspb(?string $ispb): PixBankAccount
    {
        $this->ispb = $ispb;
        return $this;
    }
}
