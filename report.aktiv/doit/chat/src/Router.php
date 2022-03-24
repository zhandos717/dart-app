<?php 


class Router{
    static $routes = [];
    public static function Add($request_method, $route,$move)
    {
        if($_SERVER['REQUEST_METHOD'] == $request_method && $route == $_REQUEST['routes'] ){
            list($controller,$method) = explode('@',$move);
            
            $controller =  ucfirst($controller)  . 'Controller';
            $controller_patch = __DIR__.'/'. $controller.'.php';
            
            if(!file_exists($controller_patch))
                throw new Exception('Контроллер не найден!');
                
            require_once $controller_patch;
            $objectContoller = new $controller;

            if(!method_exists($objectContoller,$method))
                throw new Exception('Метод не найден!');

            $objectContoller->$method();
        }
        self::$routes[] = $route;
    }
}