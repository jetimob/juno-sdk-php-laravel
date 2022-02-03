<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Exception\InvalidArgumentException;

class Address
{
    use Serializable;

    /** @var string|null $street Rua. */
    protected ?string $street;

    /** @var string|null $number Número. Se não houver, envie N/A. */
    protected ?string $number;

    /** @var string|null $complement Complemento. */
    protected ?string $complement = null;

    /** @var string|null $neighborhood Bairro. */
    protected ?string $neighborhood = null;

    /** @var string|null $city Cidade. */
    protected ?string $city;

    /** @var string|null $state Estado em sigla de Unidade Federativa (UF). */
    protected ?string $state;

    /** @var string|null $postCode Código de Endereçamento Postal no Brasil (CEP). */
    protected ?string $postCode;

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return string|null
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @return string|null
     */
    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @param string $street Rua.
     * @return Address
     */
    public function setStreet(string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param string $number Número. Se não houver, envie N/A.
     * @return Address
     */
    public function setNumber(string $number): Address
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param string|null $complement Complemento.
     * @return Address
     */
    public function setComplement(?string $complement): Address
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @param string|null $neighborhood Bairro.
     * @return Address
     */
    public function setNeighborhood(?string $neighborhood): Address
    {
        $this->neighborhood = $neighborhood;
        return $this;
    }

    /**
     * @param string $city Cidade.
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $state Estado em sigla de Unidade Federativa (UF).
     * @return Address
     */
    public function setState(string $state): Address
    {
        if (strlen($state) !== 2) {
            throw new InvalidArgumentException('Estados devem ser fornecidos em formato de sigla (2 chars)');
        }

        $this->state = $state;
        return $this;
    }

    /**
     * @param string $postCode Código de Endereçamento Postal no Brasil (CEP). SEM hífen.
     * @return Address
     */
    public function setPostalCode(string $postCode): Address
    {
        $postCode = preg_replace('/\D/', '', $postCode);
        $this->postCode = $postCode;
        return $this;
    }

    /**
     * Configura o número do endereço como 'N/A'.
     * @return Address
     */
    public function setWithoutNumber(): Address
    {
        $this->number = 'N/A';
        return $this;
    }

    public static function new(string $street, string $number, string $city, string $state, string $postalCode): self
    {
        return (new static())
            ->setStreet($street)
            ->setNumber($number)
            ->setCity($city)
            ->setState($state)
            ->setPostalCode($postalCode);
    }
}
