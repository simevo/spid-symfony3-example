<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;

// https://api.symfony.com/3.4/Symfony/Component/Security/Core/User/UserInterface.html
class SpidUser implements UserInterface
{
    public function __construct($username, $password, $salt, array $roles)
    {
    }

    public function getRoles()
    {
        return ['role'];
    }

    public function getPassword()
    {
        return '';
    }

    public function getSalt()
    {
        return '';
    }

    public function getUsername()
    {
        return 'user';
    }

    public function eraseCredentials()
    {
    }
}