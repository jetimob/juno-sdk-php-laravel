<?php

namespace Jetimob\Juno\Lib\Model;

class BilletDetails
{
    /** @var string $bankAccount bank account number */
    private string $bankAccount;

    /** @var string our account number */
    private string $ourNumber;

    private string $barcodeNumber;

    /** @var string $portfolio banking wallet */
    private string $portfolio;

    /**
     * @return string
     */
    public function getBankAccount(): string
    {
        return $this->bankAccount;
    }

    /**
     * @param string $bankAccount
     */
    public function setBankAccount(string $bankAccount): void
    {
        $this->bankAccount = $bankAccount;
    }

    /**
     * @return string
     */
    public function getOurNumber(): string
    {
        return $this->ourNumber;
    }

    /**
     * @param string $ourNumber
     */
    public function setOurNumber(string $ourNumber): void
    {
        $this->ourNumber = $ourNumber;
    }

    /**
     * @return string
     */
    public function getBarcodeNumber(): string
    {
        return $this->barcodeNumber;
    }

    /**
     * @param string $barcodeNumber
     */
    public function setBarcodeNumber(string $barcodeNumber): void
    {
        $this->barcodeNumber = $barcodeNumber;
    }

    /**
     * @return string
     */
    public function getPortfolio(): string
    {
        return $this->portfolio;
    }

    /**
     * @param string $portfolio
     */
    public function setPortfolio(string $portfolio): void
    {
        $this->portfolio = $portfolio;
    }
}
