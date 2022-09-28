<?php

namespace Jetimob\Juno\Api\Webhook;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Api\AbstractApi;
use Jetimob\Juno\Api\Webhook\Notification\PaymentNotification;
use Jetimob\Juno\Api\Webhook\Notification\TransferNotification;
use Jetimob\Juno\Entity\WebhookEventType;
use Jetimob\Juno\Exception\InvalidArgumentException;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Notificacoes
 */
class WebhookApi extends AbstractApi
{
    /**
     * Traz a lista de tipos de eventos disponíveis na plataforma Juno.
     * Os itens retornados são os que estão disponíveis para serem subescritos pelos webhooks que vierem a ser
     * cadastrados.
     * Atenção: Apenas os eventos habilitados serão enviados para os webhooks cadastrados.
     * Abaixo uma lista dos eventos hoje disponíveis e seus escopos:
     * - DIGITAL_ACCOUNT_STATUS_CHANGED: Mudanças de status de uma conta digital
     * - DIGITAL_ACCOUNT_CREATED: Confirmação de criação de uma conta digital - Válido somente para a solução Whitelabel
     * - DOCUMENT_STATUS_CHANGED: Mudanças de status de um documento da conta digital
     * - TRANSFER_STATUS_CHANGED: Mudanças de status de uma transferência
     * - P2P_TRANSFER_STATUS_CHANGED: Mudanças de status de uma transferência P2P
     * - CHARGE_STATUS_CHANGED: Mudanças de status de uma cobrança emitida
     * - CHARGE_READ_CONFIRMATION: Confirmação de leitura/visualização de uma cobrança
     * - PAYMENT_NOTIFICATION: Pagamento de uma cobranças
     *
     * @link https://dev.juno.com.br/api/v2#operation/getEventTypes
     * @return WebhookTypeListResponse
     */
    public function listTypes(): WebhookTypeListResponse
    {
        return $this->mappedGet('notifications/event-types', WebhookTypeListResponse::class);
    }

    /**
     * Cadastre um ou mais webhooks para receber os tipos de notificação subescritos nos eventos disponíveis.
     * Os webhooks e inscrição a um evento precisa ser única por recurso, o que significa que cada conta digital DEVE
     * ter seu próprio webhook registrado. Não há webhook global. Você pode usar o endpoint para todos os registros de
     * webhook, com ou sem parametros de cadeia de consulta.
     *
     * Atenção: O webhook deve usar HTTP sobre SSL encriptado e começar com https://.
     *
     * Não é possível se inscrever em um evento que já tenha esteja com uma inscrição ativa. Este deve ser desativado
     * para que uma nova inscrição seja feita.
     *
     * Explicando o processo de assinatura:
     *
     * Em resposta a esta solicitação, devolvemos os dados básicos do cadastro, a identificação do webhook e uma chave
     * (secret) exclusiva para o webhook cadastrado. A chave é utilizada para assinar os eventos que serão enviados para
     * o webhook e também para validar a assinatura dos eventos recebidos pelo webhook. Portanto, é muito importante que
     * a chave seja armazenada de forma apropriada para que a assinatura dos eventos recebidos possa ser verificada
     * adequadamente.
     *
     * O processo de assinatura do evento é o seguinte:
     *
     * O evento é assinado utilizando-se o algoritmo HMAC (SHA-256), que recebe como entrada o conteúdo do evento
     * (payload) e a chave do webhook.
     * O algoritmo nos devolve um hash (assinatura) que é enviado no header do request HTTP (campo X-Signature).
     * Esquematicamente: x_signature = hmac(secret, event_content).
     *
     * Como deve ser o processo de verificação da assinatura, do lado do webhook, durante a recepção de uma mensagem:
     *
     * O cliente deve assinar o conteúdo do evento da mesma forma descrita acima e assim gerar um hash (assinatuda) do
     * payload do evento. O conteúdo da mensagem HTTP deve ser assinada antes de qualquer formatação.
     * O hash gerado deve ser comparado com o hash enviado no header do request HTTP, campo X-Signature.
     * Os valores devem ser iguais.
     * Esquematicamente: verification = hmac(secret, event_content). O que deve implicar que:
     * verification == http_header[X-Signature].
     *
     * O que isso significa?
     *
     * Quando os valores das assinaturas são idênticos, significa que o conteúdo do evento que saiu dos nossos
     * servidores chegou exatamente igual no servidor do cliente.
     * Caso os valores não sejam iguais, pode significar que o conteúdo do evento foi adulterado durante o trajeto e
     * portanto deve ser ignorado.
     * Também pode significar que alguma outra fonte pode estar enviando mensagens indevidas para a url de notificação
     * do cliente, e portanto, estas mensagens não são de fonte confiável e devem ser ignoradas.
     * Outros pontos importantes que podem não estar claros:
     * O cadastro de webhooks é por conta digital. X-Resource-Token deve ser informado para indicar a conta onde o
     * webhook será cadastrado.
     *
     * Não é permitido que dois webhooks da mesma conta digital assinem os mesmo eventos.
     *
     * @param string $url
     * @param string[] $eventTypes
     * @link https://dev.juno.com.br/api/v2#operation/getEventTypes eventos disponíveis
     * @link https://dev.juno.com.br/api/v2#operation/createWebhook
     * @see WebhookEventType para os tipos de eventos válidos
     * @return FindWebhookResponse
     */
    public function create(string $url, array $eventTypes): FindWebhookResponse
    {
        return $this->mappedPost('notifications/webhooks', FindWebhookResponse::class, [
            RequestOptions::JSON => [
                'url' => $url,
                'eventTypes' => $eventTypes,
            ],
        ]);
    }

    /**
     * Retorna uma lista completa dos webhooks cadastrados para a conta digital e suas respectivas inscrições.
     *
     * @link https://dev.juno.com.br/api/v2#operation/getWebhooks
     * @return WebhookListResponse
     */
    public function list(): WebhookListResponse
    {
        return $this->mappedGet('notifications/webhooks', WebhookListResponse::class);
    }

    /**
     * Retorna o webhook específicado.
     * A partir do id específico retornado no momento da criação deste webhook, faça a consulta deste e verifique o
     * estado atual e o evento para o qual foi inscrito.
     * Caso o estado e/ou o tipo de evento esteja diferente do esperado, atualize o webhook.
     *
     * @param string $webhookId
     * @link https://dev.juno.com.br/api/v2#operation/findWebhook
     * @return FindWebhookResponse
     */
    public function find(string $webhookId): FindWebhookResponse
    {
        return $this->mappedGet("notifications/webhooks/$webhookId", FindWebhookResponse::class);
    }

    /**
     * Atualize os campos status e eventTypes dos webhooks cadastradados.
     * Ao menos um dos campos precisa ser mudado, não sendo necessário a mudança de ambos ao mesmo tempo. Entretanto,
     * envie ambos os campos mesmo que apenas um destes venha a ser modificado.
     * A url do Webhook não pode ser modificada.
     *
     * @param string $webhookId
     * @param string $status - Enum: "ACTIVE" ou "INACTIVE"
     * @param string[] $eventTypes
     * @link https://dev.juno.com.br/api/v2#operation/updateWebhook
     * @see WebhookEventType para os tipos de eventos válidos
     * @return FindWebhookResponse
     */
    public function update(string $webhookId, string $status, array $eventTypes): FindWebhookResponse
    {
        return $this->mappedPatch("notifications/webhooks/$webhookId", FindWebhookResponse::class, [
            RequestOptions::JSON => [
                'status' => $status,
                'eventTypes' => $eventTypes,
            ],
        ]);
    }

    /**
     * Deleta um webhook.
     * Esta operação não deleta os eventos que já foram despachados para os webhooks listados.
     *
     * @param string $webhookId
     * @link https://dev.juno.com.br/api/v2#operation/deleteWebhook
     * @return Response
     */
    public function delete(string $webhookId): Response
    {
        return $this->request('delete', "notifications/webhooks/$webhookId");
    }

    /**
     * @param PaymentNotification|TransferNotification $notification
     * @param array $requestHeaders
     * @param string $secret
     * @return bool
     * @throws \JsonException
     */
    public function checkNotificationSignature($notification, array $requestHeaders, string $secret): bool
    {
        $signature = $requestHeaders['X-Signature'] ?? null;
        $data = $notification->getHydrationData()['data'] ?? null;

        if (is_null($signature)) {
            throw new InvalidArgumentException('Header de assinatura ausente');
        }

        if (is_null($data)) {
            throw new InvalidArgumentException('Falha ao obter os dados do webhook. Campo \'data\' ausente');
        }

        $hash = hash_hmac('sha256', json_encode($data, JSON_THROW_ON_ERROR), $secret);

        return hash_equals($signature, $hash);
    }
}
