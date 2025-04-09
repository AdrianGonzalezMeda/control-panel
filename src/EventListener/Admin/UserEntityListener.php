<?php
/**
 * Documentation Doctrine Entity Listeners https://symfony.com/doc/6.4/doctrine/events.html#doctrine-entity-listeners
 */

namespace App\EventListener\Admin;

use App\Entity\Admin\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsEntityListener(event: 'prePersist', method: 'prePersist', entity: User::class)]
class UserEntityListener
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher){}

    public function prePersist(User $user, LifecycleEventArgs $args): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );

        $user->setPassword($hashedPassword);
    }
}