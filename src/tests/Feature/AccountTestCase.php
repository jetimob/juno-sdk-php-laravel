<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Account\AccountCreationRequest;
use Jetimob\Juno\Lib\Http\Account\AccountCreationResponse;
use Jetimob\Juno\Lib\Model\AccountHolder;
use Jetimob\Juno\Lib\Model\Address;
use Jetimob\Juno\Lib\Model\BankAccount;
use Jetimob\Juno\Lib\Model\LegalRepresentative;
use Jetimob\Juno\tests\TestCase;

class AccountTestCase extends TestCase
{
    public function testAccountCreation()
    {
        $legalRepresentative = new LegalRepresentative();
        $legalRepresentative->name      = '';
        $legalRepresentative->document  = '';
        $legalRepresentative->birthDate = Juno::formatDate(1983, 10, 13);

        $accountHolder = new AccountHolder();
        $accountHolder->name     = '';
        $accountHolder->document = '';

        $bankAccount = new BankAccount();
        $bankAccount->accountComplementNumber = '';
        $bankAccount->accountNumber = '';
        $bankAccount->bankNumber    = '';
        $bankAccount->agencyNumber  = '';
        $bankAccount->accountType   = BankAccount::CHECKING_ACCOUNT_TYPE;
        $bankAccount->accountHolder = $accountHolder;

        $address = new Address();
        $address->street   = '';
        $address->postCode = '';
        $address->state    = '';
        $address->city     = '';
        $address->number   = '';

        $request = new AccountCreationRequest();
        $request->name      = '';
        $request->document  = '';
        $request->email     = '';
        $request->phone     = '';
        $request->birthDate = Juno::formatDate(1983, 10, 13);
        $request->address   = $address;
        $request->businessArea = 2003;
        $request->bankAccount  = $bankAccount;

        $request->legalRepresentative = $legalRepresentative;
        $request->companyType         = '';

        $request->establishmentDate = Juno::formatDate(2010, 10, 13);
        $request->cnae = '';
        $request->monthlyIncomeOrRevenue = 0;

        $member = new LegalRepresentative();
        $member->name      = '';
        $member->document  = '';
        $member->birthDate = Juno::formatDate(1983, 10, 13);

        $request->companyMembers = [
            $member
        ];

        /** @var AccountCreationResponse $response */
        $response = Juno::request($request, '');
        $this->assertResponse($response);
    }
}
