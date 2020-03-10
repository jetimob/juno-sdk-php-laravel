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
        $legalRepresentative->name = '';
        $legalRepresentative->document = '';
        $legalRepresentative->birthDate = Juno::formatDate(1983, 10, 13);

        $accountHolder = new AccountHolder();
        $accountHolder->document = '';
        $accountHolder->name = '';

        $bankAccount = new BankAccount();
        $bankAccount->accountComplementNumber = '';
        $bankAccount->accountNumber = '';
        $bankAccount->bankNumber = '';
        $bankAccount->agencyNumber = '';
        $bankAccount->accountType = BankAccount::CHECKING_ACCOUNT_TYPE;
        $bankAccount->accountHolder = $accountHolder;

        $address = new Address();
        $address->street = '';
        $address->postCode = '';
        $address->state = '';
        $address->city = '';
        $address->number = '';

        $request = new AccountCreationRequest();
        $request->name = '';
        $request->document = '';
        $request->email = '';
        $request->phone = '';
        $request->birthDate = Juno::formatDate(1983, 10, 13);
        $request->address = $address;
        $request->type = AccountCreationRequest::PAYMENT_ACCOUNT_TYPE;
        $request->businessArea = 2015;
        $request->bankAccount = $bankAccount;
        $request->businessUrl = '';
        $request->legalRepresentative = $legalRepresentative;
        $request->linesOfBusiness = '';
        $request->companyType = '';

        /** @var AccountCreationResponse $response */
        $response = Juno::request($request, '');
        $this->assertResponse($response);
    }
}
