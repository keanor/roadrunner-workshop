<?php

declare(strict_types=1);

namespace User;

use User\Handler\LogoutHandler;
use User\Middleware\AuthorizedMiddleware;
use User\Middleware\AuthorizedMiddlewareFactory;
use Zend\Expressive\Authentication\AuthenticationInterface;
use Zend\Expressive\Authentication\Session\PhpSession;
use Zend\Expressive\Authentication\UserRepository\PdoDatabase;
use Zend\Expressive\Authentication\UserRepositoryInterface;

/**
 * The configuration provider for the User module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'authentication' => $this->getAuthentication(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'aliases' => [
                AuthenticationInterface::class => PhpSession::class,
                UserRepositoryInterface::class => PdoDatabase::class
            ],
            'invokables' => [
                LogoutHandler::class => LogoutHandler::class,
            ],
            'factories'  => [
                AuthorizedMiddleware::class => AuthorizedMiddlewareFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'user'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    /**
     * Returns the authentication configuration
     */
    public function getAuthentication() {
        return [
            'redirect' => '/login',
            'pdo' => [
                'table' => 'users',
                'field' => [
                    'identity' => 'username',
                    'password' => 'password',
                ],
            ],
        ];
    }
}
