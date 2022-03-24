<?php

namespace application\lib;
use R;
use PDOException;
use PDO;
class Rb
{
    function __construct()
    {
        $config = include 'application/config/db.php';
        include_once 'application/third_party/RedBeanPHP.php';
        R::setup('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . '', $config['user'], $config['password']);
        if (!R::testconnection()) {
            exit('Нет соединения с базой данных!');
        }
    }
}
?>