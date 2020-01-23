<?php

namespace Jetimob\Juno\Lib\Http\Charge;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

class ChargeCancelRequest extends Request
{
    protected string $id;

    /**
     * ChargeCancelRequest constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    protected function method(): string
    {
        return Method::PUT;
    }

    protected function urn(): string
    {
        return 'charges/{id}/cancelation';
    }
}
