<?php

namespace Jetimob\Juno\Api\Payment;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#operation/tokenizeCreditCard
 */
class TokenizationResponse extends JunoResponse
{
    protected string $creditCardId;
    protected string $last4CardNumber;
    protected string $expirationMonth;
    protected string $expirationYear;

    public function getCreditCardId(): string
    {
        return $this->creditCardId;
    }

    public function getLast4CardNumber(): string
    {
        return $this->last4CardNumber;
    }

    public function getExpirationMonth(): string
    {
        return $this->expirationMonth;
    }

    public function getExpirationYear(): string
    {
        return $this->expirationYear;
    }
}
