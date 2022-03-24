<?php

namespace App\Controllers;

use DI\Container;
use App\Helpers\ReportBot\BotNotifications;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Core\Controller;

class MailBotController extends Controller
{   
    private  $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function mail(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();

        

        \print_r($data);
        
        $notification = new BotNotifications($this->container);

        $notification->main($data);


        return $response;
    }
}
