<?php

namespace Jetimob\Juno\Api\Payment;

use GuzzleHttp\RequestOptions;
use Jetimob\Http\Response;
use Jetimob\Juno\Api\AbstractApi;
use Jetimob\Juno\Entity\CreditCardDetails;
use Jetimob\Juno\Entity\PaymentBilling;
use Throwable;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Pagamentos-(Checkout-Transparente)
 */
class PaymentApi extends AbstractApi
{
    /**
     * Ao ser utilizado, o recurso permite que o cartão utilizado nesse processo seja tokenizado, ou seja, tenha seus
     * dados convertido em uma um ID que pode ser armazenado em seguida para ser utilizado em funcionalidades do próprio
     * sistema como armazenamento do cartão para compras futuras.
     *
     * Não indicamos a tokenização de cartões virtuais com prazo de expiração limitado ou ainda aqueles que se tornam
     * inválidos após um único uso.
     *
     * Esta permissão será habilitada automaticamente logo após a criação das credenciais através da plataforma Juno.
     *
     * @link https://dev.juno.com.br/api/v2#operation/tokenizeCreditCard
     *
     * @param string $creditCardHash - hash gerada utilizando a biblioteca de criptografia da própria Juno
     * @link https://dev.juno.com.br/api/v2#tag/Biblioteca-de-Criptografia
     *
     * @return Response
     * @throws Throwable
     */
    public function tokenization(string $creditCardHash): Response
    {
        return $this->mappedPost('credit-cards/tokenization', TokenizationResponse::class, [
            RequestOptions::JSON => [
                'creditCardHash' => $creditCardHash
            ]
        ]);
    }


    /**
     * Para cobranças cujo paymentType é CREDIT_CARD podem ser pagas logo em seguida sua criação.
     * Através desse endpoint você cria um pagamento para a cobrança emitida identificada a partir de seu chargeId
     * retornado no momento de sua geração.
     *
     * Este recurso permite a captura tardia de pagamento, ou seja, através dele é possível obter e segurar o valor da
     * transação no saldo do cartão em questão sem concluír este pagamento efetivamente, muito utilizado na prestação
     * de serviços.
     *
     * Para utilizar o recurso dessa forma é preciso que o parâmetro delayed receba o valor true, resultando em um
     * pagamento capturado que recebe o status AUTHORIZED. Caso contrário, o pagamento será efetuado normalmente com
     * status CONFIRMED.
     *
     * IMPORTANTE: caso o pagamento tenha sido recusado, faça uma nova tentativa utilizando o chargeId da cobrança
     * já criada. Não é necessário criar uma nova cobrança para este processo.
     *
     * @link https://dev.juno.com.br/api/v2#operation/createPayment
     *
     * @param string $chargeId
     * @param PaymentBilling $billing
     * @param CreditCardDetails $creditCardDetails
     *
     * @return Response
     * @throws Throwable
     */
    public function createPayment(string $chargeId, PaymentBilling $billing, CreditCardDetails $creditCardDetails): Response
    {
        return $this->mappedPost('payments', CreatePaymentResponse::class, [
            RequestOptions::JSON => [
                'chargeId' => $chargeId,
                'billing' => $billing,
                'creditCardDetails' => $creditCardDetails
            ],
        ]);
    }


    /**
     * Faz o estorno total ou parcial de transações de cartão de crédito.
     *
     * Afeta todas as cobranças geradas e todos os pagamentos já realizados, até mesmo para os casos em que o pagamento
     * tenha sido parcelado.
     *
     * Para estorno parcial, a quantidade definida em amount deve ser menor que o valor total da transação. Caso não
     * seja passado nenhum valor nesse parâmetro, será feito o estorno total da transação.
     *
     * Se no endpoint não for passado o valor, vai ser estornado o total, se for menor o parcial.
     *
     * Caso a cobrança indicada tenha sido criada com o split, no momento do estorno deve ser definido novamente no body
     * os destinatários do split.
     *
     * @link https://dev.juno.com.br/api/v2#operation/refundPayment
     *
     * @param string $id
     * @param float $amount
     * @param array $split
     *
     * @return Response
     * @throws Throwable
     */
    public function refund(string $id, float $amount, array $split): Response
    {
        return $this->mappedPost("payments/$id/refunds", RefundResponse::class, [
            RequestOptions::JSON => [
                'amount' => $amount,
                'split' => $split,
            ],
        ]);
    }

    /**
     * Faz a captura total ou parcial de transações previamente autorizadas no cartão de crédito.
     *
     * Afeta todas as cobranças geradas, até mesmo para os casos em que o pagamento tenha sido parcelado.
     *
     * Para captura parcial, a quantidade definida em amount deve ser menor que o valor total da transação.
     * Caso não seja passado nenhum valor nesse parâmetro, será feita a captura total da transação.
     *
     * Se no endpoint não for passado o valor, vai ser capturado o total, se for menor o parcial.
     *
     * @param string $id - example pay_413FC8BB8D33C4862AD2EAE31BA72D1E Id do pagamento
     * @param string $chargeId
     * @param float $amount
     *
     * @link https://dev.juno.com.br/api/v2#operation/capturePayment
     *
     * @return Response
     * @throws Throwable
     */
    public function capture(string $id, string $chargeId, float $amount): Response
    {
        return $this->mappedPost("payments/$id/capture", CaptureResponse::class, [
            RequestOptions::JSON => [
                'chargeId' => $chargeId,
                'amount' => $amount,
            ],
        ]);
    }
}
