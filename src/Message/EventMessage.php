<?php

namespace App\Message;

use App\Base\Message\Context;
use App\Enum\EventType;

class EventMessage
{
    public function __construct(
        private EventType $eventType,
        private Context $context,
    ) {}

    public function getEventType(): EventType
    {
        return $this->eventType;
    }

    public function getContext(): Context
    {
        return $this->context;
    }
}
