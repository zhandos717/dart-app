<?php
use DI\Container;
use skrtdev\NovaGram\Bot;
use Slim\App;

return function (App $app, Container $container) {

    $setting = $app->getContainer()->get('settings');
    $container->set('Bot', function (\Psr\Container\ContainerInterface $container) use ($setting) {
        return new Bot($setting['botToken'], [
            "json_payload" => true,
            "debug" => 480568670,
            "parse_mode" => "Markdown",
            "exceptions" => false
        ]);
    });

    $container->set('ReportBot', function (\Psr\Container\ContainerInterface $container) use ($setting) {
        return new Bot($setting['ReportBotToken'], [
            "json_payload" => true,
            "debug" => 480568670,
            "parse_mode" => "Markdown",
            "disable_ip_check" => true,
            "exceptions" => true,
        ]);
    });
    
};



