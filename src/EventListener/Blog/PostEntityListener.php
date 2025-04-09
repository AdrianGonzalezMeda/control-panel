<?php

namespace App\EventListener\Blog;

use App\Entity\Blog\Post;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Post::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Post::class)]
class PostEntityListener
{

    public function __construct(
        private SluggerInterface $slugger,
    ) {}

    public function prePersist(Post $post, LifecycleEventArgs $event)
    {
        $post->computeSlug($this->slugger);
    }

    public function preUpdate(Post $post, LifecycleEventArgs $event)
    {
        $post->computeSlug($this->slugger);
    }
}
