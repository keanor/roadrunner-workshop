<?php
namespace App\Factory;

use Psr\Container\ContainerInterface;
use Spiral\Goridge\RPC;
use Spiral\Goridge\SocketRelay;

/**
 * Class RPCFactory
 * @package App\Factory
 */
class RPCFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['road-runner'];
        return new RPC(new SocketRelay($config['rpc']['host'], $config['rpc']['port']));
    }
}
