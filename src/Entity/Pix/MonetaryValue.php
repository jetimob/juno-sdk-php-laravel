<?php

namespace Jetimob\Juno\Entity\Pix;

class MonetaryValue
{
    /**
     * @var string $original Valor original da cobrança.
     * \d{1,10}\.\d{2}
     * Isso é: de 1 a 10 dígitos seguidos de um "." seguido por dois dígitos.
     * Valores de 0.01 até 9999999999.99
     */
    protected string $original;

    /**
     * @return string
     */
    public function getOriginalValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value Valor original da cobrança.
     * \d{1,10}\.\d{2}
     * Isso é: de 1 a 10 dígitos seguidos de um "." seguido por dois dígitos.
     * Valores de 0.01 até 9999999999.99
     * @return MonetaryValue
     */
    public function setValue(string $value): MonetaryValue
    {
        $this->value = $value;
        return $this;
    }

    public static function new(string $value): self
    {
        return (new static())
            ->setValue($value);
    }
}
