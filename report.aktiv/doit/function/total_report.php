<?php 

include __DIR__ . '/../../bd.php';

if ($status != 3 or $root != 3) header('Location: ../../index.php');

$lombard = R::getRow('SELECT SUM(auktech) as auktech ,SUM(aukshubs) as aukshubs ,SUM(nalvzaloge) as nalvzaloge, region FROM reports 
        WHERE  data = (SELECT MAX(data) FROM reports)  GROUP BY region');



  function post($param)
    {
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'https://report.commission2.kz/doit/api/total_tbs.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($param)
        ));
        $response = json_decode(curl_exec($myCurl), true);
        curl_close($myCurl);
        return $response;
    };
    $arr = post([
        'token'=>'qfq5441fa65f4654w'
    ]);


exit(json_encode([
    'obs'=>[
        'auctioneer'=>R::getCell("SELECT SUM(summa_vydachy) 
                        FROM tickets 
                        WHERE region IN (SELECT region FROM kassa WHERE status = 1 GROUP BY region) 
                        AND status IN(7,10,14,15)  "),
        'cashbox'=>R::getCell("SELECT SUM(cashbox) FROM kassa WHERE status = 1 
                    AND region IN (SELECT region FROM kassa WHERE status = 1 GROUP BY region)  "),
        'cash_in_pledge_end'=>R::getCell("SELECT SUM(summa_vydachy) FROM tickets  WHERE status = 2  
                                AND region IN (SELECT region FROM kassa WHERE status = 1 GROUP BY region) ")
    ],
    'tbs'=> $arr['tbs'],
    'lombard'=> R::getRow('SELECT SUM(auktech) as auktech , SUM(aukshubs) as aukshubs,SUM(nalvzaloge) as nalvzaloge 
        FROM reports  WHERE  data = "2022-02-21"'),
]));