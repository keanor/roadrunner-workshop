<?php
declare(strict_types = 1);
namespace Post\Handler;

use Post\Model\PostRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostDetailHandler implements RequestHandlerInterface
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
        $id = $request->getQueryParams()['id'] ?? null;
        
        try {
            $post = $this->postRepository->findPost($id);
        } catch (\InvalidArgumentException $ex) {
            return new RedirectResponse('/post');
        }
        
        $data = [
            'post' => $post
        ];
        return new HtmlResponse($this->renderer->render('post::post-detail', $data));
    }
}
