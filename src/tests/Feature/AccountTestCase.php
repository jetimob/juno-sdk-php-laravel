<?php

namespace Jetimob\Juno\tests\Feature;

use Jetimob\Juno\Facades\Juno;
use Jetimob\Juno\Lib\Http\Account\AccountCreationRequest;
use Jetimob\Juno\Lib\Http\Account\AccountCreationResponse;
use Jetimob\Juno\Lib\Model\Address;
use Jetimob\Juno\Lib\Model\BankAccount;
use Jetimob\Juno\Lib\Model\ErrorDetail;
use Jetimob\Juno\tests\TestCase;
use Jetimob\Juno\Util\Console;

class AccountTestCase extends TestCase
{
    public function testAccountCreation()
    {
        $bankAccount = new BankAccount();
        $bankAccount->accountComplementNumber = '3';
        $bankAccount->accountNumber = '98758123';
        $bankAccount->bankNumber = '1';
        $bankAccount->agencyNumber = '4';
        $bankAccount->accountType = BankAccount::CHECKING_ACCOUNT_TYPE;

        $address = new Address();
        $address->street = 'tua Appel';
        $address->postCode = '97015030';
        $address->state = 'RS';
        $address->city = 'Santa Maria';
        $address->number = '347';

        $request = new AccountCreationRequest();
        $request->name = 'Diogo Gonçalves';
        $request->document = '93806420246';
        $request->email = 'meet@diogo.io';
        $request->phone = '54999000987';
        $request->birthDate = $request->formatDate(1983, 10, 13);
        $request->address = $address;
        $request->businessArea = 2015;
        $request->bankAccount = $bankAccount;
        $request->businessUrl = 'https://somesite.org';

//        $response = $this->app->get('juno')->request($request);
        /** @var AccountCreationResponse $response */
        $response = Juno::request($request, '');

        if ($response->failed()) {
            /** @var ErrorDetail $item */
            Console::log($response);
            foreach ($response->getDetails() as $item) {
                Console::log($item->getMessage());
            }
        }
    }
}
