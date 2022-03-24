<?php
namespace App\Core;

use \RedBeanPHP\R as R;

class Model{

    public $rb;

    public function __construct()
    {
        $config =  include __DIR__ . '/../Config/Db.php';
        $this->rb = R::setup("mysql:host={$config['connection']};dbname={$config['database']}", $config['username'], $config['password']);
    }

}