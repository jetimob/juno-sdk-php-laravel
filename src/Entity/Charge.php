<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class Charge implements \JsonSerializable
{
    use Serializable;

    public const PAYMENT_TYPE_BOLETO = 'BOLETO';
    public const PAYMENT_TYPE_BOLETO_PIX = 'BOLETO_PIX';
    public const PAYMENT_TYPE_CREDIT_CARD = 'CREDIT_CARD';

    /**
     * @var string $description Nesse campo deverá ser inserido informações referentes a produtos, serviços e afins
     * relacionados a essa cobrança.
     */
    protected string $description;

    /**
     * @var float|null $amount Valor total da parcela. O valor será aplicado para cada parcela. Se utilizado, não deverá
     * ser utilizado totalAmount.
     */
    protected ?float $amount = null;

    /**
     * @var string|null $pixKey Chave Pix aleatória associada a conta digital referenciada em X-Resource-Token.
     * Obrigatória para paymentTypes BOLETO_PIX
     */
    protected ?string $pixKey = null;

    /**
     * @var bool $pixIncludeImage Se habilitado, no response é retornado o campo imageInBase64.
     */
    protected bool $pixIncludeImage = true;

    /**
     * @var array|null $references Lista de references atrelada a cada cobrança gerada. O número de itens deve ser igual
     * ao número de parcelas.
     */
    protected ?array $references = null;

    /**
     * @var float|null $totalAmount Valor total da transação. Requer uso do parâmetro installments. Se utilizado, não
     * deverá ser utilizado amount.
     */
    protected ?float $totalAmount = null;

    /**
     * @var string|null $dueDate <date> Data de vencimento.
     */
    protected ?string $dueDate = null;

    /**
     * @var int|null $installments Número de parcelas.
     * Depende do tipo de pagamento:
     * -    BOLETO: até 24 parcelas;
     * -    CREDIT_CARD: até 12 parcelas;
     * -    BOLETO_PIX: até 24 parcelas.
     * Se houver mais de um tipo de pagamento, deve-se configurar o número de parcelas de acordo com o tipo que possui
     * o menor número de parcelas possível. Exemplos:
     * -    BOLETO, CREDIT_CARD: até 12 parcelas;
     * -    BOLETO_PIX, CREDIT_CARD: até 12 parcelas.
     */
    protected ?int $installments = null;

    /**
     * @var int|null $maxOverdueDays Número de dias permitido para pagamento após o vencimento.
     */
    protected ?int $maxOverdueDays = null;

    /**
     * @var float|null $fine Multa para pagamento após o vencimento. Recebe valores de 0.00 a 20.00. Só é efetivo se
     * maxOverdueDays for maior que zero.
     */
    protected ?float $fine = null;

    /**
     * @var float|null $interest Juros ao mês. Recebe valores de 0.00 a 20.00. Só é efetivo se maxOverdueDays for maior
     * que zero. O valor inserido é dividido pelo número de dias para cobrança de juros diária.
     */
    protected ?float $interest = null;

    /**
     * @var int|null $discountAmount Valor absoluto de desconto.
     */
    protected ?int $discountAmount = null;

    /**
     * @var int|null $discountDays Número de dias de desconto.
     */
    protected ?int $discountDays = null;

    /**
     * @var array|null $paymentTypes Tipos de pagamento permitidos BOLETO, BOLETO_PIX e CREDIT_CARD. Para checkout
     * transparente, deve receber obrigatoriamente o tipo CREDIT_CARD.
     *
     * Arranjos de tipos de pagamentos permitidos:
     *
     * - BOLETO
     * - BOLETO_PIX
     * - CREDIT_CARD
     * - BOLETO, CREDIT_CARD
     * - BOLETO_PIX, CREDIT_CARD
     *
     * Arranjos de tipos de pagamentos NÃO permitidos:
     *
     * - BOLETO, BOLETO_PIX
     */
    protected ?array $paymentTypes = null;

    /**
     * @var bool|null $paymentAdvance Define se a cobrança, quando paga, terá sua liberação de seu valor de recebimento
     * adiantada. Valido apenas para cartão de crédito. Se false, o pagamento não será antecipado.
     */
    protected ?bool $paymentAdvance = null;

    /**
     * @var string|null $feeSchemaToken Define o esquema de taxas alternativo para uma cobrança específica.
     * Para cobranças criadas com o objeto split, a taxa da emissão fica a cargo da conta que recebe true no chargeFee.
     */
    protected ?string $feeSchemaToken = null;

    /**
     * @var Split[]|null Divisão de valores de recebimento.
     */
    protected ?array $split = null;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @return string|null
     */
    public function getPixKey(): ?string
    {
        return $this->pixKey;
    }

    /**
     * @return bool
     */
    public function isPixIncludeImage(): bool
    {
        return $this->pixIncludeImage;
    }

    /**
     * @return array|null
     */
    public function getReferences(): ?array
    {
        return $this->references;
    }

    /**
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    /**
     * @return string|null
     */
    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    /**
     * @return int|null
     */
    public function getInstallments(): ?int
    {
        return $this->installments;
    }

    /**
     * @return int|null
     */
    public function getMaxOverdueDays(): ?int
    {
        return $this->maxOverdueDays;
    }

    /**
     * @return float|null
     */
    public function getFine(): ?float
    {
        return $this->fine;
    }

    /**
     * @return float|null
     */
    public function getInterest(): ?float
    {
        return $this->interest;
    }

    /**
     * @return int|null
     */
    public function getDiscountAmount(): ?int
    {
        return $this->discountAmount;
    }

    /**
     * @return int|null
     */
    public function getDiscountDays(): ?int
    {
        return $this->discountDays;
    }

    /**
     * @return array|null
     */
    public function getPaymentTypes(): ?array
    {
        return $this->paymentTypes;
    }

    /**
     * @return bool|null
     */
    public function getPaymentAdvance(): ?bool
    {
        return $this->paymentAdvance;
    }

    /**
     * @return string|null
     */
    public function getFeeSchemaToken(): ?string
    {
        return $this->feeSchemaToken;
    }

    /**
     * @return Split[]|null
     */
    public function getSplit(): ?array
    {
        return $this->split;
    }

    /**
     * @param string $description Nesse campo deverá ser inserido informações referentes a produtos, serviços e afins
     * relacionados a essa cobrança.
     * @return Charge
     */
    public function setDescription(string $description): Charge
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param float|null $amount Valor total da parcela. O valor será aplicado para cada parcela. Se utilizado, não
     * deverá ser utilizado totalAmount.
     * @return Charge
     */
    public function setAmount(?float $amount): Charge
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string|null $pixKey Chave Pix aleatória associada a conta digital referenciada em X-Resource-Token.
     * Obrigatória para paymentTypes BOLETO_PIX
     * @return Charge
     */
    public function setPixKey(?string $pixKey): Charge
    {
        $this->pixKey = $pixKey;
        return $this;
    }

    /**
     * @param bool $pixIncludeImage Se habilitado, no response é retornado o campo imageInBase64.
     * @return Charge
     */
    public function setPixIncludeImage(bool $pixIncludeImage): Charge
    {
        $this->pixIncludeImage = $pixIncludeImage;
        return $this;
    }

    /**
     * @param array|null $references Lista de references atrelada a cada cobrança gerada. O número de itens deve ser
     * igual ao número de parcelas.
     * @return Charge
     */
    public function setReferences(?array $references): Charge
    {
        $this->references = $references;
        return $this;
    }

    /**
     * @param float|null $totalAmount Valor total da transação. Requer uso do parâmetro installments. Se utilizado, não
     * deverá ser utilizado amount.
     * @return Charge
     */
    public function setTotalAmount(?float $totalAmount): Charge
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @param string|null $dueDate Data de vencimento.
     * @return Charge
     */
    public function setDueDate(?string $dueDate): Charge
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @param int|null $installments Número de parcelas.
     * Depende do tipo de pagamento:
     * -    BOLETO: até 24 parcelas;
     * -    CREDIT_CARD: até 12 parcelas;
     * -    BOLETO_PIX: até 24 parcelas.
     * Se houver mais de um tipo de pagamento, deve-se configurar o número de parcelas de acordo com o tipo que possui
     * o menor número de parcelas possível. Exemplos:
     * -    BOLETO, CREDIT_CARD: até 12 parcelas;
     * -    BOLETO_PIX, CREDIT_CARD: até 12 parcelas.
     * @return Charge
     */
    public function setInstallments(?int $installments): Charge
    {
        $this->installments = $installments;
        return $this;
    }

    /**
     * @param int|null $maxOverdueDays Número de dias permitido para pagamento após o vencimento.
     * @return Charge
     */
    public function setMaxOverdueDays(?int $maxOverdueDays): Charge
    {
        $this->maxOverdueDays = $maxOverdueDays;
        return $this;
    }

    /**
     * @param float|null $fine Multa para pagamento após o vencimento. Recebe valores de 0.00 a 20.00. Só é efetivo se
     * maxOverdueDays for maior que zero.
     * @return Charge
     */
    public function setFine(?float $fine): Charge
    {
        $this->fine = $fine;
        return $this;
    }

    /**
     * @param float|null $interest Juros ao mês. Recebe valores de 0.00 a 20.00. Só é efetivo se maxOverdueDays for
     * maior que zero. O valor inserido é dividido pelo número de dias para cobrança de juros diária.
     * @return Charge
     */
    public function setInterest(?float $interest): Charge
    {
        $this->interest = $interest;
        return $this;
    }

    /**
     * @param int|null $discountAmount Valor absoluto de desconto.
     * @return Charge
     */
    public function setDiscountAmount(?int $discountAmount): Charge
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    /**
     * @param int|null $discountDays Número de dias de desconto.
     * @return Charge
     */
    public function setDiscountDays(?int $discountDays): Charge
    {
        $this->discountDays = $discountDays;
        return $this;
    }

    /**
     * @param array|null $paymentTypes Tipos de pagamento permitidos BOLETO, BOLETO_PIX e CREDIT_CARD. Para checkout
     * transparente, deve receber obrigatoriamente o tipo CREDIT_CARD.
     *
     * Arranjos de tipos de pagamentos permitidos:
     *
     * - BOLETO
     * - BOLETO_PIX
     * - CREDIT_CARD
     * - BOLETO, CREDIT_CARD
     * - BOLETO_PIX, CREDIT_CARD
     *
     * Arranjos de tipos de pagamentos NÃO permitidos:
     *
     * - BOLETO, BOLETO_PIX
     * @return Charge
     */
    public function setPaymentTypes(?array $paymentTypes): Charge
    {
        $this->paymentTypes = $paymentTypes;
        return $this;
    }

    /**
     * @param bool|null $paymentAdvance Define se a cobrança, quando paga, terá sua liberação de seu valor de
     * recebimento adiantada. Valido apenas para cartão de crédito. Se false, o pagamento não será antecipado.
     * @return Charge
     */
    public function setPaymentAdvance(?bool $paymentAdvance): Charge
    {
        $this->paymentAdvance = $paymentAdvance;
        return $this;
    }

    /**
     * @param string|null $feeSchemaToken Define o esquema de taxas alternativo para uma cobrança específica.
     * Para cobranças criadas com o objeto split, a taxa da emissão fica a cargo da conta que recebe true no chargeFee.
     * @return Charge
     */
    public function setFeeSchemaToken(?string $feeSchemaToken): Charge
    {
        $this->feeSchemaToken = $feeSchemaToken;
        return $this;
    }

    /**
     * @param Split[]|null $split Divisão de valores de recebimento.
     * @return Charge
     */
    public function setSplit(?array $split): Charge
    {
        $this->split = $split;
        return $this;
    }

    public static function new(string $description): self
    {
        return (new static())
            ->setDescription($description);
    }

    public static function newWithAmount(string $description, float $amount): self
    {
        return static::new($description)
            ->setAmount($amount);
    }

    public static function newWithInstallments(string $description, float $totalAmount, int $installments): self
    {
        return static::new($description)
            ->setTotalAmount($totalAmount)
            ->setInstallments($installments);
    }
}
