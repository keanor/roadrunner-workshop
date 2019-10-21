<?php
namespace User\Middleware;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Authentication\Session\PhpSession;
use Zend\Expressive\Template\TemplateRendererInterface;

class AuthorizedMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : AuthorizedMiddleware
    {
        return new AuthorizedMiddleware(
            $container->get(TemplateRendererInterface::class),
            $container->get(PhpSession::class)
        );
    }
}
