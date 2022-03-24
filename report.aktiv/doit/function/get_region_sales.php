<?php
include_once __DIR__ . '/../../bd.php';

if (!$region) exit();


if($status !=3){
    unset($_GET['region'], $_GET['shop']);
}

$region = $_GET['region'] ?? $region;
$shop = $_GET['shop'] ?? $adress;



$fromtovar = $_GET['from'];
$month = $_GET['month'];
$year = $_GET['year'];

$start_month = date("$year-$month-01");
$date = new DateTime($start_month);
$date->modify('last day of this month');

$end_month = $date->format('Y-m-d');


$placeholder = [':data_start' => $start_month, ':data_end' => $end_month, ':region' => $region, ':adress' => $shop];


function getDays(array $placeholder): array
{
    $sql1 = "SELECT data
                FROM sales 
                WHERE  statustovar IS NULL 
                AND region = :region
                AND adress = :adress
                AND data BETWEEN :data_start AND :data_end 
                GROUP BY data ";
    return R::getCol($sql1, $placeholder);
}

function rand_color()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

function getBranches(array $placeholder): array
{
    $sql = 'SELECT regionlombard,adresslombard,region,adress
                FROM sales 
                WHERE  statustovar IS NULL 
                AND region = :region
                AND adress = :adress
                AND data BETWEEN :data_start AND :data_end 
                GROUP BY regionlombard,adresslombard';

    $datasets = [];

    foreach (R::getAll($sql, $placeholder) as $key) {
        $sql = "SELECT SUM(pribl) 
                        FROM sales 
                        WHERE  statustovar IS NULL 
                        AND regionlombard = :regionlombard
                        AND adresslombard = :adresslombard
                        AND region = :region
                        AND adress = :adress
                        AND data BETWEEN :data_start AND :data_end 
                        GROUP BY data ";
        $placeholder[':regionlombard'] = $key['regionlombard'];
        $placeholder[':adresslombard'] = $key['adresslombard'];
        $placeholder[':region'] = $key['region'];
        $placeholder[':adress'] = $key['adress'];


        $datasets[] = (object)[
            'label' => $key['regionlombard'] . '-' . $key['adresslombard'],
            'data' => R::getCol($sql, $placeholder),
            'backgroundColor' => [rand_color()],
            'borderColor' => [rand_color()],
            'borderWidth' => 1
        ];
    }
    return $datasets;
}
if ($_GET['filter'] == '#branches') {
    exit(json_encode((object)[
        'labels' => getDays($placeholder),
        'datasets' => getBranches($placeholder)
    ]));
}elseif($_GET['filter'] == '#year_total'){


    $sql1 = "SELECT
    DATE_FORMAT(s.data, '%m.%Y') as date_sale, SUM(s.pribl) as cost
    FROM sales s
    WHERE  s.statustovar IS NULL 
    AND region = ?
    AND adress = ?
    GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";

    $sql = "SELECT SUM(s.pribl) as cost
    FROM sales s
    WHERE  s.statustovar IS NULL 
    AND region = ?
    AND adress = ?
    GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";

    exit(json_encode((object)[
        'labels' => R::getCol($sql1, [$region, $shop]),
        'datasets' => [(object)[
            'label' => 'Прибыль от продаж  в магазине за год',
            'data' => R::getCol($sql, [$region, $shop]),
            'backgroundColor' => '#DD4B39',
            'borderColor' => '#00A65A',
            'borderWidth' => 1
        ]]
    ]));

}else {
    $sql = "SELECT SUM(pribl) 
            FROM sales 
            WHERE  statustovar IS NULL 
            AND region = :region
            AND adress = :adress
            AND data BETWEEN :data_start AND :data_end 
            GROUP BY data ";
    $result = R::getCol($sql, $placeholder);
    exit(json_encode((object)[
        'labels' => getDays($placeholder),
        'datasets' => [(object)[
            'label' => 'Прибыль от продаж  в магазине',
            'data' => $result,
            'backgroundColor' => '#FBDB54',
            'borderColor' => '#F78309',
            'borderWidth' => 1
        ]]
    ]));
}
