<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Juno\Api\Transference\TransferenceApi;
use Jetimob\Juno\Api\Transference\TransferenceResponse;
use Jetimob\Juno\Entity\BankAccount;
use Jetimob\Juno\Entity\PixBankAccount;
use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Tests\AbstractTestCase;

class TransferenceApiTest extends AbstractTestCase
{
    protected TransferenceApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = Juno::transference();
    }

    /** @test */
    public function transferenceApiShouldExist(): void
    {
        $this->assertNotNull($this->api);
        $this->assertInstanceOf(TransferenceApi::class, $this->api);
    }

    /** @test */
    public function defaultBankAccountTransferShouldSucceed(): void
    {
        $response = $this->api->defaultBankAccount(10.0);
        $this->assertInstanceOf(TransferenceResponse::class, $response);
    }

    /** @test */
    public function bankAccountTransferShouldSucceed(): void
    {
        $response = $this->api->bankAccount(
            'Renata Sophia Porto',
            '30370453450',
            10.0,
            BankAccount::checking('1107673', '00815')
                ->setAccountComplementNumber('9')
                ->setBankNumber('001')
        );

        $this->assertInstanceOf(TransferenceResponse::class, $response);
    }

    /** @test */
    public function pixTransferShouldSucceed(): void
    {
        $response = $this->api->pix(
            'Renata Sophia Porto',
            '30370453450',
            11.1,
            (new PixBankAccount())
                ->setAccountType(PixBankAccount::CHECKING_ACCOUNT_TYPE)
                ->setAccountComplementNumber('9')
                ->setAccountNumber('1107673')
                ->setAgencyNumber('00815')
                ->setBankNumber('001')

        );
        $this->assertInstanceOf(TransferenceResponse::class, $response);
    }
}
