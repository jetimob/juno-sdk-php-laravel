<?php

namespace Jetimob\Juno\Http;

use GuzzleHttp\RequestOptions;
use Jetimob\Http\Authorization\OAuth\AccessToken;
use Jetimob\Http\Authorization\OAuth\OAuthClient;
use Jetimob\Http\Authorization\OAuth\OAuthFlow;
use Jetimob\Http\Authorization\OAuth\TokenResolvers\OAuthTokenResolver;

class OAuthClientCredentialsTokenResolver extends OAuthTokenResolver
{
    /**
     * @param OAuthClient $client
     * @param string|null $credentials
     * @return AccessToken
     * @throws \JsonException
     */
    public function resolveAccessToken(OAuthClient $client, ?string $credentials = null): AccessToken
    {
        return $this->issueAccessTokenRequest(
            $client,
            OAuthFlow::CLIENT_CREDENTIALS,
            $credentials,
            static function (array $requestOptions) use ($client) {
                unset($requestOptions[RequestOptions::HEADERS]);
                $requestOptions[RequestOptions::FORM_PARAMS]['client_id'] = $client->getClientId();
                $requestOptions[RequestOptions::FORM_PARAMS]['client_secret'] = $client->getClientSecret();

                return $requestOptions;
            }
        );
    }
}
