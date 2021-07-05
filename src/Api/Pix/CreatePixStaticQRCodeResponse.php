<?php

namespace Jetimob\Juno\Api\Pix;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#operation/createPixQrCodeStatic
 */
class CreatePixStaticQRCodeResponse extends JunoResponse
{
    protected string $id;
    protected string $qrcodeInBase64;
    protected ?string $imageInBase64 = null;

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
    public function getQrcodeInBase64(): string
    {
        return $this->qrcodeInBase64;
    }

    /**
     * @return string|null
     */
    public function getImageInBase64(): ?string
    {
        return $this->imageInBase64;
    }
}
