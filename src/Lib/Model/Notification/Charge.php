<?php

namespace Jetimob\Juno\Lib\Model\Notification;

use Jetimob\Juno\Lib\Traits\Serializable;

class Charge
{
    use Serializable;

    public string $id;

    public string $code;

    public string $dueDate;

    public string $amount;
}