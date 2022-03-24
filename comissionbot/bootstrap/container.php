<?php
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

$container = new Container();

AppFactory::setContainer($container);

$container->set('view', function (\Psr\Container\ContainerInterface $container) {
    return Twig::create(__DIR__ . '/../app/views/', ['cache' => false]);
});

$container->set('Bot', function (\Psr\Container\ContainerInterface $container) {
    return new skrtdev\NovaGram\Bot('5114325471:AAEMIQCJhBs8pbJkKqYG3-xOppD4ihEqd30', [
        "json_payload" => true,
        "debug" => 480568670,
        "parse_mode" => "Markdown",
        "exceptions" => false
    ]);
});

$container->set('ReportBot', function (\Psr\Container\ContainerInterface $container) {
    return new skrtdev\NovaGram\Bot('5194972852:AAHSy0jYvZwGEpfE51w4RJPEej1UEaBMXtw', [
        "json_payload" => true,
        "debug" => 480568670,
        "parse_mode" => "Markdown",
        "exceptions" => false
    ]);
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

$container->set('AuthorizationController', function (\Psr\Container\ContainerInterface $container) {
    return new App\Controllers\AuthorizationController($container->get('view'));
});


