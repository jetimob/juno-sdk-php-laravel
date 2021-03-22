<?php

namespace Jetimob\Juno\Lib\Http\Payment;

use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Http\Method;

use Jetimob\Juno\Lib\Model\Payment;


class PaymentCaptureRequest extends Request
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

    public string $amount;
    public string $chargeId;

    protected array $bodySchema = ['amount', 'chargeId'];


    protected function method(): string
    {
        return Method::POST;
    }

    protected function urn(): string
    {
        return 'payments/{id}/capture';
    }
}
