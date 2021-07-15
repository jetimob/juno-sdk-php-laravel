<?php

namespace Jetimob\Juno\Api\Webhook\Notification;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Entity\Notification\PaymentData;

/**
 * @link https://dev.juno.com.br/junoAPI20Integration.pdf page 42
 */
class PaymentNotification
{
    use NotificationBase;
    use Serializable;

    public const EVENT_TYPE_BANK_PAID_BACK = 'BANK_PAID_BACK';
    public const EVENT_TYPE_CONFIRMED = 'CONFIRMED';
    public const EVENT_TYPE_PARTIALLY_REFUNDED = 'PARTIALLY_REFUNDED';
    public const EVENT_TYPE_CUSTOMER_PAID_BACK = 'CUSTOMER_PAID_BACK';
    public const EVENT_TYPE_DECLINED = 'DECLINED';
    public const EVENT_TYPE_FAILED = 'FAILED';
    public const EVENT_TYPE_NOT_AUTHORIZED = 'NOT_AUTHORIZED';

    public function dataItemType(): string
    {
        return PaymentData::class;
    }

    /**
     * @return PaymentData[]
     */
    public function getPaymentData(): array
    {
        return $this->data ?? [];
    }
}
