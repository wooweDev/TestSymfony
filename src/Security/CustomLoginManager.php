<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class CustomLoginManager implements AuthenticationSuccessHandlerInterface
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    // user redirection depending of role
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $user = $token->getUser();

        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return new RedirectResponse($this->router->generate('admin_dashboard'));
        }

        return new RedirectResponse($this->router->generate('user_dashboard'));
    }

    // security.yaml ( add success handler )
}
