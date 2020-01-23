<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Juno;
use Jetimob\Juno\Lib\Traits\Serializable;

class Billet
{
    use Serializable;

    private Juno $base;

    public function __construct(Juno $base)
    {
        $this->base = $base;
    }

    public function create()
    {

    }

    public function list()
    {

    }

    public function get()
    {

    }

    public function cancel()
    {

    }

    public function updateSplit()
    {

    }
}
