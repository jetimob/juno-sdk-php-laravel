<?php

namespace Jetimob\Juno\Lib\Http\Webhook\Notification;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\Notification\PaymentData;
use Jetimob\Juno\Lib\Traits\TransferBaseResponseTrait;

/**
 * Class PaymentNotification
 * @package Jetimob\Juno\Lib\Http\Webhook\Notification
 * @see https://dev.juno.com.br/junoAPI20Integration.pdf page 42
 */
class PaymentNotification extends Response
{
    /** eventType can be: BANK_PAID_BACK | CONFIRMED | PARTIALLY_REFUNDED | CUSTOMER_PAID_BACK | DECLINED | FAILED | NOT_AUTHORIZED */
    use TransferBaseResponseTrait;

    /** @var PaymentData[] $paymentData */
    public array $paymentData;

    public function initComplexObjects(): void
    {
        if (!empty($this->data->data)) {
            $this->paymentData = PaymentData::deserializeArray($this->data->data);
        } else {
            $this->paymentData = [];
        }
    }
}