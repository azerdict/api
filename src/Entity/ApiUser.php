<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="ad_api_user")
 * @ORM\Entity(repositoryClass="App\Repository\ApiUserRepository")
 */
class ApiUser implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $apiKey;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return [new Role('ROLE_API_USER')];
    }

    /**
     * @return string|void
     */
    public function getPassword()
    {
        return;
    }

    /**
     * @return null|string|void
     */
    public function getSalt()
    {
        return;
    }

    /**
     * Not used.
     */
    public function eraseCredentials()
    {
        return;
    }
}
