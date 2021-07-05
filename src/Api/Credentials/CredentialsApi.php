<?php

namespace Jetimob\Juno\Api\Credentials;

use GuzzleHttp\Psr7\Response;
use Jetimob\Juno\Api\AbstractApi;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Credenciais
 */
class CredentialsApi extends AbstractApi
{
    /**
     * Obtenha a chave pública associada à conta digital para envio de arquivo JWE.
     *
     * @link https://dev.juno.com.br/api/v2#operation/secureUploadDocument
     * @link https://dev.juno.com.br/api/v2#operation/getPublicKey
     * @return Response
     */
    public function credentials(): Response
    {
        return $this->request('get', 'credentials/public-key');
    }
}
