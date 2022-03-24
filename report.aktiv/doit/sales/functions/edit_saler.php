<?php
include_once  '../../../bd.php';
if($_SESSION['logged_user']->status == 5){
        
if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $saler = R::load('saler', $_GET['id']);
        if($saler['region']==$region && $saler['shop'] == $adress){
        R::trash($saler);
        }
}else if(isset($_POST['fiosaler']) && !empty($_POST['fiosaler'])){
        $saler = R::dispense('saler');
        $saler->fiosaler = $_POST['fiosaler'];
        $saler->region = $region;
        $saler->shop = $adress;
        $saler->add_user    = $fio;
        $saler->datareg     = date('Y-m-d H:i:s');
        R::store($saler);
}
}
header('Location: ../salers.php');