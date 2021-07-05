<?php

namespace Jetimob\Juno\Api\Account;

use Jetimob\Juno\Entity\Address;
use Jetimob\Juno\Entity\BankAccount;
use Jetimob\Juno\Entity\LegalRepresentative;

class AccountUpdateDTO
{
    /** @var string|null $companyType MANDATORY FOR COMPANIES */
    public ?string $companyType = null;

    /** @var string|null $name [0 .. 80] chars */
    public ?string $name = null;

    /** @var string|null $birthDate MANDATORY FOR INDIVIDUALS <date> YYYY-MM-DD */
    public ?string $birthDate = null;

    /** @var string|null $linesOfBusiness [0 .. 100 chars] free description */
    public ?string $linesOfBusiness = null;

    /** @var string|null $email [0 .. 80] chars */
    public ?string $email = null;

    /** @var string|null $phone [10 .. 16] chars */
    public ?string $phone = null;

    /** @var int|null $businessArea business area id */
    public ?int $businessArea = null;

    /** @var string|null $tradingName [0 .. 80] chars */
    public ?string $tradingName = null;

    public ?Address $address = null;

    public ?BankAccount $bankAccount = null;

    public ?LegalRepresentative $legalRepresentative = null;

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
}
