<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class Link
{
    use Serializable;

    /**
     * @var object $self
     * @property string $href
     */
    private object $self;

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
