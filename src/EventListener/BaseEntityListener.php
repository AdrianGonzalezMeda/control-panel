<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::prePersist, priority: 0)]
#[AsDoctrineListener(event: Events::preUpdate, priority: 0)]
class BaseEntityListener
{

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!method_exists($entity, 'setCreated') || !method_exists($entity, 'setModified')) {
            return;
        }

        $entity->setCreated(new \DateTimeImmutable());
        $entity->setModified(new \DateTime());
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!method_exists($entity, 'setModified')) {
            return;
        }
        
        $entity->setModified(new \DateTime());
    }
}
