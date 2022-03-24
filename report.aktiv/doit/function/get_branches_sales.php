<?php
include_once __DIR__ . '/../../bd.php';

if (!$status == 1) exit();

if ($region and $adress) {


    $sql1 = "SELECT
    DATE_FORMAT(s.data, '%m.%Y') as date_sale, SUM(s.pribl) as cost
    FROM sales s
    WHERE  s.statustovar IS NULL 
    AND regionlombard = ?
    AND adresslombard = ?
    GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";

    $sql = "SELECT SUM(s.pribl) as cost
    FROM sales s
    WHERE  s.statustovar IS NULL 
    AND regionlombard = ?
    AND adresslombard = ?
    GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";
    $sql = 'SELECT regionlombard,adresslombard
                FROM sales 
                WHERE  statustovar IS NULL 
                AND region = :region
                AND adress = :adress
                AND data BETWEEN :data_start AND :data_end 
                GROUP BY regionlombard,adresslombard';


    exit(json_encode((object)[
        'labels' => R::getCol($sql1, [$region, $adress]),
        'datasets' => [
            (object)[
                'label' =>'Комиссионный магазин',
                'data' => R::getCol("SELECT SUM(s.pribl) as cost
                        FROM sales s
                        WHERE  s.statustovar IS NULL 
                        AND s.regionlombard = ?
                        AND s.adresslombard = ?
                        AND s.fromtovar = 2
                        GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')", [$region, $adress]),
                'backgroundColor' => ['#4DC85B'],
                'borderColor' => ['#4DC85B'],
                'borderWidth' => 1
            ],(object)[
                'label' => 'Ломбард',
                'data' => R::getCol("SELECT SUM(s.pribl) as cost
                        FROM sales s
                        WHERE  s.statustovar IS NULL 
                        AND s.regionlombard = ?
                        AND s.adresslombard = ?
                        AND s.fromtovar = 1
                        GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')", [$region, $adress]),
                'backgroundColor' => ['#2098D4'],
                'borderColor' => ['#2098D4'],
                'borderWidth' => 1
            ]
        ]
    ]));
}