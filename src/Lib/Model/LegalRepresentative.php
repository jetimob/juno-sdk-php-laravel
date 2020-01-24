<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class LegalRepresentative
{
    use Serializable;

    public string $name;

    /** @var string $document CPF (11 chars) || CNPJ (14 chars) */
    public string $document;

    /** @var string $birthDate <date> YYYY-MM-DD */
    public string $birthDate;
}
