<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class Billing
{
    use Serializable;

    /** @var string|null $name */
    public ?string $name;

    /** @var string|null $document */
    public ?string $document;

    /** @var string|null $email [0 .. 80] chars */
    public ?string $email;

    /** @var string|null $secondaryEmail [0 .. 80] chars */
    public ?string $secondaryEmail;

    /** @var string|null $phone [0 .. 25] chars */
    public ?string $phone;

    /** @var string|null $birthDate <date-time> e*/
    public ?string $birthDate;

    /** @var bool|null $notify sends a e-mail notifying the user */
    public ?bool $notify;
}
