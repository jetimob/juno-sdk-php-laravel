<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class LegalRepresentative
{
    use Serializable;

    protected string $name;

    /** @var string $document CPF (11 chars) || CNPJ (14 chars) */
    protected string $document;

    /** @var string $birthDate <date> YYYY-MM-DD */
    protected string $birthDate;

    /**
     * @param string $name
     * @return LegalRepresentative
     */
    public function setName(string $name): LegalRepresentative
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $document CPF (11 chars) || CNPJ (14 chars).
     * @return LegalRepresentative
     */
    public function setDocument(string $document): LegalRepresentative
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @param string $birthDate <date> YYYY-MM-DD.
     * @return LegalRepresentative
     */
    public function setBirthDate(string $birthDate): LegalRepresentative
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public static function new(string $name, string $document, string $birthdate): self
    {
        return (new static())
            ->setName($name)
            ->setDocument($document)
            ->setBirthDate($birthdate);
    }
}
