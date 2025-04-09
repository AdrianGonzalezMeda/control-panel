<?php

namespace App\EventListener\Blog;

use App\Entity\Blog\Category;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Category::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Category::class)]
class CategoryEntityListener
{

    public function __construct(
        private SluggerInterface $slugger,
    ) {}

    public function prePersist(Category $category, LifecycleEventArgs $event)
    {
        $category->computeSlug($this->slugger);
    }

    public function preUpdate(Category $category, LifecycleEventArgs $event)
    {
        $category->computeSlug($this->slugger);
    }
}
