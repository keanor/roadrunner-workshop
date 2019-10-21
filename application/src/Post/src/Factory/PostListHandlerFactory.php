<?php
declare(strict_types = 1);
namespace Post\Factory;

use Post\Handler\PostListHandler;
use Post\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostListHandlerFactory
{

    public function __invoke(ContainerInterface $container): PostListHandler
    {
        return new PostListHandler($container->get(PostRepositoryInterface::class), $container->get(TemplateRendererInterface::class));
    }
}
