<?php

namespace Jetimob\Juno\Lib\Model;

class Billing
{
    /** @var string|null $name */
    private ?string $name;

    /** @var string|null $document */
    private ?string $document;

    /** @var string|null $email [0 .. 80] chars */
    private ?string $email;

    /** @var string|null $secondaryEmail [0 .. 80] chars */
    private ?string $secondaryEmail;

    /** @var string|null $phone [0 .. 25] chars */
    private ?string $phone;

    /** @var string|null $birthDate <date-time> */
    private ?string $birthDate;

    /** @var bool|null $notify */
    private ?bool $notify;
}
