<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class BilletDetails
{
    use Serializable;

    /** @var string $bankAccount Conta bancária */
    protected string $bankAccount;

    /** @var string Nosso número */
    protected string $ourNumber;

    /** @var string $barcodeNumber Código de barras */
    protected string $barcodeNumber;

    /** @var string $portfolio Carteira bancária */
    protected string $portfolio;

    /**
     * @return string Conta bancária
     */
    public function getBankAccount(): string
    {
        return $this->bankAccount;
    }

    /**
     * @return string Nosso número
     */
    public function getOurNumber(): string
    {
        return $this->ourNumber;
    }

    /**
     * @return string Código de barras
     */
    public function getBarcodeNumber(): string
    {
        return $this->barcodeNumber;
    }

    /**
     * @return string Carteira bancária
     */
    public function getPortfolio(): string
    {
        return $this->portfolio;
    }
}
