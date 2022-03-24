<?php
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RedBeanPHP\R;
use Slim\Views\Twig;
use App\Core\Controller;

class MainController extends Controller
{
    private $view;
    private $r;
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        \var_dump(R::testConnection());

        exit;
        return $this->view->render($response, 'main\index.html', [ 
            
        ]);
    }
}
?>