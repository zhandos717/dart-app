<?php
include '../../bd.php';
if ($_SESSION['logged_user']->status == 3):

    function percent($number, $percent){
        return round($number - ($number / 100 * $percent));
    }

    $sql = "SELECT region, adress,
        SUM(dl) as dl ,SUM(dm) as dm,
        SUM(dop) as dop, SUM(dohod) as dohod,
        SUM(stabrashod) as stabrashod,SUM(tekrashod) as tekrashod,
        SUM(allclients) as allclients,SUM(newclients) as newclients,
        SUM(vzs) as vzs,SUM(vozvrat) as vozvrat,
        SUM(allclients) as allclients,
        SUM(nakladnoy) as nakladnoy,SUM(chv) as chv
        FROM reports ";

    $sql1 = 'SELECT aukshubs,auktech,nalvzaloge,tekrashod,stabrashod
                    FROM reports 
                    WHERE adress = ? 
                    ORDER BY data 
                    DESC LIMIT 1';

    $output = json_decode(file_get_contents('php://input'), true);

            // $sales = R::getAll(
            // 'SELECT SUM(pribl), 
            //     SUM(remainder), SUM(summaprihod)
            //     FROM sales WHERE regionlombard = :region  
            //     AND fromtovar = 2 AND data 
            //     BETWEEN :data_begin AND :data_end   
            //     AND statustovar IS NULL',
            //     [ ':region'=> $item['region'], ':data_begin '=>date('Y-m-1'),
            //          ':data_end '=> date('Y-m-t')]);

function getReports(string  $sql, string $sql1, int $getReport ) {
        if($getReport == 1){
        $result1 = R::getAll($sql . 'GROUP BY region');
        foreach ($result1 as $item) {
            $adress =R::getCol("SELECT adress  
                    FROM reports   
                    WHERE region = :region  
                    GROUP BY adress",[':region'=> $item['region']]);
            $auktech = 0;
            $aukshubs = 0;
            $nalvzaloge = 0;
            foreach ($adress as $key => $value) {
                $fil = R::getRow($sql1, [$value]);
                $auktech += $fil['auktech'];
                $aukshubs += $fil['aukshubs'];
                $nalvzaloge += $fil['nalvzaloge'];
            }
            $reports[] = array_merge($item, [
                'auktech' => $auktech,
                'aukshubs' => $aukshubs,
                'nalvzaloge' => $nalvzaloge,
                'consumption' => $item['tekrashod'] + $item['stabrashod'],
                'income' => $item['dl'] + $item['dm'] + $item['dop'],
                'profit' => percent(($item['dl'] + $item['dm'] + $item['dop']) - ($item['tekrashod'] + $item['stabrashod']), 20),
            ]);
        }
        }else{
            $result1 = R::getAll($sql . 'GROUP BY adress ORDER BY region ASC ');
            foreach ($result1 as $item) {
                $fil = R::getRow($sql1, [$item['adress']]);
                $array = [
                    'auktech' => $fil['auktech'],
                    'aukshubs' => $fil['aukshubs'],
                    'nalvzaloge' => $fil['nalvzaloge'],
                    'consumption'=> $item['tekrashod'] + $item['stabrashod'],
                    'income'=> $item['dl'] + $item['dm'] + $item['dop'],
                    'profit' => percent(($item['dl'] + $item['dm'] + $item['dop']) - ($item['tekrashod'] + $item['stabrashod']),20),
                ];
                $arr[] = array_merge($item, $array);
            }
            $reports = $arr; 
        }

        $result = R::getAll($sql);
        $item = $result[0];
        $adress = R::getCol("SELECT adress FROM reports GROUP BY adress");
        $auktech = 0;
        $aukshubs = 0;
        $nalvzaloge = 0;
        foreach ($adress as $key => $value) {
            $fil = R::getRow($sql1, [$value]);
            $auktech += $fil['auktech'];
            $aukshubs += $fil['aukshubs'];
            $nalvzaloge += $fil['nalvzaloge'];
        }
        $total = array_merge($result[0], [
            'auktech' => $auktech,
            'aukshubs' => $aukshubs,
            'nalvzaloge' => $nalvzaloge,
            'consumption' => $item['tekrashod'] + $item['stabrashod'],
            'income' => $item['dl'] + $item['dm'] + $item['dop'],
            'profit' => percent(($item['dl'] + $item['dm'] + $item['dop']) - ($item['tekrashod'] + $item['stabrashod']), 20),
        ]);
        return ['reports' =>  $reports, 'total' =>   $total,];
    }
        echo json_encode(getReports($sql,  $sql1, $output['getReport']));
endif;

