<?php

namespace App\EventListener\Blog;

use App\Base\Message\Context;
use App\Entity\Blog\Post;
use App\Enum\EventType;
use App\Message\EventMessage;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Post::class)]
#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Post::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Post::class)]
class PostEntityListener
{

    public function __construct(
        private SluggerInterface $slugger,
        private MessageBusInterface $bus,
    ) {}

    public function prePersist(Post $post, LifecycleEventArgs $event)
    {
        $post->computeSlug($this->slugger);
    }

    public function postPersist(Post $post, LifecycleEventArgs $event)
    {
        $context = new Context($post->getId(), Post::class);
        $this->bus->dispatch(new EventMessage(EventType::POST_CREATED, $context));
    }

    public function preUpdate(Post $post, LifecycleEventArgs $event)
    {
        $post->computeSlug($this->slugger);
    }
}
