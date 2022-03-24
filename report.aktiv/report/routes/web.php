<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Tuupola\Middleware\HttpBasicAuthentication;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\AuthorizationController;
use App\Http\Controllers\ReportController;


return function (App $app) {

    $app->get('/report/login', AuthorizationController::class . ':login')->setName('auth.login');
    $app->post('/report/login-post', AuthorizationController::class . ':loginPost')->setName('auth.signup');

    $app->group('/report', function (RouteCollectorProxy $app) {
        $app->get('/', MainController::class . ':index')->setName('home');;
        $app->get('/total_report', ReportController::class . ':totalReport')->setName('total.report');;
    })->add(HttpBasicAuthentication::class);;
};