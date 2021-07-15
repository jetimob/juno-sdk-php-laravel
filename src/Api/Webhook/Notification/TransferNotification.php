<?php

namespace Jetimob\Juno\Api\Webhook\Notification;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Entity\Notification\TransferData;

/**
 * @link https://dev.juno.com.br/junoAPI20Integration.pdf page 46
 */
class TransferNotification
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
        return TransferData::class;
    }

    /**
     * @return TransferData[]
     */
    public function getTransferData(): array
    {
        return $this->data ?? [];
    }
}
