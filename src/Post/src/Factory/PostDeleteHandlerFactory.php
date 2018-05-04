<?php
declare(strict_types = 1);
namespace Post\Factory;

use Post\Handler\PostDeleteHandler;
use Post\Model\PostCommandInterface;
use Post\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostDeleteHandlerFactory
{

    public function __invoke(ContainerInterface $container): PostDeleteHandler
    {
        return new PostDeleteHandler($container->get(PostRepositoryInterface::class), $container->get(PostCommandInterface::class), $container->get(TemplateRendererInterface::class));
    }
}
