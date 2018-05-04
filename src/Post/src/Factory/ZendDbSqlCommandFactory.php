<?php
declare(strict_types = 1);
namespace Post\Factory;

use Post\Model\ZendDbSqlCommand;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

class ZendDbSqlCommandFactory
{

    public function __invoke(ContainerInterface $container): ZendDbSqlCommand
    {
        return new ZendDbSqlCommand($container->get(AdapterInterface::class));
    }
}

