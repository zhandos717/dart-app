<?php
namespace App\Controllers;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RedBeanPHP\R;
use Slim\Views\Twig;

class MainController
{
    private Twig $view;
    public function __construct(Container $container)
    {
         $this->view = $container->get('view');
    }
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {   
        return $this->view->render($response, 'main\index.html', [
            'title'=>'Базовая страница'
        ]);
    }
}