<?php

namespace Jetimob\Juno\Api\Pix;

use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Api\AbstractApi;
use Jetimob\Juno\Entity\Pix\AdditionalInfo;
use Jetimob\Juno\Entity\Pix\Calendar;
use Jetimob\Juno\Entity\Pix\LegalPerson;
use Jetimob\Juno\Entity\Pix\MonetaryValue;
use Jetimob\Juno\Entity\Pix\PhysicalPerson;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Pix-Keys
 */
class PixApi extends AbstractApi
{
    /**
     * @param string $idempotencyKey - Simplificadamente, o conceito de idempotência está relacionado àqueles serviços
     * que quando chamados sempre retornam um mesmo resultado. Por exemplo, a consulta de um cadastro pela chave de
     * identificação do cadastro sempre retorna o mesmo cadastro. Algumas operações são idempotentes enquanto outras
     * não: criar um novo cadastro não é idempotente. A cada chamada do serviço, um novo cadastro é criado.
     * A chave de idempotência informada é associada ao objeto criado. Durante uma chamada, se a chave ainda não
     * existir, um novo objeto é criado e retornado. Mas, se a chave já existir, o objeto associado à chave é retornado.
     * Desta forma, várias chamadas com a mesma chave de idempotência sempre retornam o mesmo resultado.
     * @return CreatePixKeyResponse
     * @link https://dev.juno.com.br/api/v2#operation/createPixKey
     */
    public function createRandomPixKey(string $idempotencyKey): CreatePixKeyResponse
    {
        return $this->mappedPost('pix/keys', CreatePixKeyResponse::class, [
            RequestOptions::JSON => [
                'type' => 'RANDOM_KEY',
            ],
        ], [
            'X-Idempotency-Key' => $idempotencyKey,
        ]);
    }

    /**
     * @param string $idempotencyKey Simplificadamente, o conceito de idempotência está relacionado àqueles serviços que
     * @param bool $includeImage - Indica se a imagem do Qr Code deve ser incluída na resposta. O payload do Qr Code,
     * valor codificado na imagem, é sempre retornado.
     * @param string $key - Chave aleatória válida associada à Conta Digital do cliente. Formato UUIDv4.
     * @param float|null $amount - Valor da transação [ 0.01 .. 1000000 ].
     * @param string|null $reference - Identificador para conciliação do emissor/recebedor. Este valor será devolvido
     * juntamente com as informações referente às ocorrências de pagamento do QR Code.
     * @param string|null $additionalData - Dados adicionais. São incluidos no próprio QR Code.
     * quando chamados sempre retornam um mesmo resultado. Por exemplo, a consulta de um cadastro pela chave de
     * identificação do cadastro sempre retorna o mesmo cadastro. Algumas operações são idempotentes enquanto outras
     * não: criar um novo cadastro não é idempotente. A cada chamada do serviço, um novo cadastro é criado.
     * A chave de idempotência informada é associada ao objeto criado. Durante uma chamada, se a chave ainda não
     * existir, um novo objeto é criado e retornado. Mas, se a chave já existir, o objeto associado à chave é retornado.
     * Desta forma, várias chamadas com a mesma chave de idempotência sempre retornam o mesmo resultado.
     * @link https://dev.juno.com.br/api/v2#operation/createPixQrCodeStatic
     */
    public function createStaticQRCode(
        string $idempotencyKey,
        string $key,
        ?float $amount = null,
        bool $includeImage = false,
        ?string $reference = null,
        ?string $additionalData = null
    ): CreatePixStaticQRCodeResponse {
        return $this->mappedPost('pix/qrcodes/static', CreatePixStaticQRCodeResponse::class, [
            RequestOptions::JSON => [
                'includeImage' => $includeImage,
                'key' => $key,
                'amount' => $amount,
                'reference' => $reference,
                'additionalData' => $additionalData,
            ]
        ], [
            'X-Idempotency-Key' => $idempotencyKey,
        ]);
    }

    /**
     * @param string $txid O campo txid determina o identificador da transação. O objetivo desse campo é ser um elemento
     * que possibilite ao PSP do recebedor apresentar ao usuário recebedor a funcionalidade de conciliação de
     * pagamentos.
     * Na pacs.008, é referenciado como TransactionIdentification <txId> ou idConciliacaoRecebedor.
     * Em termos de fluxo de funcionamento, o txid é lido pelo aplicativo do PSP do pagador e, depois de confirmado o
     * pagamento, é enviado para o SPI via pacs.008. Uma pacs.008 também é enviada ao PSP do recebedor, contendo, além
     * de todas as informações usuais do pagamento, o txid. Ao perceber um recebimento dotado de txid, o PSP do
     * recebedor está apto a se comunicar com o usuário recebedor, informando que um pagamento específico foi liquidado.
     * O txid é criado exclusivamente pelo usuário recebedor e está sob sua responsabilidade. O txid, no contexto de
     * representação de uma cobrança, é único por CPF/CNPJ do usuário recebedor. Cabe ao PSP recebedor validar essa
     * regra na API Pix.
     * @param Calendar $calendar Os campos aninhados sob o identificador calendário organizam informações a respeito de
     * controle de tempo da cobrança.
     * @param MonetaryValue $value Valores monetários referentes à cobrança.
     * @param string $key O campo chave determina a chave Pix registrada no DICT que será utilizada para a cobrança.
     * Essa chave será lida pelo aplicativo do PSP do pagador para consulta ao DICT, que retornará a informação que
     * identificará o recebedor da cobrança.
     * O formato das chaves pode ser encontrado na seção "Formatação das chaves do DICT no BR Code" do Manual de Padrões
     * para iniciação do Pix.
     * Apenas o tipo de chave EVP/Randômica é aceita no momento.
     * @param PhysicalPerson|LegalPerson|null $debtor Os campos aninhados sob o objeto devedor são opcionais e
     * identificam o devedor, ou seja, a pessoa ou a instituição a quem a cobrança está endereçada. Não identifica,
     * necessariamente, quem irá efetivamente realizar o pagamento. Um CPF pode ser o devedor de uma cobrança, mas pode
     * acontecer de outro CPF realizar, efetivamente, o pagamento do documento. Não é permitido que o campo devedor.cpf
     * e campo devedor.cnpj estejam preenchidos ao mesmo tempo. Se o campo devedor.cnpj está preenchido, então o campo
     * devedor.cpf não pode estar preenchido, e vice-versa. Se o campo devedor.nome está preenchido, então deve existir
     * ou um devedor.cpf ou um campo devedor.cnpj preenchido.
     * @param string|null $payerRequest O campo solicitacaoPagador, opcional, determina um texto a ser apresentado ao
     * pagador para que ele possa digitar uma informação correlata, em formato livre, a ser enviada ao recebedor. Esse
     * texto será preenchido, na pacs.008, pelo PSP do pagador, no campo RemittanceInformation . O tamanho do campo na
     * pacs.008 está limitado a 140 caracteres.
     * @param AdditionalInfo[] $additionalInfo Cada respectiva informação adicional contida na lista (nome e valor) deve
     * ser apresentada ao pagador.
     */
    public function createImmediateCharge(
        string $txid,
        Calendar $calendar,
        MonetaryValue $value,
        string $key,
        $debtor = null,
        ?string $payerRequest = null,
        array $additionalInfo = []
    ) {
        return $this->mappedPut("pix-api/v2/cob/$txid", '', [
            RequestOptions::JSON => [
                'calendario' => $calendar,
                'devedor' => $debtor,
                'valor' => $value,
                'chave' => $key,
                'solicitacaoPagador' => $payerRequest,
                'infoAdicionais' => $additionalInfo,
            ],
        ]);
    }
}
