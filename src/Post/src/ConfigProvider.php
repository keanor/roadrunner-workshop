<?php
declare(strict_types = 1);
namespace Post;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\InputFilter\InputFilterInterface;

/**
 * The configuration provider for the Post module
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
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'aliases' => [
                // Model\PostRepositoryInterface::class => Model\PostRepository::class,
                // Model\PostCommandInterface::class => Model\PostCommand::class,
                Model\PostRepositoryInterface::class => Model\ZendDbSqlRepository::class,
                Model\PostCommandInterface::class => Model\ZendDbSqlCommand::class,
                InputFilterInterface::class => Filter\PostInputFilter::class
            ],
            'invokables' => [],
            'factories' => [
                Model\PostRepository::class => InvokableFactory::class,
                Model\PostCommand::class => InvokableFactory::class,
                Model\ZendDbSqlRepository::class => Factory\ZendDbSqlRepositoryFactory::class,
                Model\ZendDbSqlCommand::class => Factory\ZendDbSqlCommandFactory::class,
                Filter\PostInputFilter::class => InvokableFactory::class
            ]
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'post' => [
                    __DIR__ . '/../templates/'
                ]
            ]
        ];
    }
}
