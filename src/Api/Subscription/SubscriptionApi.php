<?php

namespace Jetimob\Juno\Api\Subscription;

use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Api\AbstractApi;
use Jetimob\Juno\Entity\Billing;
use Jetimob\Juno\Entity\CreditCardDetails;
use Jetimob\Juno\Entity\Split;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Assinatura
 */
class SubscriptionApi extends AbstractApi
{
    /**
     * O primeiro passo para ter suas cobranças recorrentes é criando um plano de assinaturas. O plano de assinaturas
     * possui as configurações das cobranças que serão geradas.
     *
     * @param string $name Define o nome do plano de assinatura.
     * @param float $amount Define o valor fixo do plano de assinatura.
     * @return CreatePlanResponse
     * @link https://dev.juno.com.br/api/v2#operation/createPlans
     */
    public function createPlan(string $name, float $amount): CreatePlanResponse
    {
        return $this->mappedPost('plans', CreatePlanResponse::class, [
            RequestOptions::JSON => [
                'name' => $name,
                'amount' => $amount,
            ],
        ]);
    }

    /**
     * Retorna uma listagem de todos os planos criados para consulta.
     *
     * @link https://dev.juno.com.br/api/v2#operation/listPlans
     * @return PlanListResponse
     */
    public function listPlans(): PlanListResponse
    {
        return $this->mappedGet('plans', PlanListResponse::class);
    }

    /**
     * Retorna as informações de um plano existente por meio do ID do plano.
     *
     * @param string $planId <ObjectId> Id do plano
     * @return CreatePlanResponse
     * @link https://dev.juno.com.br/api/v2#operation/getPlansById
     */
    public function findPlan(string $planId): CreatePlanResponse
    {
        return $this->mappedGet("plans/$planId", CreatePlanResponse::class);
    }

    /**
     * Desativa um plano com status ACTIVE a partir de seu ID específico.
     *
     * @param string $planId <ObjectId> Id do plano
     * @return CreatePlanResponse
     * @link https://dev.juno.com.br/api/v2#operation/getPlansById
     */
    public function disablePlan(string $planId): CreatePlanResponse
    {
        return $this->mappedPost("plans/$planId/deactivation", CreatePlanResponse::class);
    }

    /**
     * Reativa um plano com status INACTIVE a partir de seu ID específico.
     *
     * @param string $planId <ObjectId> Id do plano
     * @return CreatePlanResponse
     * @link https://dev.juno.com.br/api/v2#operation/activePlanById
     */
    public function enablePlan(string $planId): CreatePlanResponse
    {
        return $this->mappedPost("plans/$planId/activation", CreatePlanResponse::class);
    }

    /**
     * Para criar uma assinatura, é necessário ter um plano de assinatura primeiro. Caso você ainda não tenha, a
     * explicação está na seção “Criar um plano”.
     * Com o plano criado, você pode criar uma assinatura no plano por meio do id específico planId.
     *
     * @param int $dueDay Dia do mês de vencimento da assinatura.
     * @param string $planId Identificação do plano de assinatura criado.
     * @param string $chargeDescription Nesse campo deverá ser inserido informações referentes a produtos, serviços e
     * afins relacionados a essa cobrança.
     * @param CreditCardDetails $cardDetails
     * @param Billing $billing
     * @param Split|null $split Divisão de valores de recebimento.
     * @return CreateSubscriptionResponse
     */
    public function create(
        int $dueDay,
        string $planId,
        string $chargeDescription,
        CreditCardDetails $cardDetails,
        Billing $billing,
        ?Split $split = null
    ): CreateSubscriptionResponse {
        return $this->mappedPost('subscriptions', CreateSubscriptionResponse::class, [
            RequestOptions::JSON => [
                'dueDay' => $dueDay,
                'planId' => $planId,
                'chargeDescription' => $chargeDescription,
                'creditCardDetails' => $cardDetails,
                'billing' => $billing,
                'split' => $split,
            ],
        ]);
    }

    /**
     * Retorna uma lista de assinaturas criadas no plano.
     *
     * @link https://dev.juno.com.br/api/v2#operation/listSubscriptions
     * @return SubscriptionListResponse
     */
    public function list(): SubscriptionListResponse
    {
        return $this->mappedGet('subscriptions', SubscriptionListResponse::class);
    }

    /**
     * Retorna as informações de uma assinatura a partir de seu ID específico.
     *
     * @param string $subscriptionId
     * @link https://dev.juno.com.br/api/v2#operation/getSubscriptionById
     * @return CreateSubscriptionResponse
     */
    public function find(string $subscriptionId): CreateSubscriptionResponse
    {
        return $this->mappedGet("subscriptions/$subscriptionId", CreateSubscriptionResponse::class);
    }

    /**
     * Desativa uma assinatura com status ACTIVE a partir de seu ID de identificação.
     *
     * @param string $subscriptionId
     * @link https://dev.juno.com.br/api/v2#operation/inactiveSubscriptionById
     * @return CreateSubscriptionResponse
     */
    public function disable(string $subscriptionId): CreateSubscriptionResponse
    {
        return $this->mappedPost("subscriptions/$subscriptionId/deactivation");
    }

    /**
     * Reativa uma assinatura com status INACTIVE a partir de seu ID de identificação.
     *
     * @param string $subscriptionId
     * @link https://dev.juno.com.br/api/v2#operation/activeSubscriptionById
     * @return CreateSubscriptionResponse
     */
    public function enable(string $subscriptionId): CreateSubscriptionResponse
    {
        return $this->mappedPost("subscriptions/$subscriptionId/activation");
    }

    /**
     * Faz o cancelamento definitivo de uma assinatura a partir de seu ID específico. Esta ação não pode ser desfeita.
     * Caso queira desativar momentaneamente, para depois reativar, considere desativar a assinatura.
     *
     * @param string $subscriptionId
     * @link https://dev.juno.com.br/api/v2#operation/cancelSubscriptionById
     * @return CreateSubscriptionResponse
     */
    public function cancel(string $subscriptionId): CreateSubscriptionResponse
    {
        return $this->mappedPost("subscriptions/$subscriptionId/cancelation");
    }

    /**
     * Completa ou finaliza uma assinatura a partir de seu ID específico.
     *
     * @param string $subscriptionId
     * @link https://dev.juno.com.br/api/v2#operation/completeSubscriptionById
     * @return CreateSubscriptionResponse
     */
    public function end(string $subscriptionId): CreateSubscriptionResponse
    {
        return $this->mappedPost("subscriptions/$subscriptionId/completion");
    }
}
