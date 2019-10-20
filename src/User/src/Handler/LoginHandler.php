<?php

declare(strict_types=1);

namespace User\Handler;

use Fig\Http\Message\RequestMethodInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Authentication\Session\PhpSession;
use Zend\Expressive\Authentication\UserInterface;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginHandler implements RequestHandlerInterface
{
    private const REDIRECT_ATTRIBUTE = 'authentication:redirect';

    /**
     * @var PhpSession
     */
    private $adapter;

    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * LoginHandler constructor.
     * @param TemplateRendererInterface $renderer
     * @param PhpSession $adapter
     */
    public function __construct(TemplateRendererInterface $renderer, PhpSession $adapter)
    {
        $this->renderer = $renderer;
        $this->adapter = $adapter;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $session = $request->getAttribute('session');
        $redirect = $this->getRedirect($request, $session);

        // Обрабатываем попытку авторизации
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            return $this->handleLoginAttempt($request, $session, $redirect);
        }

        // Отображаем форму авторизации
        $session->set(self::REDIRECT_ATTRIBUTE, $redirect);

        return new HtmlResponse($this->renderer->render(
            'user::login',
            []
        ));
    }

    private function getRedirect(ServerRequestInterface $request, SessionInterface $session) {
        $redirect = $session->get(self::REDIRECT_ATTRIBUTE);

        if (!$redirect) {
            $redirect = $request->getHeaderLine('Referer');
            if (in_array($redirect, ['', '/login'], true)) {
                $redirect == '/';
            }
        }

        return $redirect;
    }

    private function handleLoginAttempt(
        ServerRequestInterface $request,
        SessionInterface $session,
        string $redirect
    ) : ResponseInterface {
        $session->unset(UserInterface::class);

        // Успешная авторизация
        if ($this->adapter->authenticate($request)) {
            $session->unset(self::REDIRECT_ATTRIBUTE);
            return new RedirectResponse($redirect);
        }

        return new HtmlResponse($this->renderer->render(
            'user::login',
            [ 'error' => 'Ошибка авторизации, проверьте введенные данные' ]
        ));
    }
}
