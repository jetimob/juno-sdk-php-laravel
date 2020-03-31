<?php

namespace Jetimob\Juno\Lib\Model\Notification;

use Jetimob\Juno\Lib\Traits\Serializable;

class TransferData
{
    use Serializable;

    use EntityBaseTrait;

    public TransferAttributes $attributes;
}