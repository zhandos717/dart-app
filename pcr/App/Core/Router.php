<?php
namespace App\Core;
use Exception;

class Router{
    static array $routes = [];
    static array $access = [];

    public static function Add(string $request_method, string $route, string $move, string $access = 'all')
    {   
        if($_SERVER['REQUEST_METHOD'] != $request_method)
            return false;
        if (isset($_REQUEST['route']) && ($_REQUEST['route'] != $route))
            return false;

        list($controller, $action) = explode('@', $move);
        $Controller = 'App\Controllers\\' . ucfirst($controller) . 'Controller';
        $method = $action . 'Action';
        
        if (!class_exists($Controller))
            throw new Exception('Контроллер не найден!  - ' . $Controller, 403);

        if (!method_exists($Controller, $method))
            throw new Exception('Метод не найден! 1_'. $method , 403);

        $controller = new $Controller(['controller' => $controller, 'action' => $action]);
        $controller->$method();

        self::$access[$access] = $route;
        
        self::$routes[] = $route;
        }
}