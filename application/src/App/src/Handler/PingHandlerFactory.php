<?php
namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Spiral\Goridge\RPC;

class PingHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new PingHandler($container->get(RPC::class));
    }
}