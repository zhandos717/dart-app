<?php

namespace App\Http\Controllers\Auth;

use App\Core\Controller;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ReportController extends Controller
{
    public function totalReport(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        echo 'Привет';
        return $response;
    }
}
