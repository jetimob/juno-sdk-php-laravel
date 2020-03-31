<?php

namespace Jetimob\Juno\Lib\Model\Notification;

use Jetimob\Juno\Lib\Traits\Serializable;

class TransferAttributes
{
    use Serializable;

    public string $digitalAccountId;

    public string $creationDate;

    public ?string $transferDate;

    public string $amount;

    public string $status;

    public Recipient $recipient;
}
