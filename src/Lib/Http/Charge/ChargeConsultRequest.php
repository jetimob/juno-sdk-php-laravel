<?php

namespace Jetimob\Juno\Lib\Http\Charge;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

class ChargeConsultRequest extends Request
{
    protected string $id;

    protected string $method = Method::GET;

    protected string $urn = 'charges/{id}';

    protected string $responseClass = ChargeConsultResponse::class;

    /**
     * ChargeConsultRequest constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return ChargeConsultRequest
     */
    public function setId(string $id): ChargeConsultRequest
    {
        $this->id = $id;
        return $this;
    }
}
