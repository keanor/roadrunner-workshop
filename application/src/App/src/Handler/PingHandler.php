<?php
declare(strict_types = 1);
namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Spiral\Goridge\RPC;
use Zend\Diactoros\Response\JsonResponse;

class PingHandler implements RequestHandlerInterface
{
    /**
     * @var RPC
     */
    private $rpcService;

    /**
     * PingHandler constructor.
     * @param RPC $rpcService
     */
    public function __construct(RPC $rpcService)
    {
        $this->rpcService = $rpcService;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            'ack' => time(),
            'attribute' => $request->getAttribute('RRMiddleware', 'unknown'),
            'rpc_response' => $this->rpcService->call('hellorpc.Hello', ''),
        ]);
    }
}
