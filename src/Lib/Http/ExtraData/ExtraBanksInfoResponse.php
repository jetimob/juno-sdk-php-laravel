<?php

namespace Jetimob\Juno\Lib\Http\ExtraData;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\BankResource;

class ExtraBanksInfoResponse extends Response
{
    /** @var BankResource[] $banks */
    public array $banks;

    public function initComplexObjects()
    {
        $this->banks = BankResource::deserializeArray($this->data->_embedded->banks);
    }
}
