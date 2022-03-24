<?php
namespace App\Http\Controllers;

use App\Core\Controller;
use App\Exceptions\AuthorizationExceprion;
use App\Support\Authorization;
use DI\Container;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;



class AuthorizationController extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        
        return $this->view->render($response, 'authorization\login.html', [
            'title' => 'Базовая страница'
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function loginPost(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $params = (array) $request->getParsedBody();
            $this->authorization->login($params);
        }catch (AuthorizationExceprion $exceprion){
            
            // flash()->error($exceprion->getMessage());

            // return $this->view->render($response, 'authorization\login.html', [
            //     'title' => 'Базовая страница'
            // ]);

            // return $response->withAddedHeader('Location', '/report/login')->withStatus(302);
        }
            return $response->withAddedHeader('Location', 'report/')->withStatus(302);
    }
}
