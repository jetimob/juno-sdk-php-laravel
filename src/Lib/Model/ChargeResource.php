<?php

namespace Jetimob\Juno\Lib\Model;

class ChargeResource
{
    private string $id;

    private int $code;

    private string $reference;

    private string $dueDate;

    private string $link;

    private string $checkoutUrl;

    private string $installmentLink;

    private string $payNumber;

    private float $amount;

    private BilletDetails $billetDetails;

    /** @var Payment[] $payments */
    private array $payments;

    /** @var Link[] $_links */
    private array $_links;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    /**
     * @param string $dueDate
     */
    public function setDueDate(string $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl(): string
    {
        return $this->checkoutUrl;
    }

    /**
     * @param string $checkoutUrl
     */
    public function setCheckoutUrl(string $checkoutUrl): void
    {
        $this->checkoutUrl = $checkoutUrl;
    }

    /**
     * @return string
     */
    public function getInstallmentLink(): string
    {
        return $this->installmentLink;
    }

    /**
     * @param string $installmentLink
     */
    public function setInstallmentLink(string $installmentLink): void
    {
        $this->installmentLink = $installmentLink;
    }

    /**
     * @return string
     */
    public function getPayNumber(): string
    {
        return $this->payNumber;
    }

    /**
     * @param string $payNumber
     */
    public function setPayNumber(string $payNumber): void
    {
        $this->payNumber = $payNumber;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return BilletDetails
     */
    public function getBilletDetails(): BilletDetails
    {
        return $this->billetDetails;
    }

    /**
     * @param BilletDetails $billetDetails
     */
    public function setBilletDetails(BilletDetails $billetDetails): void
    {
        $this->billetDetails = $billetDetails;
    }

    /**
     * @return Payment[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param Payment[] $payments
     */
    public function setPayments(array $payments): void
    {
        $this->payments = $payments;
    }

    /**
     * @return Link[]
     */
    public function getLinks(): array
    {
        return $this->_links;
    }
}
