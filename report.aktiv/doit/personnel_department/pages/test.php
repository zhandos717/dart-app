<?php
$adress = R::findAll('diruser','GROUP BY adress');
foreach($adres as $item){
    $branch = R::dispense('branches');
    $branch->region = $item['region'];
    $branch->adress = $item['adress'];
}



