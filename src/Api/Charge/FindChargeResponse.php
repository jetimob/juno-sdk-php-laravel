<?php

namespace Jetimob\Juno\Api\Charge;

use Jetimob\Juno\Api\JunoResponse;
use Jetimob\Juno\Entity\BilletDetails;
use Jetimob\Juno\Entity\Payment;

class FindChargeResponse extends JunoResponse
{
    protected string $id;
    protected int $code;
    protected string $reference;
    protected string $dueDate;
    protected string $link;
    protected string $checkoutUrl;
    protected string $installmentLink;
    protected string $payNumber;
    protected int $amount;

    protected ?BilletDetails $billetDetails;

    /** @var Payment[] $payments */
    protected array $payments;

    public function paymentsItemType(): string
    {
        return Payment::class;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl(): string
    {
        return $this->checkoutUrl;
    }

    /**
     * @return string
     */
    public function getInstallmentLink(): string
    {
        return $this->installmentLink;
    }

    /**
     * @return string
     */
    public function getPayNumber(): string
    {
        return $this->payNumber;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return BilletDetails|null
     */
    public function getBilletDetails(): ?BilletDetails
    {
        return $this->billetDetails;
    }

    /**
     * @return Payment[]
     */
    public function getPayments(): array
    {
        return $this->payments ?? [];
    }
}
