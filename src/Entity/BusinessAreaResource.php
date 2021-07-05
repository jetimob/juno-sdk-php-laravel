<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class BusinessAreaResource
{
    use Serializable;

    protected int $code;
    protected string $activity;
    protected string $category;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getActivity(): string
    {
        return $this->activity;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}
