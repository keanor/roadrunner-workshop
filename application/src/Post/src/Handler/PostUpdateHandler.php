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
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\InputFilter\InputFilterInterface;

class PostUpdateHandler implements RequestHandlerInterface
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

    /**
     *
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     *
     * @var InputFilterInterface
     */
    private $inputFilter;

    public function __construct(PostRepositoryInterface $repository, PostCommandInterface $command, TemplateRendererInterface $renderer, UrlHelper $urlHelper, InputFilterInterface $inputFilter)
    {
        $this->repository = $repository;
        $this->command = $command;
        $this->renderer = $renderer;
        $this->urlHelper = $urlHelper;
        $this->inputFilter = $inputFilter;
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
            $data = $request->getParsedBody() ?: [];
            $post->exchangeArray($data);
            $this->inputFilter->setData($data);
            
            if ($this->inputFilter->isValid()) {
                try {
                    $post = $this->command->updatePost($post);
                    return new RedirectResponse($this->urlHelper->generate('post.detail', [], [
                        'id' => $post->getId()
                    ]));
                } catch (\Exception $ex) {
                    // An exception occurred; we may want to log this later and/or
                    // report it to the user. For now, we'll just re-throw.
                    throw $ex;
                }
            }
        }
        
        $data = [
            'post' => $post,
            'errors' => $this->inputFilter->getMessages()
        ];
        
        return new HtmlResponse($this->renderer->render('post::post-update', $data));
    }
}
