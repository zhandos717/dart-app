<?php

namespace App\Controllers;

use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ReportController
{
    public function totalReport(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        echo 'Привет';
        return $response;
    }
}
