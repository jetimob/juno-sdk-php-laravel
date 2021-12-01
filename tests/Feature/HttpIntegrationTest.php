<?php

namespace Jetimob\Juno\Tests\Feature;

use Jetimob\Http\Authorization\OAuth\AccessToken;
use Jetimob\Juno\Tests\AbstractTestCase;

class HttpIntegrationTest extends AbstractTestCase
{
    /**
     * @test the serialized AccessToken didn't contain the scope property in jetimob/http-php-laravel:v1.3.1 and it was
     * breaking when we updated to v1.3.2 that introduced the scope option.
     */
    public function deserializationWithV131ShouldSucceed(): void
    {
        $serialized = 'C:44:"Jetimob\Http\Authorization\OAuth\AccessToken":750:{a:5:{i:0;s:564:"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy.zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz";i:1;N;i:2;i:86399;i:3;i:1638305746;i:4;a:3:{s:10:"token_type";s:6:"bearer";s:9:"user_name";s:22:"xxxxxxxxxx@jetimob.com";s:3:"jti";s:27:"000000000000000000000000000";}}}';
        /** @var AccessToken $accessToken */
        $accessToken = unserialize($serialized, ['allowed_classes' => [AccessToken::class]]);

        self::assertNotNull($accessToken);
        self::assertInstanceOf(AccessToken::class, $accessToken);
        self::assertSame('xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy.zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', $accessToken->getAccessToken());
        self::assertSame(1638305746, $accessToken->getGeneratedAt());
        self::assertSame(86399, $accessToken->getExpiresIn());
        self::assertSame('bearer', $accessToken->getExtraData('token_type'));
        self::assertSame('xxxxxxxxxx@jetimob.com', $accessToken->getExtraData('user_name'));
        self::assertSame('000000000000000000000000000', $accessToken->getExtraData('jti'));
    }
}
