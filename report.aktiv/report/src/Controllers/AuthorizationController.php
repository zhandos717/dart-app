<?php
namespace App\Controllers;
use App\Exceptions\AuthorizationExceprion;
use App\Support\Authorization;
use DI\Container;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;



class AuthorizationController
{
    private Twig $view;
    private Authorization $authorization;

    /**
     * @param Container $container
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
        $this->authorization = new Authorization();
    }

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
