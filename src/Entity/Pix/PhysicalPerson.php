<?php

namespace Jetimob\Juno\Entity\Pix;

class PhysicalPerson
{
    /** @var string $nome Nome do usuário. */
    protected string $nome;

    /** @var string $cpf CPF do usuário. /^\d{11}$/ (11 dígitos) */
    protected string $cpf;

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
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $nome Nome do usuário.
     * @return PhysicalPerson
     */
    public function setNome(string $nome): PhysicalPerson
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @param string $cpf CPF do usuário. /^\d{11}$/ (11 dígitos)
     * @return PhysicalPerson
     */
    public function setCpf(string $cpf): PhysicalPerson
    {
        $this->cpf = $cpf;
        return $this;
    }

    public static function new(string $name, string $document): self
    {
        return (new static())
            ->setNome($name)
            ->setCpf($document);
    }
}
