<?php

namespace Jetimob\Juno\Api\Account;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Entity\Address;
use Jetimob\Juno\Entity\BankAccount;
use Jetimob\Juno\Entity\LegalRepresentative;

class AccountUpdateDTO implements \JsonSerializable
{
    use Serializable;

    /** @var string|null $companyType MANDATORY FOR COMPANIES */
    protected ?string $companyType = null;

    /** @var string|null $name [0 .. 80] chars */
    protected ?string $name = null;

    /** @var string|null $birthDate MANDATORY FOR INDIVIDUALS <date> YYYY-MM-DD */
    protected ?string $birthDate = null;

    /** @var string|null $linesOfBusiness [0 .. 100 chars] free description */
    protected ?string $linesOfBusiness = null;

    /** @var string|null $email [0 .. 80] chars */
    protected ?string $email = null;

    /** @var string|null $phone [10 .. 16] chars */
    protected ?string $phone = null;

    /** @var int|null $businessArea business area id */
    protected ?int $businessArea = null;

    /** @var string|null $tradingName [0 .. 80] chars */
    protected ?string $tradingName = null;

    protected ?Address $address = null;

    protected ?BankAccount $bankAccount = null;

    protected ?LegalRepresentative $legalRepresentative = null;

    /**
     * @param string|null $companyType
     * @return AccountUpdateDTO
     */
    public function setCompanyType(?string $companyType): AccountUpdateDTO
    {
        $this->companyType = $companyType;
        return $this;
    }

    /**
     * @param string|null $name
     * @return AccountUpdateDTO
     */
    public function setName(?string $name): AccountUpdateDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $birthDate
     * @return AccountUpdateDTO
     */
    public function setBirthDate(?string $birthDate): AccountUpdateDTO
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @param string|null $linesOfBusiness
     * @return AccountUpdateDTO
     */
    public function setLinesOfBusiness(?string $linesOfBusiness): AccountUpdateDTO
    {
        $this->linesOfBusiness = $linesOfBusiness;
        return $this;
    }

    /**
     * @param string|null $email
     * @return AccountUpdateDTO
     */
    public function setEmail(?string $email): AccountUpdateDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string|null $phone
     * @return AccountUpdateDTO
     */
    public function setPhone(?string $phone): AccountUpdateDTO
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param int|null $businessArea
     * @return AccountUpdateDTO
     */
    public function setBusinessArea(?int $businessArea): AccountUpdateDTO
    {
        $this->businessArea = $businessArea;
        return $this;
    }

    /**
     * @param string|null $tradingName
     * @return AccountUpdateDTO
     */
    public function setTradingName(?string $tradingName): AccountUpdateDTO
    {
        $this->tradingName = $tradingName;
        return $this;
    }

    /**
     * @param Address|null $address
     * @return AccountUpdateDTO
     */
    public function setAddress(?Address $address): AccountUpdateDTO
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param BankAccount|null $bankAccount
     * @return AccountUpdateDTO
     */
    public function setBankAccount(?BankAccount $bankAccount): AccountUpdateDTO
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    /**
     * @param LegalRepresentative|null $legalRepresentative
     * @return AccountUpdateDTO
     */
    public function setLegalRepresentative(?LegalRepresentative $legalRepresentative): AccountUpdateDTO
    {
        $this->legalRepresentative = $legalRepresentative;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyType(): ?string
    {
        return $this->companyType;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * @return string|null
     */
    public function getLinesOfBusiness(): ?string
    {
        return $this->linesOfBusiness;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return int|null
     */
    public function getBusinessArea(): ?int
    {
        return $this->businessArea;
    }

    /**
     * @return string|null
     */
    public function getTradingName(): ?string
    {
        return $this->tradingName;
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @return BankAccount|null
     */
    public function getBankAccount(): ?BankAccount
    {
        return $this->bankAccount;
    }

    /**
     * @return LegalRepresentative|null
     */
    public function getLegalRepresentative(): ?LegalRepresentative
    {
        return $this->legalRepresentative;
    }
}
