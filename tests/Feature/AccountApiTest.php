<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\Account\AccountApi;
use Jetimob\Juno\Api\Account\AccountDTO;
use Jetimob\Juno\Api\Account\CreateAccountResponse;
use Jetimob\Juno\Api\Account\FindAccountResponse;
use Jetimob\Juno\Entity\AccountHolder;
use Jetimob\Juno\Entity\Address;
use Jetimob\Juno\Entity\BankAccount;
use Jetimob\Juno\Entity\LegalRepresentative;
use Jetimob\Juno\Exception\JunoRequestException;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class AccountApiTest extends AbstractTestCase
{
    protected AccountApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::account();
    }

    /**
     * Todos os dados utilizados abaixo foram gerados aleatoriamente.
     * @return AccountDTO
     */
    protected function makePhysicalPersonAccountDTO(): AccountDTO
    {
        $name = 'John Doe';
        $document = '57707891074';

        return (new AccountDTO())
            ->setName($name)
            ->setDocument($document)
            ->setEmail('john.doe@somedomain.com')
            ->setPhone('+5533981287600')
            ->setLinesOfBusiness('FREE DESCRIPTION')
            ->setBusinessArea('1024')
            ->setBirthDate(Juno::toDateString(1990, 12, 12))
            ->setAddress(
                (new Address())
                    ->setCity('Novo Hamburgo')
                    ->setStreet('Rua principal')
                    ->setNumber('3905')
                    ->setState('RS')
                    ->setPostalCode('69954340')
            )->setBankAccount(
                (new BankAccount())
                    ->setBankNumber('237') // bradesco
                    ->setAgencyNumber('1792')
                    ->setAccountNumber('0779878')
                    ->setAccountComplementNumber('4')
                    ->setAccountType(BankAccount::CHECKING_ACCOUNT_TYPE)
                    ->setAccountHolder(
                        (new AccountHolder())
                            ->setName($name)
                            ->setDocument($document)
                    )
            );
    }

    /**
     * Todos os dados utilizados abaixo foram gerados aleatoriamente.
     * @return AccountDTO
     */
    protected function makeLegalPersonAccount(): AccountDTO
    {
        $name = 'John Doe LTDA';
        $cnpj = '03627536000120';
        $cpf = '33657214607';
        $birthDate = Juno::toDateString(1953, 03, 01);

        return (new AccountDTO())
            ->setName($name)
            ->setDocument($cnpj)
            ->setEmail('john.doe@companysa.com')
            ->setPhone('+556726232789')
            ->setLinesOfBusiness('FREE DESCRIPTION')
            ->setBusinessArea('1024')
            ->setBirthDate($birthDate)
            ->setCompanyType('MEI')
            ->setMonthlyIncomeOrRevenue(10000)
            ->setCnae('8599603')
            ->setEstablishmentDate(Juno::toDateString(2021, 01, 01))
            ->setLegalRepresentative(
                (new LegalRepresentative())
                    ->setName($name)
                    ->setDocument($cpf)
                    ->setBirthDate($birthDate)
            )->setAddress(
                (new Address())
                    ->setCity('Três Lagoas')
                    ->setStreet('Jardim Oiti')
                    ->setNumber('623')
                    ->setState('MS')
                    ->setPostalCode('79645514')
            )->setBankAccount(
                (new BankAccount())
                    ->setBankNumber('237') // bradesco
                    ->setAgencyNumber('3308')
                    ->setAccountNumber('1665676')
                    ->setAccountComplementNumber('3')
                    ->setAccountType(BankAccount::CHECKING_ACCOUNT_TYPE)
                    ->setAccountHolder(
                        (new AccountHolder())
                            ->setName($name)
                            ->setDocument($cpf)
                    )
            );
    }


    /** @test */
    public function accountApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(AccountApi::class, $this->api);
    }

    /**
     * Configurar o JUNO_RESOURCE_TOKEN na variável de ambiente (dentro do arquivo de configuração do phpunit).
     * @test
     */
    public function findDefaultAccountShouldSucceed(): void
    {
        $response = $this->api->find();
        $this->assertInstanceOf(FindAccountResponse::class, $response);
        $this->assertNotEmpty($response->getId());
        $this->assertNotEmpty($response->getType());
    }

    /**
     * Este teste só pode ser executado uma vez (não há como excluir uma conta na Juno por chamada via API).
     */
    public function createPhysicalAccountShouldSucceed(): void
    {
        $acc = $this->makePhysicalPersonAccountDTO();
        $response = $this->api->create($acc);
        $this->assertInstanceOf(CreateAccountResponse::class, $response);
        $this->assertNotEmpty($response->getId());
        $this->assertNotEmpty($response->getResourceToken());
    }

    /**
     * Este teste só pode ser executado uma vez (não há como excluir uma conta na Juno por chamada via API).
     */
    public function createLegalAccountShouldSucceed(): void
    {
        $acc = $this->makeLegalPersonAccount();
        $response = $this->api->create($acc);
        $this->assertInstanceOf(CreateAccountResponse::class, $response);
        $this->assertNotEmpty($response->getId());
        $this->assertNotEmpty($response->getResourceToken());
    }

    /**
     * O teste abaixo pode ser executado trocando os campos vazios por valores reais.
     * Ele foi deixado assim para não expor dados sensíveis, mesmo que sendo da conta sandbox.
     */
    public function findCreatedAccountShouldSucceed(): void
    {
        $response = $this->api->using('')->find();
        $this->assertInstanceOf(FindAccountResponse::class, $response);
        $this->assertSame('', $response->getId());
    }

    /** @test */
    public function createAccountWithInvalidPropertiesShouldFail(): void
    {
        $this->expectException(JunoRequestException::class);
        $account = $this->makePhysicalPersonAccountDTO();
        $account->setDocument('');
        $this->api->create($account);
    }
}
