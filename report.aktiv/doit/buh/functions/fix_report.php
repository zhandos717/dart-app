<?
include("../../../bd.php");

if ($_SESSION['logged_user']->status == 10) :
if(isset($_POST['id_report'])){
// echo '<pre>';
//     var_dump($_POST);
//     echo '</pre>';

//     exit;
//     // R::freeze(true);

    $report = R::load('repotscom',$_POST['id_report']);

    $productcount = R::count('productreport', 'region=? AND adress = ? AND datereg=?', [$report['region'], $report['adress'], $report['datereport']]);

    $report->summstart = (int)$_POST['startsumm'] ?? 0;
    $report->finhelp = (int)$_POST['replenishment'] ?? 0;
    $report->withdrawal = (int)$_POST['withdrawal'] ?? 0;
    $report->vydacha = (int)$_POST['summa_vydachy'] ?? 0;
    $report->comis = (int)$_POST['p1'] ?? 0;
    $report->proc = (int)$_POST['proc'] ?? 0;
    $report->vozvrat = (int)$_POST['vozv'] ?? 0;
    $report->summsale = (int)$_POST['summareal'] ?? 0;
    $report->deposit = (int)$_POST['zadatok_z'] ?? 0;
    $report->product = (int)$_POST['price'] ?? 0;
    $report->salesincome = (int)$_POST['salesincome'] ?? 0;
    $report->counttovar= (int)$productcount ?? 0;
    
    if(!empty($_POST['endsumm'])){
        $report->endsumm = (int)$_POST['endsumm'];
    }


    if($report['datereport'] == date('Y-m-d')){
        $cashbox = R::findOne('kassa', 'region=? AND filial = ? AND kassa= ?',[$report['region'], $report['adress'], $report['kassa']]);
        $cashbox->startamount = (int)$_POST['startsumm'] ?? 0;
        // $cashbox->finhelp = (int)$_POST['replenishment'] ?? 0;
        // $cashbox->withdrawal = (int)$_POST['withdrawal'] ?? 0;

        $cashbox->interestpercontract = (int)$_POST['p1'] ?? 0;
        $cashbox->proc = (int)$_POST['proc'] ?? 0;
        $cashbox->cashwithdrawal = (int)$_POST['summa_vydachy'] ?? 0;
        $cashbox->soldfor = (int)$_POST['summareal'] ?? 0;
        $cashbox->salesincome = (int)$_POST['salesincome'] ?? 0;
        $cashbox->purchasereturns = (int)$_POST['vozv'] ?? 0;
        $cashbox->deposit = (int)$_POST['zadatok_z'] ?? 0;
        $cashbox->product = (int)$_POST['price'] ?? 0;
        $cashbox->counttovar= (int)$productcount ?? 0;

        // if(!empty($_POST['endsumm'])){
        //         $cashbox->cashbox = (int)$_POST['endsumm'];
        // }
        R::store($cashbox);
    }

    if( R::store($report)){
        echo "Отчет за {$report['datereport']} исправлен";
    }
}
endif;
