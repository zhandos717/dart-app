<?php

use DI\Container;

return function(Container $container){
    $container->set('settings', function (\Psr\Container\ContainerInterface $container) {
        return [
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'ReportBotToken' => '5194972852:AAHSy0jYvZwGEpfE51w4RJPEej1UEaBMXtw',
            'botToken'=> '5114325471:AAEMIQCJhBs8pbJkKqYG3-xOppD4ihEqd30',
            'driver' => 'mysql',
            'connection' => 'srv-pleskdb20.ps.kz:3306',
            'database' => 'commissi_bot',
            'username' => 'commissi_bot',
            'password' =>  'O7yd!41q'
        ];
    });
};
