<?php

use DI\Container;

return function(Container $container){
    $container->set('settings', function (\Psr\Container\ContainerInterface $container) {
        return [
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'driver' => 'mysql',
            'connection' => 'srv-pleskdb39.ps.kz:3306',
            'database' => 'aktivmar_baza',
            'username' => 'aktiv_user',
            'password' =>  'Mainmenu123'
        ];
    });
};

