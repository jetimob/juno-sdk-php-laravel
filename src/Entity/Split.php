<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class Split
{
    use Serializable;

    /**
     * @var string|null $recipientToken Define os destinatários do split.
     * Importante: Caso o emissor da cobrança seja também destinatário na divisão de valores, seu x-resource-token
     * também deve ser definido.
     */
    protected ?string $recipientToken;

    /**
     * @var float|null $amount Define o valor fixo que a conta vai receber. Caso seja enviado, não será aceito o
     * parâmetro percentage no objeto split.
     */
    protected ?float $amount;

    /**
     * @var float|null $percentage Define o valor percentual que a conta vai receber. Caso seja enviado, não será aceito
     * o parâmetro amount no objeto split.
     */
    protected ?float $percentage;

    /**
     * @var bool|null $amountReminder Indica quem recebe o valor restante em caso de uma divisão do valor total da
     * transação.
     */
    protected ?bool $amountReminder;

    /**
     * @var bool|null $chargeFee Indica se somente um recebedor será taxado ou se as taxas serão divididas
     * proporcionalmente entre todos os recebedores.
     */
    protected ?bool $chargeFee;

    /**
     * @return string|null
     */
    public function getRecipientToken(): ?string
    {
        return $this->recipientToken;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @return float|null
     */
    public function getPercentage(): ?float
    {
        return $this->percentage;
    }

    /**
     * @return bool|null
     */
    public function getAmountReminder(): ?bool
    {
        return $this->amountReminder;
    }

    /**
     * @return bool|null
     */
    public function getChargeFee(): ?bool
    {
        return $this->chargeFee;
    }

    /**
     * @param string|null $recipientToken Define os destinatários do split.
     * Importante: Caso o emissor da cobrança seja também destinatário na divisão de valores, seu x-resource-token
     * também deve ser definido.
     * @return Split
     */
    public function setRecipientToken(?string $recipientToken): Split
    {
        $this->recipientToken = $recipientToken;
        return $this;
    }

    /**
     * @param float|null $amount Define o valor fixo que a conta vai receber. Caso seja enviado, não será aceito o
     * parâmetro percentage no objeto split.
     * @return Split
     */
    public function setAmount(?float $amount): Split
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param float|null $percentage Define o valor percentual que a conta vai receber. Caso seja enviado, não será
     * aceito o parâmetro amount no objeto split.
     * @return Split
     */
    public function setPercentage(?float $percentage): Split
    {
        $this->percentage = $percentage;
        return $this;
    }

    /**
     * @param bool|null $amountReminder Indica quem recebe o valor restante em caso de uma divisão do valor total da
     * transação.
     * @return Split
     */
    public function setAmountReminder(?bool $amountReminder): Split
    {
        $this->amountReminder = $amountReminder;
        return $this;
    }

    /**
     * @param bool|null $chargeFee Indica se somente um recebedor será taxado ou se as taxas serão divididas
     * proporcionalmente entre todos os recebedores.
     * @return Split
     */
    public function setChargeFee(?bool $chargeFee): Split
    {
        $this->chargeFee = $chargeFee;
        return $this;
    }

    public static function new(): self
    {
        return new static();
    }
}
