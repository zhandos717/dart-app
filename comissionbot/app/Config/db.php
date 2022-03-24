<?php
use \RedBeanPHP\R as R;
use Slim\App;


return function(App $app) {

    $setting = $app->getContainer()->get('settings');

    R::setup("mysql:host={$setting['connection']};dbname={$setting['database']}", $setting['username'], $setting['password']);
};
