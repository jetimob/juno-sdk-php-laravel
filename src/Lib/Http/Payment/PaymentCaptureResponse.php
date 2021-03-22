<?php

namespace Jetimob\Juno\Lib\Http\Payment;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\BilletDetails;
use Jetimob\Juno\Lib\Model\Payment;

class PaymentCaptureResponse extends Response
{
    public string $transactionId;

    public int $installments;

    public array $links;

    /** @var Payment[] $payments */
    public array $payments;
}
