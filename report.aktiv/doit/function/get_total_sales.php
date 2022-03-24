<?php
include_once __DIR__ . '/../../bd.php';

if (!$region) exit();

$placeholder = [':data_start' => $_GET['start'], ':data_end' => $_GET['end']];


function getDays(array $placeholder): array
{
    $sql1 = "SELECT data
                FROM sales 
                WHERE  statustovar IS NULL 
                AND data BETWEEN :data_start AND :data_end 
                GROUP BY data ";
    return R::getCol($sql1, $placeholder);
}

function rand_color()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

function getRegion(array $placeholder): array
{
    $sql = 'SELECT region,adress
                FROM sales 
                WHERE  statustovar IS NULL 
                AND data BETWEEN :data_start AND :data_end 
                GROUP BY region,adress';

    $datasets = [];

    foreach (R::getAll($sql, $placeholder) as $key) {
        $sql = "SELECT SUM(pribl) 
                        FROM sales 
                        WHERE  statustovar IS NULL 
                        AND region = :region
                        AND adress = :adress
                        AND data BETWEEN :data_start AND :data_end 
                        GROUP BY data ";
        $placeholder[':region'] = $key['region'];
        $placeholder[':adress'] = $key['adress'];

        $datasets[] = (object)[
            'label' => $key['region'] . '-' . $key['adress'],
            'data' => R::getCol($sql, $placeholder),
            'backgroundColor' => [rand_color()],
            'borderColor' => [rand_color()],
            'borderWidth' => 1
        ];
    }
    return $datasets;
}

if (isset($_GET['filter']) and $_GET['filter'] == '#city') {

    exit(json_encode((object)[
        'labels' => getDays($placeholder),
        'datasets' => getRegion($placeholder)
    ]));

}else if($_GET['filter'] == '#year_total_all'){
    $sql1 = "SELECT
    DATE_FORMAT(s.data, '%m.%Y') as date_sale, SUM(s.pribl) as cost
    FROM sales s
    WHERE  s.statustovar IS NULL 
    GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";
    $sql = "SELECT SUM(s.pribl) as cost
    FROM sales s
    WHERE  s.statustovar IS NULL 
    GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";
    exit(json_encode((object)[
        'labels' => R::getCol($sql1),
        'datasets' => [(object)[
            'label' => 'Прибыль от продаж  в магазинах за год',
            'data' => R::getCol($sql),
            'backgroundColor' => '#DD4B39',
            'borderColor' => '#00A65A',
            'borderWidth' => 1
        ]]
    ]));
} else if ($_GET['filter'] == '#year_total_city') {


    $sql1 = "SELECT
    DATE_FORMAT(s.data, '%m.%Y') as date_sale, SUM(s.pribl) as cost
    FROM sales s
    WHERE  s.statustovar IS NULL 
    GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";
    
    $sql = 'SELECT region, adress
                FROM sales 
                WHERE statustovar IS NULL 
                GROUP BY region, adress';

    $datasets = [];

    foreach (R::getAll($sql) as $key) {
        $sql = "SELECT SUM(s.pribl) as cost
                        FROM sales s
                        WHERE  s.statustovar IS NULL 
                        AND s.region = ?
                        AND s.adress = ?
                        GROUP BY  DATE_FORMAT(s.data, '%Y-%m-01')";

        $datasets[] = (object)[
            'label' => $key['region'] . '-' . $key['adress'],
            'data' => R::getCol($sql, [$key['region'], $key['adress']]),
            'backgroundColor' => [rand_color()],
            'borderColor' => [rand_color()],
            'borderWidth' => 1
        ];
    }

    exit(json_encode((object)[
        'labels' => R::getCol($sql1),
        'datasets' =>  $datasets
    ]));

}else {
    $sql = "SELECT SUM(pribl) 
            FROM sales 
            WHERE  statustovar IS NULL 
            AND data BETWEEN :data_start AND :data_end 
            GROUP BY data ";

    $result = R::getCol($sql, $placeholder);
    exit(json_encode((object)[
        'labels' => getDays($placeholder),
        'datasets' => [(object)[
            'label' => 'Прибыль от продаж по Казахстану',
            'data' => $result,
            'backgroundColor' => '#FBDB54',
            'borderColor' => '#F78309',
            'borderWidth' => 1
        ]]
    ]));
}
