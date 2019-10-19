<?php
declare(strict_types=1);
namespace User\Entity;

use Zend\Expressive\Authentication\UserInterface;

/**
 * Class User
 * @package User\Entity
 */
class User implements UserInterface
{
    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $login;

    /**
     *
     * @var string
     */
    private $title;

    /**
     * Get the unique user identity (id, username, email address or ...)
     */
    public function getIdentity(): string
    {
        // TODO: Implement getIdentity() method.
    }

    /**
     * Get all user roles
     *
     * @return Iterable
     */
    public function getRoles(): iterable
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * Get a detail $name if present, $default otherwise
     */
    public function getDetail(string $name, $default = null)
    {
        // TODO: Implement getDetail() method.
    }

    /**
     * Get all the details, if any
     */
    public function getDetails(): array
    {
        // TODO: Implement getDetails() method.
    }
}