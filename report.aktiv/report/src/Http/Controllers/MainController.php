<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RedBeanPHP\R;
use Slim\Views\Twig;

class MainController extends Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {   
        return $this->view->render($response, 'main\index.html', [
            'title'=>'Базовая страница'
        ]);
    }
}