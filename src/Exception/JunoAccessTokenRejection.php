<?php

namespace Jetimob\Juno\Exception;

use Jetimob\Juno\Lib\Http\ErrorResponse;
use Jetimob\Juno\Lib\Model\ErrorDetail;

class JunoAccessTokenRejection extends JunoException
{
    public function __construct(ErrorResponse $response)
    {
        $details = array_reduce($response->getDetails(), function ($carry, ErrorDetail $detail) {
            return sprintf('%s; [%s]: %s', $carry, $detail->getErrorCode(), $detail->getMessage());
        }, '');

        parent::__construct(sprintf(
            '[%s]: %s; %s',
            $response->getStatusCode(),
            $response->getError(),
            $details
        ), 0, null);
    }
}
