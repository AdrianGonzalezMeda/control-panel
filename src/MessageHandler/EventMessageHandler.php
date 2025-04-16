<?php

namespace App\MessageHandler;

use App\Enum\EventType;
use App\Message\EventMessage;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class EventMessageHandler
{
    public function __construct(
        private MailerInterface $mailer,
        private EntityManagerInterface $em,
        private LoggerInterface $logger,
        #[Autowire('%system_email%')] private string $systemEmail
    ) {}

    public function __invoke(EventMessage $event)
    {
        $context = $event->getContext();
        
        switch ($event->getEventType()) {
            case EventType::POST_CREATED:
                $post = $this->em->getRepository($context->getEntityClass())->find($context->getEntityId());
                $user = $post->getCreatedByUser();

                if (!$user) {
                    $this->logger->error('User not found for post creation', [
                        'postId' => $post->getId(),
                        'event' => $event,
                    ]);
                    return;
                }

                // TODO: estaría bien condicionar el no recibir el email si el post se ha creado como publicado
                $this->mailer->send((new NotificationEmail())
                ->subject('New comment posted')
                ->htmlTemplate('Email/Notification/post_notification.html.twig')
                ->from($this->systemEmail)
                ->to($user->getEmail())
                ->context(['post' => $post])
            );
        }
    }
}
