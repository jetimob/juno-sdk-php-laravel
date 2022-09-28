<?php

namespace Jetimob\Juno\Api\Webhook\Notification;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Entity\Notification\ChargeData;

/**
 * @link https://dev.juno.com.br/junoAPI20Integration.pdf page 35
 */
class ChargeNotification
{
    use NotificationBase;
    use Serializable;

    public const EVENT_TYPE_ACTIVE = 'ACTIVE';
    public const EVENT_TYPE_CANCELED = 'CANCELLED';
    public const EVENT_TYPE_MANUAL_RECONCILIATION = 'MANUAL_RECONCILIATION';
    public const EVENT_TYPE_FAILED = 'FAILED';
    public const EVENT_TYPE_PAID = 'PAID';

    public function dataItemType(): string
    {
        return ChargeData::class;
    }

    public function getNotificationData(): array
    {
        return $this->data ?? [];
    }
}
