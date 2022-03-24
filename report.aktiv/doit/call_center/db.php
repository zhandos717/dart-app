<?php
$driver = 'mysql';
$database_host = 'srv-pleskdb39.ps.kz:3306';
$database_user = 'aktiv_user';
$database_password = 'Mainmenu123';
$database_name = 'aktivmar_baza';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

//PDO

try{
    $pdo = new 
PDO("$driver:host=$database_host;dbname=$database_name;charset=$charset",$database_user,$database_password,$options);
}catch(PDOException $e){
    die("Не могу подключится к базе данных!");
}

session_start();

?>
