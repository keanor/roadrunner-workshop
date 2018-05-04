<?php
declare(strict_types = 1);
namespace Post\Handler;

use Post\Model\PostRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostListHandler implements RequestHandlerInterface
{

    /**
     *
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     *
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(PostRepositoryInterface $postRepository, TemplateRendererInterface $renderer)
    {
        $this->postRepository = $postRepository;
        $this->renderer = $renderer;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'posts' => $this->postRepository->findAllPosts()
        ];
        return new HtmlResponse($this->renderer->render('post::post-list', $data));
    }
}
