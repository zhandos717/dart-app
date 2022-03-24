<?php
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use DevCoder\DotEnv;

require __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__.'/../config/container.php');
$container = $builder->build();

(new DotEnv(__DIR__ . '/../.env'))->load();
AppFactory::setContainer($container);
$app = AppFactory::create();
(require __DIR__ . '/../config/middleware.php')($app);
(require __DIR__ . '/../config/db.php')($app);
