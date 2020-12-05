<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class AddAuthorToPostSubscriber implements EventSubscriberInterface
{

    /** @var TokenStorageInterface */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {

        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['attachAuthor', EventPriorities::PRE_WRITE],
        ];
    }

    public function attachAuthor(ViewEvent $event)
    {
        $post = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$post instanceof Post || Request::METHOD_POST !== $method) {

            // Only handle Article entities (Event is called on any Api entity)
            return;
        }

        // maybe these extra null checks are not even needed
        $token = $this->tokenStorage->getToken();
        if (!$token) {
            dd('no token found');
            return;
        }

        $owner = $token->getUser();
        if (!$owner instanceof User) {
            dd('no instance of user found');
            return;
        }

        $post->setAuthor($owner);
    }
}