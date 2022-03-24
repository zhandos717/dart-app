<?php
 // MainController
return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'home' => [
        'controller' => 'main',
        'action' => 'home',
    ],
    'delete' => [
        'controller' => 'main',
        'action' => 'delete',
    ],
    'participants' => [
        'controller' => 'main',
        'action' => 'participants',
    ],
    'logout' => [
        'controller' => 'main',
        'action' => 'logout',
    ],
    // BotController
    'bot'=>[
        'controller' => 'bot',
        'action' => 'bot',
    ],
    'dia/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'dia',
    ],
];
