<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');   
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    
    // Blog post
    $app->get('/post', Post\Handler\PostListHandler::class, 'post.list');
    $app->get('/post/detail', Post\Handler\PostDetailHandler::class, 'post.detail');
    $app->route('/post/create', [
        Zend\Expressive\Authentication\AuthenticationMiddleware::class,
        Post\Handler\PostCreateHandler::class,
    ], ['GET', 'POST'], 'post.create');
    $app->route('/post/update', [
        Zend\Expressive\Authentication\AuthenticationMiddleware::class,
        Post\Handler\PostUpdateHandler::class
    ], ['GET', 'POST'], 'post.update');
    $app->route('/post/delete', [
        Zend\Expressive\Authentication\AuthenticationMiddleware::class,
        Post\Handler\PostDeleteHandler::class,
    ], ['GET', 'POST'], 'post.delete');
    $app->route('/login', User\Handler\LoginHandler::class, ['GET', 'POST'], 'login');
    $app->route('/logout', User\Handler\LogoutHandler::class, ['GET', 'POST'], 'logout');
};
