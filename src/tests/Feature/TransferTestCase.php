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
        $bankAccount->agencyNumber = '2941';
        $bankAccount->bankNumber = '237';
        $bankAccount->accountNumber = '89524';

        $request = new TransferenceRequest();
        $request->document = '01566139058';
        $request->name = 'Alan Weingartner';
        $request->amount = 1.0;
        $request->bankAccount = $bankAccount;

        $response = Juno::request($request, '');
        $this->assertResponse($response);
    }
}
