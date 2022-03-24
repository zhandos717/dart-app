<?php
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use App\Core\Controller;

class AuthorizationController extends Controller
{
    private $view;
    private $r;
    
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }


    public function login(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {   
        return $this->view->render($response, 'authorization\login.html', [  ]);
    }

}
