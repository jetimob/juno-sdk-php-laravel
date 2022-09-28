<?php

namespace Jetimob\Juno\Entity;

class PaymentBilling extends Billing
{
    /**
     * Pagamento realizados com cartão de crédito podem utilizar a funcionalidade de captura tardia. A captura tardia
     * consiste apenas na autorização de um pagamento sem a sua efetivação, o valor autorizado fica retido no limite
     * do cartão de crédito do pagador até a captura ou cancelamento.
     * @var bool $delayed
     */
    protected bool $delayed = false;

    /**
     * @return bool
     */
    public function isDelayed(): bool
    {
        return $this->delayed;
    }

    /**
     * @param bool $delayed
     *
     * @return Billing
     */
    public function setDelayed(bool $delayed): Billing
    {
        $this->delayed = $delayed;
        return $this;
    }
}
