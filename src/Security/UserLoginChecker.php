<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserLoginChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        // Check if the user is active
        if (!$user->isActive()) {
            throw new CustomUserMessageAccountStatusException('Your account is not active yet.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        // .. Fill up later on
    }

    // security.yaml ( firewalls "target:path" )
}
