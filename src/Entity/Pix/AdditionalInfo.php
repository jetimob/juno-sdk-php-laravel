<?php

namespace Jetimob\Juno\Entity\Pix;

class AdditionalInfo
{
    /** @var string $nome Nome do campo. <= 50 chars */
    protected string $nome;

    /** @var string $valor Dados do campo. <= 200 chars */
    protected string $valor;

    /**
     * @param string $nome
     * @param string $valor
     */
    public function __construct(string $nome, string $valor)
    {
        $this->nome = $nome;
        $this->valor = $valor;
    }

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
    public function getValor(): string
    {
        return $this->valor;
    }
}
