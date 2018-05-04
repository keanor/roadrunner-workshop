<?php
declare(strict_types = 1);
namespace Post\Factory;

use Post\Entity\Post;
use Post\Model\ZendDbSqlRepository;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class ZendDbSqlRepositoryFactory
{

    public function __invoke(ContainerInterface $container): ZendDbSqlRepository
    {
        return new ZendDbSqlRepository($container->get(AdapterInterface::class), new ReflectionHydrator(), new Post());
    }
}

