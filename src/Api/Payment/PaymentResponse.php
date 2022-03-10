<?php

namespace Jetimob\Juno\Api\Payment;

use Jetimob\Juno\Api\JunoResponse;
use Jetimob\Juno\Entity\Link;
use Jetimob\Juno\Entity\Payment;

/**
 * @link https://dev.juno.com.br/api/v2#operation/createPayment
 */
abstract class PaymentResponse extends JunoResponse
{
    protected string $transactionId;
    protected int $installments;
    protected array $payments;
    protected array $_links;

    public function paymentsItemType(): string
    {
        return Payment::class;
    }

    public function linksItemType(): string
    {
        return Link::class;
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getInstallments(): int
    {
        return $this->installments;
    }

    public function getPayments(): array
    {
        return $this->payments;
    }

    public function getLinks(): array
    {
        return $this->_links;
    }
}
