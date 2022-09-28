<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class Pix
{
    use Serializable;

    /** @var string $id <ObjectId> */
    protected string $id;

    /** @var string $payloadInBase64 <Base64> */
    protected string $payloadInBase64;

    /** @var string $imageInBase64 <Base64> */
    protected string $imageInBase64;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPayloadInBase64(): string
    {
        return $this->payloadInBase64;
    }

    /**
     * @return string
     */
    public function getImageInBase64(): string
    {
        return $this->imageInBase64;
    }
}
