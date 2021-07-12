<?php

namespace Jetimob\Juno\Api\Account;

use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Entity\Address;
use Jetimob\Juno\Entity\BankAccount;
use Jetimob\Juno\Entity\CompanyMember;
use Jetimob\Juno\Entity\LegalRepresentative;

class AccountDTO implements \JsonSerializable
{
    use Serializable;

    /**
     * @var string PAYMENT_ACCOUNT_TYPE
     * - A fully functional payment digital account
     * - All features available
     */
    public const PAYMENT_ACCOUNT_TYPE = 'PAYMENT';

    /**
     * @var string RECEIVING_ACCOUNT_TYPE
     * - A specific digital account only used for receiving
     * - Just receiving features available
     */
    public const RECEIVING_ACCOUNT_TYPE = 'RECEIVING';

    /**
     * @var string $companyType Enum: "MEI" "EI" "EIRELI" "LTDA" "SA" "INSTITUITION_NGO_ASSOCIATION"
     * Define a natureza de negócio. Obrigatório para contas PJ.
     * @link https://dev.juno.com.br/api/v2#operation/getCompanyTypes
     */
    protected string $companyType;

    /**
     * @var string $name Nome da conta digital
     * [0 .. 80] chars.
     */
    protected string $name;

    /**
     * @var string $document CPF/CNPJ da conta digital. Envie sem ponto ou traço
     * [11 .. 14] chars.
     */
    protected string $document;

    /**
     * @var string $email Email da conta digital
     * [0 .. 80] chars.
     */
    protected string $email;

    /**
     * @var string $phone Telefone da conta digital
     * [10 .. 16] chars.
     */
    protected string $phone;

    /**
     * @var int $businessArea Define a área de negócio da empresa.
     * @link https://dev.juno.com.br/api/v2#operation/getBusinessAreas
     */
    protected int $businessArea;

    /**
     * @var string $tradingName Nome fantasia.
     * Opcional para PJ.
     * Essa opção aparece apenas no endpoint para atualizar a conta.
     * [0 .. 80] chars
     */
    protected string $tradingName;

    /**
     * @var string $birthDate <date> Data de nascimento.
     * Obrigatório para contas PF.
     * 10 chars.
     */
    protected string $birthDate;

    /**
     * @var Address $address Endereço.
     */
    protected Address $address;

    /**
     * @var BankAccount $bankAccount Conta Bancária.
     */
    protected BankAccount $bankAccount;

    /**
     * @var LegalRepresentative|null $legalRepresentative Representante Legal.
     * Obrigatório para contas PJ.
     */
    protected ?LegalRepresentative $legalRepresentative = null;

    /**
     * @var string Cria uma conta digital.
     * @link https://dev.juno.com.br/api/v2#tag/Contas-Digitais
     */
    protected string $type = self::PAYMENT_ACCOUNT_TYPE;

    /**
     * @var string|null $linesOfBusiness Define a linha de negócio da empresa. Campo de livre preenchimento
     * [0 .. 100 chars]
     */
    protected ?string $linesOfBusiness = null;

    /**
     * @var string $businessUrl [0 .. 100 chars].
     */
    protected string $businessUrl;

    /**
     * @var bool|null $emailOptOut Define se a conta criada receberá ou não quaisquer emails Juno como os enviados nas
     * operações de emissão de cobranças, trasnferências, entre outros. Requer permissão avançada. Útil para
     * comunicações com seu cliente diretamente pela sua aplicação.
     */
    protected ?bool $emailOptOut = null;

    /**
     * @var bool|null $autoTransfer Define se as transferências da conta serão feitas automaticamente. Caso haja saldo
     * na conta digital em questão, a transferência será feita todos os dias. Requer permissão avançada.
     * PF.
     */
    protected ?bool $autoTransfer = null;

    /**
     * @var bool|null $socialName Define se o atributo name poderá ou não receber o nome social.
     * Válido apenas para PF.
     */
    protected ?bool $socialName = null;

    /**
     * @var float|null $monthlyIncomeOrRevenue Renda mensal ou receita.
     * Obrigatório para PF e PJ.
     */
    protected ?float $monthlyIncomeOrRevenue = null;

    /**
     * @var string|null $cnae Campo destinado ao CNAE(Classificação Nacional de Atividades Econômicas) da empresa.
     * Obrigatório para PJ.
     * 7 chars.
     */
    protected ?string $cnae = null;

    /**
     * @var string|null $establishmentDate Data de abertura da empresa.
     * Obrigatório para PJ.
     */
    protected ?string $establishmentDate = null;

    /**
     * @var bool|null $pep Define se o cadastro pertence a uma pessoa politicamente exposta.
     */
    protected ?bool $pep = null;

    /**
     * @var CompanyMember[]|null $companyMembers Quadro societário da empresa.
     * Obrigatório para contas PJ de companyType SA e LTDA.
     */
    protected ?array $companyMembers = null;

    /**
     * @param string $companyType
     * @return AccountDTO
     */
    public function setCompanyType(string $companyType): AccountDTO
    {
        $this->companyType = $companyType;
        return $this;
    }

    /**
     * @param string $name
     * @return AccountDTO
     */
    public function setName(string $name): AccountDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $document
     * @return AccountDTO
     */
    public function setDocument(string $document): AccountDTO
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @param string $email
     * @return AccountDTO
     */
    public function setEmail(string $email): AccountDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $phone
     * @return AccountDTO
     */
    public function setPhone(string $phone): AccountDTO
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param int $businessArea
     * @return AccountDTO
     */
    public function setBusinessArea(int $businessArea): AccountDTO
    {
        $this->businessArea = $businessArea;
        return $this;
    }

    /**
     * @param string $tradingName
     * @return AccountDTO
     */
    public function setTradingName(string $tradingName): AccountDTO
    {
        $this->tradingName = $tradingName;
        return $this;
    }

    /**
     * Obrigatório para contas PF.
     * YYYY-MM-DD
     * @param string $birthDate
     * @return AccountDTO
     */
    public function setBirthDate(string $birthDate): AccountDTO
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @param Address $address
     * @return AccountDTO
     */
    public function setAddress(Address $address): AccountDTO
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param BankAccount $bankAccount
     * @return AccountDTO
     */
    public function setBankAccount(BankAccount $bankAccount): AccountDTO
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    /**
     * @param LegalRepresentative|null $legalRepresentative
     * @return AccountDTO
     */
    public function setLegalRepresentative(?LegalRepresentative $legalRepresentative): AccountDTO
    {
        $this->legalRepresentative = $legalRepresentative;
        return $this;
    }

    /**
     * @param string $type
     * @return AccountDTO
     */
    public function setType(string $type): AccountDTO
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string|null $linesOfBusiness
     * @return AccountDTO
     */
    public function setLinesOfBusiness(?string $linesOfBusiness): AccountDTO
    {
        $this->linesOfBusiness = $linesOfBusiness;
        return $this;
    }

    /**
     * @param string $businessUrl
     * @return AccountDTO
     */
    public function setBusinessUrl(string $businessUrl): AccountDTO
    {
        $this->businessUrl = $businessUrl;
        return $this;
    }

    /**
     * @param bool|null $emailOptOut
     * @return AccountDTO
     */
    public function setEmailOptOut(?bool $emailOptOut): AccountDTO
    {
        $this->emailOptOut = $emailOptOut;
        return $this;
    }

    /**
     * @param bool|null $autoTransfer
     * @return AccountDTO
     */
    public function setAutoTransfer(?bool $autoTransfer): AccountDTO
    {
        $this->autoTransfer = $autoTransfer;
        return $this;
    }

    /**
     * @param bool|null $socialName
     * @return AccountDTO
     */
    public function setSocialName(?bool $socialName): AccountDTO
    {
        $this->socialName = $socialName;
        return $this;
    }

    /**
     * @param float|null $monthlyIncomeOrRevenue
     * @return AccountDTO
     */
    public function setMonthlyIncomeOrRevenue(?float $monthlyIncomeOrRevenue): AccountDTO
    {
        $this->monthlyIncomeOrRevenue = $monthlyIncomeOrRevenue;
        return $this;
    }

    /**
     * @param string|null $cnae
     * @return AccountDTO
     */
    public function setCnae(?string $cnae): AccountDTO
    {
        $this->cnae = $cnae;
        return $this;
    }

    /**
     * @param string|null $establishmentDate
     * @return AccountDTO
     */
    public function setEstablishmentDate(?string $establishmentDate): AccountDTO
    {
        $this->establishmentDate = $establishmentDate;
        return $this;
    }

    /**
     * @param bool|null $pep
     * @return AccountDTO
     */
    public function setPep(?bool $pep): AccountDTO
    {
        $this->pep = $pep;
        return $this;
    }

    /**
     * @param CompanyMember[]|null $companyMembers
     * @return AccountDTO
     */
    public function setCompanyMembers(?array $companyMembers): AccountDTO
    {
        $this->companyMembers = $companyMembers;
        return $this;
    }
}
