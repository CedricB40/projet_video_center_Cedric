<?php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

#[AsEventListener(event: LoginSuccessEvent::class)]
class LoginSuccessListener
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function __invoke(LoginSuccessEvent $event): void
    {
        /**
         * @var User $user
         */
        $user = $event->getUser();

        $session = $this->requestStack->getSession();
        $session->getFlashBag()->add('info', 'Bienvenue ' . $user->getFirstname() . ' !');
    }
}