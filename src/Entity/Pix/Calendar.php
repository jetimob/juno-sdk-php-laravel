<?php

namespace Jetimob\Juno\Entity\Pix;

class Calendar
{
    /**
     * @var int $expiracao <int32> Tempo de vida da cobrança, especificado em segundos a partir da data de criação
     * (Calendario.criacao)
     */
    protected int $expiracao;

    /**
     * @return int
     */
    public function getExpiracao(): int
    {
        return $this->expiracao;
    }

    /**
     * @param int $expiracao Tempo de vida da cobrança, especificado em segundos a partir da data de criação
     * (Calendario.criacao)
     * @return Calendar
     */
    public function setExpiracao(int $expiracao): Calendar
    {
        $this->expiracao = $expiracao;
        return $this;
    }

    /**
     * @param int $expiracao Tempo de vida da cobrança, especificado em segundos a partir da data de criação
     * (Calendario.criacao)
     * @return static
     */
    public static function new(int $expiracao = 8600): self
    {
        return (new static())
            ->setExpiracao($expiracao);
    }
}
