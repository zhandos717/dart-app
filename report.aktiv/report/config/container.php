<?php 
declare(strict_types=1);

use App\Http\Factory\LoggerFactory;
use App\Twig\AppExtension;
use Psr\Container\ContainerInterface;
use Slim\Csrf\Guard;
use Slim\Views\Twig;

return [
    'settings' => function () {
        return [
            'ErrorMiddleware'=>[
                'displayErrorDetails' => true,
                'logErrorDetails' => true,
                'logErrors' => true,
            ],
            'dataBase' => [
                'connection' => getenv('DATABASE_HOST'),
                'database' => getenv('DATABASE_NAME'),
                'username' => getenv('DATABASE_USERNAME'),
                'password' =>  getenv('DATABASE_PASSWORD'),
            ],
            'logger'=> [
                'name' => 'app',
                'path' => __DIR__ . '/../logs',
                'filename' => 'app.log',
                'level' => \Monolog\Logger::DEBUG,
                'file_permission' => 0775,
            ],
        ];
    },
    csrf::class => function (\App\Http\Factory\ResponseFactory $responseFactory) {
        return new Guard($responseFactory);
    },

    csrf::class => function () {
        return new App\Validation\Validator;
    },

    LoggerFactory::class => function (ContainerInterface $container) {
    return new LoggerFactory($container->get('settings')['logger']);
    },
    view::class=> function(ContainerInterface $container){
        $view = Twig::create(__DIR__.'/../resources/views/', [
            'cache' => false
        ]);

        $view->addExtension(new AppExtension);
        

        return $view;
    },
];

