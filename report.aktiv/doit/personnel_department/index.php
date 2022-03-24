<?php

include ("../../bd.php");
  try {
    if (!$_SESSION['logged_user']->status == 16)
      throw new Exception('Запрещенный маршрут');

    $route = trim($_REQUEST['route']?? 'front_user');

    if (substr($route,'-1') == '/') $route.= 'front_user';

    if (!preg_match('~^[-a-z0-9/_]+$~i', $route)) 
    throw new Exception('Запрещенный маршрут');

    $filePath = dirname(__FILE__).'/pages/'.$route.'.php';

    if (!file_exists($filePath))
    throw new Exception('Маршрут не найден ');

      include $filePath;

  }catch (Throwable $ex) {
      header('Location: /');
  }
