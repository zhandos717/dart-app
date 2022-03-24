<? require 'rb.php';                                        # Библеотека ReadBean PHP
#############################################################
$db_host = 'srv-pleskdb39.ps.kz:3306';                      # ХОСТ
$db_user = 'aktiv_user';                                    # Логин БД
$db_password = 'Mainmenu123';                               # Пароль БД
$db_base = 'aktivmar_baza';                                 # Имя БД
$driver = 'mysql';                                          # Драйвер 
$charset = 'utf8';                                          # Кодировка
R::setup("$driver:host=$db_host;dbname=$db_base",$db_user, $db_password );
    if ( !R::testConnection() ){
    exit('Проверьте подключение к сети. При загрузке произошла ошибка. Повторите попытку.');
}
function percent_comiss($number){
    $percent = '3';
    $number_percent = $number / 100 * $percent;
    return $number - $number_percent;
}

function post($param){
    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'https://report.commission2.kz/doit/api/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($param)
    ));
    $response = json_decode(curl_exec($myCurl), true);
    // $response = curl_exec($myCurl);
    curl_close($myCurl);
    return $response;
};

$data_begin = date('Y-m-01');
$data_end = date('Y-m-d');


$result = R::getAll("SELECT COUNT(*) as count , SUM(p1), region , adressfil  
FROM tickets 
WHERE NOT status = 11 
AND NOT status = 1   
AND  dataseg BETWEEN '$data_begin' 
AND '$data_end'  GROUP BY adressfil ");

// ob_start();
// var_dump($result);
// $test = ob_get_clean();
// file_put_contents('log.txt', $test, FILE_APPEND);


// $res = R::findAll('tickets','LIMIT 2');



foreach ($result as $data1) {
    ##################### Регион 
    $adress = $data1['adressfil'];
    $region = $data1['region'];
    #####################
    $data19 = R::getRow("SELECT SUM(proc) FROM tickets WHERE adressfil = '$adress' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
    ##################### Сумма процентов выкупленных товаров
    $result8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit),COUNT(*) FROM tickets  WHERE adressfil = '$adress' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
    $data8 = $result8[0];
    ##################### Сумма выдачи, сумма продажи и количество проданных товаров
    $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE adress ='$adress' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
    $acc = $accsess[0];
    ##################### Сумма прихода и продажи товаров товаров
    // $sales = R::getAll("SELECT SUM(pribl),COUNT(*),SUM(summaprihod) FROM sales WHERE adresslombard = '$adress'  AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'   AND statustovar IS NULL ");
    // $sale = $sales[0];
    ##################### Сумму и количество проданных товаров в магазине
    //Аукционист шуб
    $auctioneer_fur = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress'  AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND  type = 'Шубы'  ");
    //Аукционист техники
    $auctioneer_teh = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы'  ");
    //Нал в залоге
    $cash_in_pledge_end = R::getRow("SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress' AND status = '2' ");
    ############################## Аукционист шуб // Аукционист техники
    $rashod = R::getRow("SELECT SUM(summa_vydachy) FROM comisstest  WHERE adress = '$adress' AND data BETWEEN '$data_begin' AND '$data_end' ");
    $chistaya = $data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'] - $data451['SUM(summa)'] + ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);
    $reportstotal                      = R::dispense('reportstotal');
    $reportstotal->date_report         = $data_end; // Дата отчета
    $reportstotal->time_report         = date('H:i:s'); // время отчета
    $reportstotal->region              = $region; // Регион 
    $reportstotal->adress              = $adress; // адресс 
    $reportstotal->income              = $data1['SUM(p1)'] + $data19['SUM(proc)']; // Доход комиссионки
    $reportstotal->number_of_sales     = $data8['COUNT(*)']; // Количество продаж
    $reportstotal->store_income        = ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy']) + $data8['SUM(profit)']; // доход магазина
    $reportstotal->accses_obs          = $acc['SUM(price)'] - $acc['SUM(purchaseamount)']; // Доход аксессов
    $reportstotal->profit              = $chistaya; //  прибыль
    $reportstotal->consumption         = $rashod[0]; // Расход 
    $reportstotal->net_profit          = percent_comiss($chistaya); //  Чистая прибыль
    $reportstotal->number_of_clients   = $data1['count']; // Количесво клиентов
    $reportstotal->auctioneer_teh      = $auctioneer_teh['SUM(summa_vydachy)']; // Аукционист техники
    $reportstotal->auctioneer_fur      = $auctioneer_fur['SUM(summa_vydachy)'];  // Аукционист шуб
    $reportstotal->cash_in_pledge_end  = $cash_in_pledge_end['SUM(summa_vydachy)']; // Нал в залоге
    $reportstotal->too                 = 'OBS';
    R::store($reportstotal);
};
//*/


$filOne = R::findAll('kassa', 'GROUP BY filial');
foreach ($filOne as $find) {
    $array = [
        'token' => 'qfq5441fa65f4654w',
        'filial' => $find['filial'],
        'start' => $data_begin,
        'end' => $data_end,
    ];

    $arr = post($array);
    if (!empty($arr['summa_vydachy'])) {
        $ras = R::getCol("SELECT SUM(tekrashod) FROM comisstest WHERE adress=? AND data BETWEEN '$data_begin' AND '$data_end' ", [$filOne['adress']]);
        $ras = $ras[0];

        $chistaya = $arr['comis'] + $arr['proc'] + ($arr['cena_pr'] - $arr['sale']) + $arr['profit'] - $ras;
        $reportstotal                      = R::dispense('reportstotal');
        $reportstotal->date_report         = $data_end; // Дата отчета
        $reportstotal->time_report         = date('H:i:s'); // время отчета
        $reportstotal->region              = $find['region']; // Регион 
        $reportstotal->adress              = $find['filial']; // адресс 
        $reportstotal->income              = $arr['comis'] + $arr['proc']; // Доход комиссионки
        $reportstotal->number_of_sales     = $arr['sales']; // Количество продаж
        $reportstotal->store_income        = ($arr['cena_pr'] - $arr['sale']) + $arr['profit']; // доход магазина
        
        $reportstotal->accses_obs          = $arr['accses_obs']; // Доход аксессов

        $reportstotal->profit              = $chistaya; //  прибыль
        $reportstotal->consumption         = $ras; // Расход 
        $reportstotal->net_profit          = percent_comiss($chistaya); //  Чистая прибыль

        $reportstotal->number_of_clients   = $arr['count']; // Количесво клиентов
        $reportstotal->auctioneer_teh      = $arr['tehnica']; // Аукционист техники
        $reportstotal->auctioneer_fur      = $arr['shuby'];  // Аукционист шуб
        $reportstotal->cash_in_pledge_end  = $arr['nal']; // Нал в залоге
        $reportstotal->too                 = 'TBS';
        R::store($reportstotal);


    }
    
};