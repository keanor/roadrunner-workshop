<?php
declare(strict_types = 1);
namespace Post\Factory;

use Post\Handler\PostUpdateHandler;
use Post\Model\PostCommandInterface;
use Post\Model\PostRepositoryInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\InputFilter\InputFilterInterface;

class PostUpdateHandlerFactory
{

    public function __invoke(ContainerInterface $container): PostUpdateHandler
    {
        return new PostUpdateHandler($container->get(PostRepositoryInterface::class), $container->get(PostCommandInterface::class), $container->get(TemplateRendererInterface::class), $container->get(UrlHelper::class), $container->get(InputFilterInterface::class));
    }
}
