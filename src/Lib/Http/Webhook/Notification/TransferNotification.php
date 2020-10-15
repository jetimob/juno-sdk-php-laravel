<?php

namespace Jetimob\Juno\Lib\Http\Webhook\Notification;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\Notification\TransferData;
use Jetimob\Juno\Lib\Traits\TransferBaseResponseTrait;

/**
 * Class TransferNotification
 * @package Jetimob\Juno\Lib\Http\Webhook\Notification
 * @see https://dev.juno.com.br/junoAPI20Integration.pdf page 46
 */
class TransferNotification extends Response
{
    /** eventType can be: REQUESTED | NEEDS_CHECK | CHECK_FAILED | EXECUTED | AWAITING_EXECUTION | REJECTED | INVALID_BANK_ACCOUNT | CANCELED */
    use TransferBaseResponseTrait;

    /** @var TransferData[] $transferData */
    public array $transferData;

    public function initComplexObjects(): void
    {
        if (!empty($this->data->data)) {
            $this->transferData = TransferData::deserializeArray($this->data->data);
        } else {
            $this->transferData = [];
        }
    }
}
