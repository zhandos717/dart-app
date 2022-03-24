<?php
namespace App\Core;

use \Tamtamchik\SimpleFlash\Flash;
use \RedBeanPHP\R as R;
use App\Core\Router;

abstract class Controller {

    public $route;
    public $view;
    public array $acl = array();
    public $flash;

    public function __construct($route)
    {
        $this->flash = new Flash();
        $this->route = $route;

        $config =  include __DIR__ . '/../Config/Db.php';
        $this->rb = R::setup("mysql:host={$config['connection']};dbname={$config['database']}", $config['username'], $config['password']);

        // if(!R::testConnection())
        //     echo "Ошибка в соединеии с базой";

        // if (!$this->checkAcl()) {
        //     throw new Exception('Доступ запрешен Conttoller->' . $this->route['controller'] .'Роуты: '. $route['action'],403);
        // }

    
        $this->view = new View($route);
        //$this->model = $this->loadModel($route['controller']);
    }

    // public function loadModel($name)
    // {
    //     $path = '\App\Models\\' . ucfirst($name);
        
    //     if (class_exists($path)) {
    //         return new    $path;
    //     }else {
    //         new \App\Core\Model;
    //     }
    // }

    public function checkAcl():bool
    {
        // $acl = __DIR__ . '/../../App/Acl/' . $this->route['controller'] . '.php';
        // if(!file_exists($acl))
        //     throw new Exception('Файл доступов не найден Conttoller',403);
    
        // $this->acl = include __DIR__ . '/../../Acl/access.php';

        if ($this->isAcl('all')) {
            return \true;
        } else if (isset($_SESSION['user']) and  $this->isAcl('user')) {
            return \true;
        } else if (isset($_SESSION['admin']) and  $this->isAcl('admin')) {
            return \true;
        }
        return \false;
    }

    public function  isAcl($key): bool
    {
        return \in_array($this->route['action'], $this->acl[$key]);
    }
}