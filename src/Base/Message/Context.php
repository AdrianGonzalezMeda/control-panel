<?php

namespace App\Base\Message;


class Context 
{
    public function __construct(
        private int $entityId,
        private string $entityClass
    ){}

    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function getEntityClass(): string
    {
        return $this->entityClass;
    }
}