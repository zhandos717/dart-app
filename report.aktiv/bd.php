<?php
require __DIR__. '/assets/libs/libs.php';
# Библеотека ReadBean PHP
#############################################################
$db_host = 'srv-pleskdb39.ps.kz:3306';                      # ХОСТ
$db_user = 'aktiv_user';                                    # Логин БД
$db_password = 'Mainmenu123';                               # Пароль БД
$db_base = 'aktivmar_baza';                                 # Имя БД
$driver = 'mysql';                                          # Драйвер 
$charset = 'utf8';                                          # Кодировка

$connect = mysqli_connect($db_host, $db_user, $db_password, $db_base);
    mysqli_query($connect, "SET NAMES $charset");
    $mysqli = new mysqli($db_host,$db_user,$db_password,$db_base);

R::setup("$driver:host=$db_host;dbname=$db_base",$db_user, $db_password );
    if ( !R::testConnection() )
    exit('<meta http-equiv="refresh" content="30"> Проверьте подключение к сети. При загрузке произошла ошибка. Повторите попытку.');

if (!session_id()) session_start();

$region = $_SESSION['logged_user']->region;
$status  = $_SESSION['logged_user']->status;
$adress  = $_SESSION['logged_user']->adress;
$root    = $_SESSION['logged_user']->root;
$fio     = $_SESSION['logged_user']->fio;
$login   =  $_SESSION['logged_user']->login;

include __DIR__ . '/doit/function/send_tg.php'
?>
