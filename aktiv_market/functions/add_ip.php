<?php 
    include_once '../libs/bd.php';
// Подключаем SxGeo.php класс
include("SxGeo.php");
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
$ip = getIp();

$SxGeo = new SxGeo('../libs/SxGeoCity.dat');

$city = $SxGeo->getCityFull($ip);


    if (!empty($_POST['region']) && !empty($_POST['adress']) && !empty($_POST['kassa'])) {

        $find = R::findOne('ipbranches', 'ip=? LIMIT 1',[$ip]);

        if(empty($find->ip)){
            $ipbranches = R::dispense('ipbranches');
            $ipbranches->ip= $ip;

            $ipbranches->country        = $city['country']['name_ru'];
            $ipbranches->country_en     = $city['country']['name_en'];
            $ipbranches->iso            = $city['country']['iso'];

            $ipbranches->region         = $_POST['region'];
            $ipbranches->city           = $city['city']['name_ru'];
            $ipbranches->city_en        = $city['city']['name_en'];
            $ipbranches->adress         = $_POST['adress'];
            $ipbranches->kassa          = $_POST['kassa'];
            $ipbranches->time_add =      date('Y-m-d H:i:s');
            $ipbranches->date_add =      date('Y-m-d');
            $ipbranches->company_id = $_POST['company'];
            R::store($ipbranches);
            $out = ['success' => 'Данные записались'];

        }else{
        $out = ['error' => 'Этот IP уже есть! Город:' . $find->region.' Филиал: '. $find['adress']];
        }

    }else{
        $out = ['error' => 'Данные пустые, выберите регион, филиал, кассу!'];
    }
exit(json_encode($out));