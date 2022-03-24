<?php
use \RedBeanPHP\R as R;
$config =  [
    'driver' => 'mysql',
    'connection' => 'srv-pleskdb20.ps.kz:3306',
    'database' => 'commissi_bot',
    'username' => 'commissi_bot',
    'password' =>  'O7yd!41q'
];
R::setup("mysql:host={$config['connection']};dbname={$config['database']}", $config['username'], $config['password']);