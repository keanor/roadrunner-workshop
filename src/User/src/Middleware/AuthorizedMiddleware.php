<?php


namespace User\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Authentication\Session\PhpSession;
use Zend\Expressive\Template\TemplateRendererInterface;

class AuthorizedMiddleware implements MiddlewareInterface
{
    private $renderer;
    private $adapter;

    /**
     * AuthorizedMiddleware constructor.
     * @param $renderer
     * @param $adapter
     */
    public function __construct(TemplateRendererInterface $renderer, PhpSession $adapter)
    {
        $this->renderer = $renderer;
        $this->adapter = $adapter;
    }


    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $authorized = $this->adapter->authenticate($request) !== null;
        $this->renderer->addDefaultParam(TemplateRendererInterface::TEMPLATE_ALL, 'authorized', $authorized);

        return $handler->handle($request);
    }
}
