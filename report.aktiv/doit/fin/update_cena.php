<?php
include("../../bd.php");
 //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 11) :


        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;

        $id = $_POST['id'];
        $cena_prod = R::load('tickets',$id);
        $cena_prod->cena_old = $cena_prod['cena_pr'];
        $cena_prod->cena_update =date('Y-m-d H:i:s');
        $cena_prod->cena_updateuser = $_SESSION['logged_user']->fio;
        $cena_prod->cena_ip=$ip;
        $cena_prod->cena_pr =$_POST['cena_pr'];
        R::store($cena_prod);
        $region = $_POST['region'];


        header("Location: viewmyreports.php?date={$_POST['today']}&region=$region&adress={$_POST['adress']}");

endif; ?>