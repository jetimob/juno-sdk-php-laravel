<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class BilletDetails
{
    use Serializable;

    /** @var string $bankAccount bank account number */
    public string $bankAccount;

    /** @var string our account number */
    public string $ourNumber;

    public string $barcodeNumber;

    /** @var string $portfolio banking wallet */
    public string $portfolio;
}
