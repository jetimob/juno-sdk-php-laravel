<?php

namespace Jetimob\Juno\Api\Charge;

class ListChargesRequest
{
    /** @var string|null $createdOnStart yyyy-MM-dd Busca pela criação da cobrança a partir dessa data */
    public ?string $createdOnStart = null;

    /** @var string|null $createdOnEnd yyyy-MM-dd Busca pela criação da cobrança até */
    public ?string $createdOnEnd = null;

    /** @var string|null $dueDateStart yyyy-MM-dd Busca por vencimentos a partir dessa data */
    public ?string $dueDateStart = null;

    /** @var string|null $dueDateEnd yyyy-MM-dd Busca por vencimentos a partir até essa data */
    public ?string $dueDateEnd = null;

    /** @var string|null $paymentDateStart yyyy-MM-dd Busca por pagamentos a partir dessa data */
    public ?string $paymentDateStart = null;

    /** @var string|null $paymentDateEnd yyyy-MM-dd Busca por pagamentos até essa data */
    public ?string $paymentDateEnd = null;

    /** @var bool|null $showUnarchived Mostra cobranças que não foram ou estão arquivadas */
    public ?bool $showUnarchived = null;

    /** @var bool|null $showArchived Mostra cobranças que foram ou estão arquivadas */
    public ?bool $showArchived = null;

    /** @var bool|null $showDue Mostra cobranças vencidas */
    public ?bool $showDue = null;

    /** @var bool|null $showNotDue Mostra cobranças que não estão vencidas */
    public ?bool $showNotDue = null;

    /** @var bool|null $showPaid Mostra cobranças pagas */
    public ?bool $showPaid = null;

    /** @var bool|null $showNotPaid Mostra cobranças que não estão pagas */
    public ?bool $showNotPaid = null;

    /** @var bool|null $showCancelled Mostra cobranças canceladas */
    public ?bool $showCancelled = null;

    /** @var bool|null $showNotCancelled Mostra cobranças que não estão canceladas */
    public ?bool $showNotCancelled = null;

    /** @var bool|null $showManualReconciliation Mostra cobranças que foram baixadas manualmente */
    public ?bool $showManualReconciliation = null;

    /** @var bool|null $showNotManualReconciliation Mostra cobranças que não foram baixadas manualmente */
    public ?bool $showNotManualReconciliation = null;

    /** @var bool|null $showNotFailed Mostra cobranças que tiveram falha no pagamento. (Checkout transparente) */
    public ?bool $showNotFailed = null;

    /** @var string|null $orderBy Enum: "id" "dueDate" "amount" "paymentDate" Ordenação cobranças pelos filtros id, dueDate, amount e paymentDate */
    public ?string $orderBy = null;

    /** @var bool|null $orderAsc Ordenação cobranças ascendente ou descentente */
    public ?bool $orderAsc = null;

    /** @var int|null $pageSize Quantidade de cobranças por página */
    public ?int $pageSize = null;

    /** @var int|null $page Número identificador da página */
    public ?int $page = null;

    /** @var string|null $firstObjectId <ObjectId> Define a partir de qual objeto charge será feita a busca */
    public ?string $firstObjectId = null;

    /** @var string|null $firstValue Define a partir de qual valor será feita a busca */
    public ?string $firstValue = null;

    /** @var string|null $lastObjectId <ObjectId> Define até qual objeto charge será feita a busca */
    public ?string $lastObjectId = null;

    /** @var string|null $lastValue Define até qual valor será feita a busca */
    public ?string $lastValue = null;

    /**
     * @param string|null $createdOnStart yyyy-MM-dd Busca pela criação da cobrança a partir dessa data
     * @return ListChargesRequest
     */
    public function setCreatedOnStart(?string $createdOnStart): ListChargesRequest
    {
        $this->createdOnStart = $createdOnStart;
        return $this;
    }

    /**
     * @param string|null $createdOnEnd yyyy-MM-dd Busca pela criação da cobrança até
     * @return ListChargesRequest
     */
    public function setCreatedOnEnd(?string $createdOnEnd): ListChargesRequest
    {
        $this->createdOnEnd = $createdOnEnd;
        return $this;
    }

    /**
     * @param string|null $dueDateStart yyyy-MM-dd Busca por vencimentos a partir dessa data
     * @return ListChargesRequest
     */
    public function setDueDateStart(?string $dueDateStart): ListChargesRequest
    {
        $this->dueDateStart = $dueDateStart;
        return $this;
    }

    /**
     * @param string|null $dueDateEnd yyyy-MM-dd Busca por vencimentos a partir até essa data
     * @return ListChargesRequest
     */
    public function setDueDateEnd(?string $dueDateEnd): ListChargesRequest
    {
        $this->dueDateEnd = $dueDateEnd;
        return $this;
    }

    /**
     * @param string|null $paymentDateStart yyyy-MM-dd Busca por pagamentos a partir dessa data
     * @return ListChargesRequest
     */
    public function setPaymentDateStart(?string $paymentDateStart): ListChargesRequest
    {
        $this->paymentDateStart = $paymentDateStart;
        return $this;
    }

    /**
     * @param string|null $paymentDateEnd yyyy-MM-dd Busca por pagamentos até essa data
     * @return ListChargesRequest
     */
    public function setPaymentDateEnd(?string $paymentDateEnd): ListChargesRequest
    {
        $this->paymentDateEnd = $paymentDateEnd;
        return $this;
    }

    /**
     * @param bool|null $showUnarchived Mostra cobranças que não foram ou estão arquivadas
     * @return ListChargesRequest
     */
    public function setShowUnarchived(?bool $showUnarchived): ListChargesRequest
    {
        $this->showUnarchived = $showUnarchived;
        return $this;
    }

    /**
     * @param bool|null $showArchived Mostra cobranças que foram ou estão arquivadas
     * @return ListChargesRequest
     */
    public function setShowArchived(?bool $showArchived): ListChargesRequest
    {
        $this->showArchived = $showArchived;
        return $this;
    }

    /**
     * @param bool|null $showDue Mostra cobranças vencidas
     * @return ListChargesRequest
     */
    public function setShowDue(?bool $showDue): ListChargesRequest
    {
        $this->showDue = $showDue;
        return $this;
    }

    /**
     * @param bool|null $showNotDue Mostra cobranças que não estão vencidas
     * @return ListChargesRequest
     */
    public function setShowNotDue(?bool $showNotDue): ListChargesRequest
    {
        $this->showNotDue = $showNotDue;
        return $this;
    }

    /**
     * @param bool|null $showPaid Mostra cobranças pagas
     * @return ListChargesRequest
     */
    public function setShowPaid(?bool $showPaid): ListChargesRequest
    {
        $this->showPaid = $showPaid;
        return $this;
    }

    /**
     * @param bool|null $showNotPaid Mostra cobranças que não estão pagas
     * @return ListChargesRequest
     */
    public function setShowNotPaid(?bool $showNotPaid): ListChargesRequest
    {
        $this->showNotPaid = $showNotPaid;
        return $this;
    }

    /**
     * @param bool|null $showCancelled Mostra cobranças canceladas
     * @return ListChargesRequest
     */
    public function setShowCancelled(?bool $showCancelled): ListChargesRequest
    {
        $this->showCancelled = $showCancelled;
        return $this;
    }

    /**
     * @param bool|null $showNotCancelled Mostra cobranças que não estão canceladas
     * @return ListChargesRequest
     */
    public function setShowNotCancelled(?bool $showNotCancelled): ListChargesRequest
    {
        $this->showNotCancelled = $showNotCancelled;
        return $this;
    }

    /**
     * @param bool|null $showManualReconciliation Mostra cobranças que foram baixadas manualmente
     * @return ListChargesRequest
     */
    public function setShowManualReconciliation(?bool $showManualReconciliation): ListChargesRequest
    {
        $this->showManualReconciliation = $showManualReconciliation;
        return $this;
    }

    /**
     * @param bool|null $showNotManualReconciliation Mostra cobranças que não foram baixadas manualmente
     * @return ListChargesRequest
     */
    public function setShowNotManualReconciliation(?bool $showNotManualReconciliation): ListChargesRequest
    {
        $this->showNotManualReconciliation = $showNotManualReconciliation;
        return $this;
    }

    /**
     * @param bool|null $showNotFailed Mostra cobranças que tiveram falha no pagamento. (Checkout transparente)
     * @return ListChargesRequest
     */
    public function setShowNotFailed(?bool $showNotFailed): ListChargesRequest
    {
        $this->showNotFailed = $showNotFailed;
        return $this;
    }

    /**
     * @param string|null $orderBy Enum: "id" "dueDate" "amount" "paymentDate" Ordenação cobranças pelos filtros id,
     * dueDate, amount e paymentDate
     * @return ListChargesRequest
     */
    public function setOrderBy(?string $orderBy): ListChargesRequest
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param bool|null $orderAsc Ordenação cobranças ascendente ou descentente
     * @return ListChargesRequest
     */
    public function setOrderAsc(?bool $orderAsc): ListChargesRequest
    {
        $this->orderAsc = $orderAsc;
        return $this;
    }

    /**
     * @param int|null $pageSize Quantidade de cobranças por página
     * @return ListChargesRequest
     */
    public function setPageSize(?int $pageSize): ListChargesRequest
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @param int|null $page Número identificador da página
     * @return ListChargesRequest
     */
    public function setPage(?int $page): ListChargesRequest
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param string|null $firstObjectId <ObjectId> Define a partir de qual objeto charge será feita a busca
     * @return ListChargesRequest
     */
    public function setFirstObjectId(?string $firstObjectId): ListChargesRequest
    {
        $this->firstObjectId = $firstObjectId;
        return $this;
    }

    /**
     * @param string|null $firstValue Define a partir de qual valor será feita a busca
     * @return ListChargesRequest
     */
    public function setFirstValue(?string $firstValue): ListChargesRequest
    {
        $this->firstValue = $firstValue;
        return $this;
    }

    /**
     * @param string|null $lastObjectId <ObjectId> Define até qual objeto charge será feita a busca
     * @return ListChargesRequest
     */
    public function setLastObjectId(?string $lastObjectId): ListChargesRequest
    {
        $this->lastObjectId = $lastObjectId;
        return $this;
    }

    /**
     * @param string|null $lastValue Define até qual valor será feita a busca
     * @return ListChargesRequest
     */
    public function setLastValue(?string $lastValue): ListChargesRequest
    {
        $this->lastValue = $lastValue;
        return $this;
    }
}
