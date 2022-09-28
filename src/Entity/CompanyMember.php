<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class CompanyMember
{
    use Serializable;

    /** @var string $name Nome do membro. */
    protected string $name;

    /** @var string $document CPF ou CNPJ do membro. */
    protected string $document;

    /** @var string $birthDate <yyyy-MM-dd> Data de nascimento do membro. */
    protected string $birthDate;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * @param string $name Nome do membro.
     * @return CompanyMember
     */
    public function setName(string $name): CompanyMember
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $document CPF ou CNPJ do membro.
     * @return CompanyMember
     */
    public function setDocument(string $document): CompanyMember
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @param string $birthDate <yyyy-MM-dd> Data de nascimento do membro.
     * @return CompanyMember
     */
    public function setBirthDate(string $birthDate): CompanyMember
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
