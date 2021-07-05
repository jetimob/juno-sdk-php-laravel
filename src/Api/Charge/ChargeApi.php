<?php

namespace Jetimob\Juno\Api\Charge;

use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Api\AbstractApi;
use Jetimob\Juno\Entity\Billing;
use Jetimob\Juno\Entity\Charge;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Cobrancas
 */
class ChargeApi extends AbstractApi
{
    /**
     * Emita cobranças para cartão de crédito ou boleto, com ou sem split de pagamento.
     *
     * Para cobranças na modalidade split, é possível informar um ou mais destinatários para divisão, na qual o
     * recipientToken corresponde a cada conta digital envolvida. Caso o emissor delimitado no X-Resource-Token esteja
     * envolvido na divisão, este também deve ser informado em um dos objetos desse array, além dos demais
     * destinatários.
     *
     * Os parâmetros amount e percentage definem, respectivamente, a divisão do valor do split de maneira fixa ou
     * percentual, não podendo ser enviados juntos na requisição.
     *
     * Caso a divisão de valores resulte em um número com mais de 2 casas decimais, a partilha de valores não ocorre de
     * maneira exata, desse modo é preciso definir quem ficará com o remanescente em amountRemainder.
     *
     * @param Charge $charge
     * @param Billing $billing
     * @link https://dev.juno.com.br/api/v2#operation/createCharge
     * @return CreateChargeResponse
     */
    public function create(Charge $charge, Billing $billing): CreateChargeResponse
    {
        return $this->mappedPost('charges', CreateChargeResponse::class, [
            RequestOptions::JSON => [
                'charge' => $charge,
                'billing' => $billing,
            ],
        ]);
    }

    /**
     * Muito útil na conciliação de recebimentos este método fornece uma listagem por página das cobranças de uma conta
     * digital de acordo ao filtros disponíveis.
     *
     * Para avançar para as próximas páginas ou voltar para a página anterior deve ser utilizado os links previous e
     * next devolvidos na resposta da chamada.
     *
     * Devolve 20 cobranças por páginas, podendo ser estendido até 100 páginas com pageSize=100.
     *
     * @param ListChargesRequest|null $requestQueryParams
     * @return ChargeListResponse
     *@link https://dev.juno.com.br/api/v2#operation/listCharge
     */
    public function list(?ListChargesRequest $requestQueryParams = null): ChargeListResponse
    {
        return $this->mappedGet('charges', ChargeListResponse::class, [
            RequestOptions::QUERY => $requestQueryParams
        ]);
    }

    /**
     * Uma cobrança emitida emitida pode ser consultada a qualquer momento para que se obtenha seu estado atual.
     *
     * Para a consulta, utilize o ID da cobrança devolvido no momento da emissão.
     *
     * O ID seguirá o padrão de identidade prefixada conforme descrito na referência da API.
     *
     * @param string $chargeId
     * @link https://dev.juno.com.br/junoAPI20Integration.pdf referência da API
     * @link https://dev.juno.com.br/api/v2#operation/findById
     * @return FindChargeResponse
     */
    public function find(string $chargeId): FindChargeResponse
    {
        return $this->mappedGet("charges/$chargeId", FindChargeResponse::class);
    }

    /**
     * Uma cobrança emitida emitida pode ser cancelada a qualquer momento desde que não tenha recebido pagamento.
     *
     * Isso é válido para cobranças de qualquer paymentType que estejam como active, ou seja, em aberto.
     *
     * Para transações que tenham sido capturadas, seu cancelamento deve ser feito através desse recurso.
     *
     * O sucesso no cancelamento retornará um 204 de sucesso sem qualquer conteúdo.
     *
     * @param string $chargeId
     * @link https://dev.juno.com.br/api/v2#operation/cancelById
     * @return CancelChargeResponse
     */
    public function cancel(string $chargeId): CancelChargeResponse
    {
        return $this->mappedPut("charges/$chargeId/cancelation", CancelChargeResponse::class);
    }
}
