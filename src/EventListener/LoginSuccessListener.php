<?php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsEventListener(event: LoginSuccessEvent::class)]
class LoginSuccessListener
{
    public function __construct(
        private RequestStack $requestStack,
        private TranslatorInterface $translator,
    ) {
    }

    public function __invoke(LoginSuccessEvent $event): void
    {
        /**
         * @var User $user
         */
        $user = $event->getUser();

        $session = $this->requestStack->getSession();
        $session->getFlashBag()->add('info', $this->translator->trans('flash.welcome', ['%firstname%' => $user->getFirstname()]));
    }
}