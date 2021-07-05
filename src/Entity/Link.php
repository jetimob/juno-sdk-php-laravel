<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class Link
{
    use Serializable;

    /**
     * @var object $self
     * @property string $href
     */
    protected object $self;

    /**
     * @return object
     */
    public function getSelf(): object
    {
        return $this->self;
    }

    /**
     * @param object $self
     */
    public function setSelf(object $self): void
    {
        $this->self = $self;
    }
}
