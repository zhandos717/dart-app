<?php

use App\Support\Authenticator;
use App\Support\Session;
use Psr\Http\Message\ServerRequestInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Request;
use Slim\App;
use Slim\Views\TwigMiddleware;
use Tuupola\Middleware\HttpBasicAuthentication;


return function (App $app)
{
    $setting = $app->getContainer()->get('settings');

    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();

    $session = new Session();

    $sessionMiddleware = function (Response $request, Request $handler) use ($session) {
        $session->start();
        $response = $handler->handle($request);
        $session->save();
        return $response;
    };

    $app->add($sessionMiddleware);

    $loggerFactory = $app->getContainer()->get(\App\Http\Factory\LoggerFactory::class);
    $logger = $loggerFactory->addFileHandler('error.log')->createLogger();

    $ErrorMiddlewareSetting =   $setting['ErrorMiddleware'];
    $app->addErrorMiddleware(
        $ErrorMiddlewareSetting['displayErrorDetails'],
        $ErrorMiddlewareSetting['logErrorDetails'],
        $ErrorMiddlewareSetting['logErrors'],
        $logger
    );

    $app->add(TwigMiddleware::createFromContainer($app));

    $app->add(new HttpBasicAuthentication([
        "path" => "/report",
        // "realm" => "Protected",
        "ignore" => ['/report/login', '/report/login-post'],
        "authenticator" => new Authenticator([
            "table" => "diruser",
            "user" => "login",
            "hash" => "password"]),

        "error" => function (Psr\Http\Message\ResponseInterface $response, array $arguments) {
            return $response->withAddedHeader('Location', '/report/login')
            ->withoutHeader("WWW-Authenticate");
        }
    ]));
};