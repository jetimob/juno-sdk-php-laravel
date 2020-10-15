<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Transference\TransferenceRequest;
use Jetimob\Juno\Lib\Model\BankAccount;
use Jetimob\Juno\tests\TestCase;

class TransferTestCase extends TestCase
{
    public function testTransference()
    {
        $bankAccount = new BankAccount();
        $bankAccount->accountType = BankAccount::CHECKING_ACCOUNT_TYPE;
        $bankAccount->agencyNumber = '';
        $bankAccount->bankNumber = '';
        $bankAccount->accountNumber = '';

        $request = new TransferenceRequest();
        $request->document = '';
        $request->name = '';
        $request->amount = 1.0;
        $request->bankAccount = $bankAccount;

        $response = Juno::request($request, '');
        $this->assertResponse($response);
    }
}
