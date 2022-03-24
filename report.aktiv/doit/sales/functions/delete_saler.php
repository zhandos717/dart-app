<?php
include_once  '../../../bd.php';

if(is_numeric($_GET['id']) && $_SESSION['logged_user']->status == 5){
        $saler = R::load('saler', $_GET['id']);
        if($saler['region']==$region && $saler['shop'] == $adress){
        R::trash($saler);
        }
}
header('Location: ../salers.php');