<?php

namespace Jetimob\Juno\Lib\Http\Transference;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\Recipient;

class TransferenceResponse extends Response
{
    public string $id;

    public string $digitalAccountId;

    /** @var string $creationDate yyyy-MM-dd HH:mm:ss */
    public string $creationDate;

    /** @var string|null $transferDate yyyy-MM-dd HH:mm:ss */
    public ?string $transferDate;

    public float $amount;

    public string $status;

    public ?Recipient $recipient;

    public function initComplexObjects(): void
    {
        if (!empty($this->data->recipient)) {
            $this->recipient = Recipient::deserialize($this->data->recipient);
        } else {
            $this->recipient = null;
        }
    }
}
