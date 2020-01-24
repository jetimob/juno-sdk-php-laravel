<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class BusinessAreaResource
{
    use Serializable;

    public int $code;

    public string $activity;

    public string $category;
}
