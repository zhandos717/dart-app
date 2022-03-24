<?php
include("../../bd.php");


    $data = R::findAll('tickets', "status = 5 AND datesale > '2020-12-16' AND salecomision IS NULL AND NOT (region= 'Нур-Султан' OR region= 'Кокшетау' OR region= 'Павлодар' OR region= 'Костанай' OR region= 'Караганда' ) ");
    
    foreach($data as $d){
    $res = R::findOne('salecomision', "codetovar = ? AND dataa = ?", [$d['nomerzb'], $d['datesale']]);

    if($res['codetovar']  == $d['nomerzb']){
    echo    $res['codetovar']. '=' .$d['nomerzb'];
    echo '<br>';
    $i++;
    }elseif($res['codetovar']  != $d['nomerzb']) {
    echo  $res['codetovar'] . '=' . $d['nomerzb'];
    echo '<br>';
    $s = R::load('tickets', $d['id']);
    $s->salecomision = 2;
    R::store($s);
    $j++;
    }
    }

    echo 'Наших: '.$i;
    echo '<br>';
    echo 'Не наших: ' .$j;  
    
    ?>