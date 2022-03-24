<?
##########################################################################
    require 'rb.php'; // Подключем библеотеку READBEAN PHP
    R::setup( 'mysql:host=srv-pleskdb39.ps.kz:3306;dbname=aktivmar_baza',
        'aktiv_user', 'Mainmenu123' );
    if ( !R::testConnection() )
    {
    exit('Нет соединения с базой данных');
    }
###########################################################################
session_start();     //Старт сессии

?>