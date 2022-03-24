<?
include("../../../bd.php");

if ($_SESSION['logged_user']->status != 10) exit('Сессия закончилась');


if(isset($_POST['adress'])){


    $reports = R::findAll(
        'repotscom',
            "kassa = :kassa AND adress = :adress 
            AND datereport BETWEEN  :data1 AND :data2 ",
            [   
                ':kassa' => $_POST['kassa'],
                ':adress' => $_POST['adress'],
                ':data1' => $_POST['date1'],
                ':data2' => $_POST['date2'],
            ]
        );

    $message = '';
    foreach($reports as $report){

        $placeholder =
        [
            ':adress' => $report['adress'],
            ':kassa' => $report['kassa'],
          
        ];

        $yesterday = strtotime($report['datereport']);
        $yesterday = strtotime("-1 day", $yesterday);
        $yesterday = date('Y-m-d', $yesterday);



        $placeholder[':data1']  =  $yesterday;

            $endsumm = R::getCell("SELECT endsumm FROM repotscom  
            WHERE adress = :adress 
            AND kassa = :kassa
            AND datereport = :data1",  $placeholder);
     

        $placeholder[':data1']  = $report['datereport'];

        $replenishment = R::getCell("SELECT SUM(summa) FROM finance 
        WHERE operationtype ='0' 
        AND status = '2' 
        AND  filial = :adress AND kassa = :kassa AND dataa = :data1 ",  $placeholder);

        $withdrawal = R::getCell("SELECT SUM(summa) 
        FROM finance 
        WHERE operationtype ='1' 
        AND status = '2' 
        AND filial = :adress  AND kassa = :kassa AND dataa = :data1 ",  $placeholder);

        $deposit = R::getCell("SELECT SUM(zadatok) FROM salecomision 
        WHERE dataa =  :data1   AND filial = :adress 
        AND kassa = :kassa AND zadatok IS NOT NULL",  $placeholder);

        $summareal = R::getRow("SELECT SUM(summaprihod),SUM(summareal) FROM salecomision 
        WHERE dataa =  :data1   AND filial = :adress 
        AND kassa = :kassa AND zadatok IS NULL",  $placeholder);
        
        $tick = R::getRow(
            "SELECT SUM(p1) as p1, SUM(summa_vydachy) as sv  FROM tickets 
                    WHERE NOT status IN (1,11) 
                    AND adressfil = :adress
                    AND kassa= :kassa   
                    AND  dataseg = :data1  ", $placeholder );

        $ticket = R::getRow(
            "SELECT SUM(proc) as tproc, SUM(summa_vydachy) as sv  FROM tickets 
                    WHERE status  = 4 
                    AND comission IS NULL
                    AND adressfil = :adress
                    AND kassa= :kassa   
                    AND  datavykup = :data1 ", $placeholder );


        $product = R::getRow('SELECT SUM(price), COUNT(*) FROM productreport WHERE  adress = :adress AND datereg= :data1  AND kassa = :kassa ', $placeholder);

        if(is_numeric($report['comis']) and is_numeric($tick['p1'])){
        if($report['comis'] != $tick['p1']){

            $message .= "Выдача за $date исправлен {$report['comis']}  != {$tick['p1']} :=>{$report->vydacha} \r\n";
            $success = true;
        }
        }
        if (is_numeric($report['proc']) and is_numeric($ticket['tproc'])) {
        if ($report['proc'] != $ticket['tproc']){
            $message .= "Выкуп за $date исправлен {$report['proc']} != {$ticket['tproc']} :=>{$report->vozvrat} \r\n";
            $success = true;
        }
        }

        $report->summstart =  $endsumm;

        $report->finhelp = (int)$replenishment  ?? 0;
        $report->withdrawal = (int)$withdrawal ?? 0;

        $report->summsale = (int)$summareal['SUM(summareal)'] ?? 0;

        $report->comis = (int)$tick['p1']   ?? 0;

        $report->vydacha = (int)$tick['sv']   ?? 0;

        $report->vozvrat = (int)$ticket['sv'] + $ticket['tproc']  ?? 0;

        $report->proc =  (int)$ticket['tproc'] ?? 0;

        $report->deposit = (int)$deposit ?? 0;
        
        $report->product = (int) $product['SUM(price)'] ?? 0;

        $report->salesincome = (int)($summareal['SUM(summareal)']- $summareal['SUM(summaprihod)']) ?? 0;
        
        $report->counttovar = (int)$product['COUNT(*)'] ?? 0;

        $report->endsumm = (int)(($report->summstart + $report->finhelp + $report->summsale + $report->deposit + $report->product + $report->vozvrat + $report->comis) - ($withdrawal + $report->vydacha));

        R::store($report);
        }

    if(!empty($success)){
        exit(json_encode(['success' => $success, 'message' => $message]));
    }else{
        exit(json_encode(['message' => 'Ничего нет']));
    }
}

