<?php
declare(strict_types = 1);
namespace Post\Handler;

use Post\Entity\Post;
use Post\Model\PostCommandInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\InputFilter\InputFilterInterface;

class PostCreateHandler implements RequestHandlerInterface
{

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

    public function __construct(PostCommandInterface $command, TemplateRendererInterface $renderer, UrlHelper $urlHelper, InputFilterInterface $inputFilter)
    {
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
        $post = new Post();
        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody() ?: [];
            $post->exchangeArray($data);
            $this->inputFilter->setData($data);
            if ($this->inputFilter->isValid()) {
                try {
                    $post = $this->command->insertPost($post);
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
        
        return new HtmlResponse($this->renderer->render('post::post-create', $data));
    }
}
