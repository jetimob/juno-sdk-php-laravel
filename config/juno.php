<?php

declare(strict_types=1);

/*
 |--------------------------------------------------------------------------
 | ENDPOINTS
 |--------------------------------------------------------------------------
 |
 | @link https://dev.juno.com.br/api/v2#tag/Componentes
 |
 */
$endpoints = [
    'sandbox' => [
        'base_uri' => 'https://sandbox.boletobancario.com/api-integration/',
        'oauth_token_uri' => 'https://sandbox.boletobancario.com/authorization-server/oauth/token',
    ],
    'production' => [
        'base_uri' => 'https://api.juno.com.br/',
        'oauth_token_uri' => 'https://api.juno.com.br/authorization-server/oauth/token',
    ],
];

return [
    /*
    |--------------------------------------------------------------------------
    | X-Resource-Token
    |--------------------------------------------------------------------------
    |
    | Muitos dos recursos também necessitam de um token de recurso, X-Resource-Token que identifica a conta digital
    | que deverá ser utilizada durante a execução de uma operação. Cada conta digital tem o seu próprio token de
    | recurso.
    | Contas digitais criadas via API incluem o token de recurso na resposta da requisição. Para obter o token de
    | recurso de uma conta digital já existente ou para redefinir o token de recurso, o cliente precisa acessar o
    | painel do cliente Juno e realizar esta operação na aba Integração, opção Token Privado.
    |
    | O `resource_token` é utilizado como valor padrão para o header 'X-Resource-Token' que identifica uma conta
    | dentro da API da Juno e pode ser sobrescrito programaticamente da seguinte forma:
    |
    | Juno::{$endpoint}()->using('X-Resource-Token')->find();
    */

    'resource_token' => env('JUNO_RESOURCE_TOKEN'),

    'http' => [
        /*
        |--------------------------------------------------------------------------
        | Client ID
        |--------------------------------------------------------------------------
        |
        | Deve ser gerado dentro da aplicação da Juno.
        | @link https://dev.juno.com.br/api/v2#operation/getAccessToken
        |
        */

        'oauth_client_id' => env('JUNO_CLIENT_ID'),

        /*
        |--------------------------------------------------------------------------
        | Client Secret
        |--------------------------------------------------------------------------
        |
        | Deve ser gerado dentro da aplicação da Juno.
        | @link https://dev.juno.com.br/api/v2#operation/getAccessToken
        |
        */

        'oauth_client_secret' => env('JUNO_CLIENT_SECRET'),

        /*
        |--------------------------------------------------------------------------
        | Retries
        |--------------------------------------------------------------------------
        |
        | Quantas vezes uma requisição pode ser reexecutada (em caso de falha) antes de gerar uma exceção.
        |
        */

        'retries' => 0,

        /*
        |--------------------------------------------------------------------------
        | Retry On Status Code
        |--------------------------------------------------------------------------
        |
        | Em quais códigos HTTP de uma resposta falha podemos tentar reexecutar a requisição.
        |
        */

        'retry_on_status_code' => [401],

        /*
        |--------------------------------------------------------------------------
        | Retry Delay
        |--------------------------------------------------------------------------
        |
        | Antes de tentar reexecutar uma requisição falha, aguardar em ms.
        |
        */

        'retry_delay' => 2000,

        /*
        |--------------------------------------------------------------------------
        | Guzzle
        |--------------------------------------------------------------------------
        |
        | Configurações passadas à instância do Guzzle.
        | @link https://docs.guzzlephp.org/en/stable/request-options.html
        |
        */

        'guzzle' => [
            'base_uri' => $endpoints[env('JUNO_ENVIRONMENT', 'sandbox')]['base_uri'],

            /*
            |--------------------------------------------------------------------------
            | Connect Timeout
            |--------------------------------------------------------------------------
            |
            | Quantos segundos esperar por uma conexão com o servidor da Juno. 0 significa sem limite de espera.
            | https://docs.guzzlephp.org/en/stable/request-options.html#connect-timeout
            |
            */

            'connect_timeout' => 10.0,

            /*
            |--------------------------------------------------------------------------
            | Timeout
            |--------------------------------------------------------------------------
            |
            | Quantos segundos esperar pela resposta do servidor. 0 significa sem limite de espera.
            | @link https://docs.guzzlephp.org/en/stable/request-options.html#timeout
            |
            */

            'timeout' => 0.0,

            /*
            |--------------------------------------------------------------------------
            | Debug
            |--------------------------------------------------------------------------
            |
            | Usar true para ativar o modo debug do Guzzle.
            | @link https://docs.guzzlephp.org/en/stable/request-options.html#debug
            |
            */

            'debug' => false,

            /*
            |--------------------------------------------------------------------------
            | Middlewares
            |--------------------------------------------------------------------------
            |
            | @link https://docs.guzzlephp.org/en/stable/handlers-and-middleware.html#middleware
            |
            */

            'middlewares' => [
                \Jetimob\Http\Middlewares\OAuthRequestMiddleware::class,
            ],

            /*
            |--------------------------------------------------------------------------
            | Headers
            |--------------------------------------------------------------------------
            |
            | Headers de requisição.
            | @link https://docs.guzzlephp.org/en/stable/request-options.html#headers
            |
            */

            'headers' => [
                // Versão da API da Juno
                'X-Api-Version' => 2,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | OAuth Access Token Repository
        |--------------------------------------------------------------------------
        |
        | Essa classe é responsável por gerenciar os AccessTokens. Por padrão ela utiliza o repositório de cache padrão.
        |
        | PRECISA implementar \Jetimob\Http\Authorization\OAuth\Storage\CacheRepositoryContract
        */

        'oauth_access_token_repository' => \Jetimob\Http\Authorization\OAuth\Storage\CacheRepository::class,

        /*
        |--------------------------------------------------------------------------
        | OAuth Token Cache Key Resolver
        |--------------------------------------------------------------------------
        |
        | Classe responsável por gerar uma chave de identificação única para o cliente OAuth.
        |
        | PRECISA implementar \Jetimob\Http\Authorization\OAuth\Storage\AccessTokenCacheKeyResolverInterface
        */

        'oauth_token_cache_key_resolver' =>
            \Jetimob\Http\Authorization\OAuth\Storage\AccessTokenCacheKeyResolver::class,

        /*
        |--------------------------------------------------------------------------
        | OAuth Client Resolver
        |--------------------------------------------------------------------------
        |
        | Classe responsável por resolver o client OAuth.
        |
        | PRECISA implementar \Jetimob\Http\Authorization\OAuth\ClientProviders\OAuthClientResolverInterface
        */

        'oauth_client_resolver' => \Jetimob\Http\Authorization\OAuth\ClientProviders\OAuthClientResolver::class,

        'oauth_access_token_resolver' => [
            \Jetimob\Http\Authorization\OAuth\OAuthFlow::CLIENT_CREDENTIALS =>
                \Jetimob\Juno\Http\OAuthClientCredentialsTokenResolver::class,
        ],

        'oauth_token_uri' => $endpoints[env('JUNO_ENVIRONMENT', 'sandbox')]['oauth_token_uri'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Implementação dos endpoints da API
    |--------------------------------------------------------------------------
    |
    | Escolheu-se dar a opção de sobrescrever a implementação de um endpoint para que, se necessário, possam ser
    | modificados sem a necessidade de alterar o pacote original.
    |
    | A única obrigatoriedade é que a classe estenda \Jetimob\Juno\Api\AbstractApi.
    |
    | Chaves também podem ser adicionadas neste vetor e assim serem chamadas direto da facade.
    |
    */

    'api_impl' => [
        'account' => \Jetimob\Juno\Api\Account\AccountApi::class,
        'additionalData' => \Jetimob\Juno\Api\AdditionalData\AdditionalDataApi::class,
        'balance' => \Jetimob\Juno\Api\Balance\BalanceApi::class,
        'charge' => \Jetimob\Juno\Api\Charge\ChargeApi::class,
        'credentials' => \Jetimob\Juno\Api\Credentials\CredentialsApi::class,
        'document' => \Jetimob\Juno\Api\Document\DocumentApi::class,
        'pix' => \Jetimob\Juno\Api\Pix\PixApi::class,
        'transference' => \Jetimob\Juno\Api\Transference\TransferenceApi::class,
        'webhook' => \Jetimob\Juno\Api\Webhook\WebhookApi::class,
    ],
];
