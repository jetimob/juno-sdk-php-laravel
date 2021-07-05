<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class Billing
{
    use Serializable;

    /** @var string $name - Nome do comprador. */
    protected string $name;

    /** @var string $document - CPF ou CNPJ do comprador. Envie sem ponto ou traço. */
    protected string $document;

    /** @var string $email - [0 .. 80] chars - Email do comprador. */
    protected string $email;

    /** @var Address $address - Endereço. */
    protected Address $address;

    /** @var string|null $secondaryEmail - [0 .. 80] chars - Email secundário do comprador. */
    protected ?string $secondaryEmail = null;

    /** @var string|null $phone - [0 .. 25] chars - Telefone do comprador. */
    protected ?string $phone = null;

    /** @var string|null $birthDate - <date> Data de nascimento do comprador. */
    protected ?string $birthDate = null;

    /** @var bool $notify - Define se o compador receberá emails de notificação diretamente da Juno. */
    protected bool $notify = false;

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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getSecondaryEmail(): ?string
    {
        return $this->secondaryEmail;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * @return bool
     */
    public function isNotify(): bool
    {
        return $this->notify;
    }

    /**
     * @param string $name
     * @return Billing
     */
    public function setName(string $name): Billing
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $document
     * @return Billing
     */
    public function setDocument(string $document): Billing
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @param string $email
     * @return Billing
     */
    public function setEmail(string $email): Billing
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param Address $address
     * @return Billing
     */
    public function setAddress(Address $address): Billing
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string|null $secondaryEmail
     * @return Billing
     */
    public function setSecondaryEmail(?string $secondaryEmail): Billing
    {
        $this->secondaryEmail = $secondaryEmail;
        return $this;
    }

    /**
     * @param string|null $phone
     * @return Billing
     */
    public function setPhone(?string $phone): Billing
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string|null $birthDate
     * @return Billing
     */
    public function setBirthDate(?string $birthDate): Billing
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @param bool $notify
     * @return Billing
     */
    public function setNotify(bool $notify): Billing
    {
        $this->notify = $notify;
        return $this;
    }

    public static function new(string $name, string $document, string $email, Address $address): self
    {
        return (new static())
            ->setName($name)
            ->setDocument($document)
            ->setEmail($email)
            ->setAddress($address);
    }
}
