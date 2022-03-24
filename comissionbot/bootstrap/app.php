<?php

use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use DI\Container;
use Slim\Views\Twig;

$container = new Container();

$settings = require __DIR__ . '/../app/Config/settings.php';
$settings($container);

$container->set('view', function (\Psr\Container\ContainerInterface $container) {
    return Twig::create(__DIR__ . '/../resources/views/', ['cache' => false]);
});

$container->set('MainController', function (\Psr\Container\ContainerInterface $container) {
    return new App\Controllers\MainController($container->get('view'));
});
$container->set('BotTgController', function (\Psr\Container\ContainerInterface $container) {
    return new App\Controllers\BotTgController($container->get('Bot'));
});
$container->set('ReportBotTgController', function (\Psr\Container\ContainerInterface $container) {
    return new App\Controllers\ReportBotTgController($container->get('ReportBot'));
});

$container->set('MailBotTgController', function (\Psr\Container\ContainerInterface $container) {
    return new App\Controllers\MailBotController($container);
});

$container->set('AuthorizationController', function (\Psr\Container\ContainerInterface $container) {
    return new App\Controllers\AuthorizationController($container->get('view'));
});

AppFactory::setContainer($container);

$app = AppFactory::create();
$app->add(TwigMiddleware::createFromContainer($app));
$app->addRoutingMiddleware();

$middleware = require __DIR__ . '/../app/Config/middleware.php';
$middleware($app);

$RedBean = require __DIR__ . '/../app/Config/db.php';
$RedBean($app);

$BotTelegram = require __DIR__ . '/../app/Config/bot.php';
$BotTelegram($app,$container);

// $ReportBot = require __DIR__ . '/../app/Config/reportBot.php';
// $BotTelegram($app, $container);


$container = $app->getContainer();

