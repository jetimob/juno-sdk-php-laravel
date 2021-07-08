<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Exception\InvalidArgumentException;

class BankAccount
{
    use Serializable;

    public const CHECKING_ACCOUNT_TYPE = 'CHECKING';
    public const SAVINGS_ACCOUNT_TYPE = 'SAVINGS';

    /** @var string|null $bankNumber Código de compensação do banco do Brasil. Espera 3 dígitos. */
    protected ?string $bankNumber = null;

    /** @var string $agencyNumber Número da agência. Deve respeitar o padrão de cada banco. */
    protected string $agencyNumber;

    /** @var string $accountNumber Número da conta. Deve respeitar o padrão de cada banco. */
    protected string $accountNumber;

    /**
     * @var string|null $accountComplementNumber
     * Enum: "001" "002" "003" "006" "007" "013" "022" "023" "028" "043" "031"
     * Complemento da conta a ser criada.
     * Exclusivo e obrigatório apenas para contas Caixa.
     */
    protected ?string $accountComplementNumber = null;

    /**
     * @var string $accountType
     * Enum: "CHECKING" "SAVINGS"
     * Tipo da conta. Envie CHECKING para Conta Corrente e SAVINGS para Poupança.
     */
    protected string $accountType;

    /** @var AccountHolder|null $accountHolder Titular da conta. */
    protected ?AccountHolder $accountHolder = null;

    /**
     * @return string
     */
    public function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    /**
     * @return string
     */
    public function getAgencyNumber(): string
    {
        return $this->agencyNumber;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @return string|null
     */
    public function getAccountComplementNumber(): ?string
    {
        return $this->accountComplementNumber;
    }

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->accountType;
    }

    /**
     * @return AccountHolder
     */
    public function getAccountHolder(): AccountHolder
    {
        return $this->accountHolder;
    }

    /**
     * @param string $bankNumber Código de compensação do bancos do Brasil. Espera 3 digitos.
     * @return BankAccount
     */
    public function setBankNumber(string $bankNumber): BankAccount
    {
        if (strlen($bankNumber) !== 3) {
            throw new InvalidArgumentException('O código do banco deve conter 3 dígitos.');
        }

        $this->bankNumber = $bankNumber;
        return $this;
    }

    /**
     * @param string $agencyNumber Número da agência. Deve respeitar o padrão de cada banco.
     * @return BankAccount
     */
    public function setAgencyNumber(string $agencyNumber): BankAccount
    {
        $this->agencyNumber = $agencyNumber;
        return $this;
    }

    /**
     * @param string $accountNumber Número da conta. Deve respeitar o padrão de cada banco.
     * @return BankAccount
     */
    public function setAccountNumber(string $accountNumber): BankAccount
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @param string|null $accountComplementNumber Complemento da conta a ser criada.
     * Enum: "001" "002" "003" "006" "007" "013" "022" "023" "028" "043" "031".
     * Exclusivo e obrigatório apenas para contas Caixa.
     * @return BankAccount
     */
    public function setAccountComplementNumber(?string $accountComplementNumber): BankAccount
    {
        $this->accountComplementNumber = $accountComplementNumber;
        return $this;
    }

    /**
     * @param string $accountType Tipo da conta. Envie CHECKING para Conta Corrente e SAVINGS para Poupança.
     * @return BankAccount
     */
    public function setAccountType(string $accountType): BankAccount
    {
        $this->accountType = $accountType;
        return $this;
    }

    /**
     * @param AccountHolder|null $accountHolder Titular da conta.
     * @return BankAccount
     */
    public function setAccountHolder(?AccountHolder $accountHolder): BankAccount
    {
        $this->accountHolder = $accountHolder;
        return $this;
    }

    public static function new(
        string $accountNumber,
        string $agencyNumber,
        string $accountType,
        ?string $bankNumber = null,
        ?AccountHolder $accountHolder = null
    ): self {
        return (new static())
            ->setAccountNumber($accountNumber)
            ->setAgencyNumber($agencyNumber)
            ->setAccountType($accountType)
            ->setBankNumber($bankNumber)
            ->setAccountHolder($accountHolder);
    }

    public static function checking(
        string $accountNumber,
        string $agencyNumber,
        ?string $bankNumber = null,
        ?AccountHolder $accountHolder = null
    ): self {
        return self::new($accountNumber, $agencyNumber, self::CHECKING_ACCOUNT_TYPE, $bankNumber, $accountHolder);
    }

    public static function savings(
        string $accountNumber,
        string $agencyNumber,
        ?string $bankNumber = null,
        ?AccountHolder $accountHolder = null
    ): self {
        return self::new($accountNumber, $agencyNumber, self::SAVINGS_ACCOUNT_TYPE, $bankNumber, $accountHolder);
    }
}
