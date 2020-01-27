<?php

namespace Jetimob\Juno\Lib\Http\ExtraData;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\BusinessAreaResource;

class ExtraBusinessAreasResponse extends Response
{
    /** @var BusinessAreaResource[] $businessAreas */
    protected array $businessAreas;

    public function initComplexObjects()
    {
        if (!empty($this->data->_embedded) && !empty($this->data->_embedded->businessAreas)) {
            $this->businessAreas = BusinessAreaResource::deserializeArray($this->data->_embedded->businessAreas);
        } else {
            $this->businessAreas = [];
        }
    }
}
