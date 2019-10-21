<?php
declare(strict_types = 1);
namespace Post\Handler;

use Post\Model\PostCommandInterface;
use Post\Model\PostRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostDeleteHandler implements RequestHandlerInterface
{

    /**
     *
     * @var PostRepositoryInterface
     */
    private $repository;

    /**
     *
     * @var PostCommandInterface
     */
    private $command;

    /**
     *
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(PostRepositoryInterface $repository, PostCommandInterface $command, TemplateRendererInterface $renderer)
    {
        $this->repository = $repository;
        $this->command = $command;
        $this->renderer = $renderer;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getQueryParams()['id'] ?? false;
        if (! $id) {
            return new RedirectResponse('/post');
        }
        try {
            $post = $this->repository->findPost($id);
        } catch (\InvalidArgumentException $ex) {
            return new RedirectResponse('/post');
        }
        
        if ($request->getMethod() == 'POST') {
            
            if ($id != $request->getParsedBody()['id'] || 'Delete' !== $request->getParsedBody()['confirm']) {
                return new RedirectResponse('/post');
            } else {
                $post = $this->command->deletePost($post);
                return new RedirectResponse('/post');
            }
        }
        
        $data = [
            'post' => $post
        ];
        return new HtmlResponse($this->renderer->render('post::post-delete', $data));
    }
}
