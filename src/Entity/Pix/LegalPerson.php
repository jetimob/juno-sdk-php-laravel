<?php

namespace Jetimob\Juno\Entity\Pix;

class LegalPerson
{
    /** @var string $nome Nome do usuário. */
    protected string $nome;

    /** @var string $cnpj CNPJ do usuário. /^\d{14}$/ (14 dígitos) */
    protected string $cnpj;

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @param string $nome Nome do usuário.
     * @return LegalPerson
     */
    public function setNome(string $nome): LegalPerson
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @param string $cnpj CNPJ do usuário. /^\d{14}$/ (14 dígitos)
     * @return LegalPerson
     */
    public function setCnpj(string $cnpj): LegalPerson
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public static function new(string $name, string $document): self
    {
        return (new static())
            ->setNome($name)
            ->setCnpj($document);
    }
}
