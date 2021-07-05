<?php

namespace Jetimob\Juno\Entity\Notification;

trait EntityBaseTrait
{
    protected string $entityId;
    protected string $entityType;

    /**
     * @return string
     */
    public function getEntityId(): string
    {
        return $this->entityId;
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }
}
