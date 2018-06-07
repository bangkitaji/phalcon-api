<?php

namespace Niden\Tests\integration\library\Models;

use IntegrationTester;
use Lcobucci\JWT\ValidationData;
use function Niden\Core\envValue;
use Niden\Models\Users;


class UsersCest
{
    public function validateModel(IntegrationTester $I)
    {
        $I->haveModelDefinition(
            Users::class,
            [
                'usr_id',
                'usr_status_flag',
                'usr_username',
                'usr_password',
                'usr_domain_name',
                'usr_token_password',
                'usr_token_pre',
                'usr_token_mid',
                'usr_token_post',
                'usr_token_id',
            ]
        );
    }

    public function checkValidationData(IntegrationTester $I)
    {
        /** @var Users $user */
        $user = $I->haveRecordWithFields(
            Users::class,
            [
                'usr_status_flag'    => 1,
                'usr_username'       => 'testuser',
                'usr_password'       => 'testpassword',
                'usr_domain_name'    => 'https://niden.net',
                'usr_token_password' => '12345',
                'usr_token_pre'      => '',
                'usr_token_mid'      => '',
                'usr_token_post'     => '',
                'usr_token_id'       => '110011',
            ]
        );

        $validationData = new ValidationData();
        $validationData->setIssuer('https://niden.net');
        $validationData->setAudience(envValue('TOKEN_AUDIENCE', 'https://phalconphp.com'));
        $validationData->setId('110011');
        $validationData->setCurrentTime(time() + 10);

        $I->assertEquals($validationData, $user->getValidationData());
    }
}
