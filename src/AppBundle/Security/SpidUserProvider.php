<?php

namespace AppBundle\Security;

use AppBundle\Security\SpidUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

// https://api.symfony.com/3.4/Symfony/Component/Security/Core/User/UserProviderInterface.html
class SpidUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->fetchUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof SpidUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $username = $user->getUsername();

        return $this->fetchUser($username);
    }

    public function supportsClass($class)
    {
        return SpidUser::class === $class;
    }

    private function fetchUser($username)
    {
        return new SpidUser($username, '', '', ['role']);
    }

}
