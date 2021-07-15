<?php

namespace Jetimob\Juno;

use Jetimob\Http\Contracts\HttpProviderContract;
use Jetimob\Http\Http;
use Jetimob\Juno\Api\Account\AccountApi;
use Jetimob\Juno\Api\AdditionalData\AdditionalDataApi;
use Jetimob\Juno\Api\Balance\BalanceApi;
use Jetimob\Juno\Api\Charge\ChargeApi;
use Jetimob\Juno\Api\Credentials\CredentialsApi;
use Jetimob\Juno\Api\Document\DocumentApi;
use Jetimob\Juno\Api\Pix\PixApi;
use Jetimob\Juno\Api\Transference\TransferenceApi;
use Jetimob\Juno\Api\Webhook\WebhookApi;
use Jetimob\Juno\Exception\RuntimeException;

/**
 * @method AccountApi account()
 * @method AdditionalDataApi additionalData()
 * @method BalanceApi balance()
 * @method ChargeApi charge()
 * @method CredentialsApi credentials()
 * @method DocumentApi documents()
 * @method PixApi pix()
 * @method TransferenceApi transference()
 * @method WebhookApi webhook()
 */
class Juno implements HttpProviderContract
{
    protected Http $client;
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->client = new Http($config['http'] ?? []);
        $this->config = $config;
    }

    /**
     * @return Http
     */
    public function getHttpInstance(): Http
    {
        return $this->client;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config ?? [];
    }

    /**
     * Retorna uma data do tipo ISO 8601, utilizada pela Juno.
     *
     * @param int|string $year
     * @param int|string $month
     * @param int|string $day
     * @return string
     */
    public function dateToString($year, $month, $day): string
    {
        return sprintf('%s-%02s-%02s', $year, $month, $day);
    }

    public function __call(string $name, array $arguments)
    {
        if (!($apiImpl = $this->config['api_impl'] ?? null) || !array_key_exists($name, $apiImpl)) {
            throw new RuntimeException("O endpoint '$name' não foi implementado ou não existe");
        }

        return new $apiImpl[$name]($this);
    }
}
