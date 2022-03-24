<?php
include '../functions/SxGeo.php';
// Пример работы с классом SxGeo v2.2
header('Content-type: text/plain; charset=utf8');



function getIp()
{
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}

$SxGeo = new SxGeo('../libs/SxGeoCity.dat');

$ip = getIp();
var_export($SxGeo->getCityFull($ip)); // Вся информация о городе
//var_export($SxGeo->get($ip));         // Краткая информация о городе или код страны (если используется база SxGeo Country)
//var_export($SxGeo->about());          // Информация о базе данных
