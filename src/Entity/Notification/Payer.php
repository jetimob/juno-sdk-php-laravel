<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Entity\Address;

class Payer
{
    use Serializable;

    protected ?string $id;
    protected ?string $name;
    protected ?Address $address;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }
}
