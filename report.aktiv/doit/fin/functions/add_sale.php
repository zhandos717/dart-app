<?php
include("../../../bd.php");
    if ($_SESSION['logged_user']->status == 11) :

        if (isset($_POST['go_sale'])) {

            $result=R::load('tickets',$_POST['idx']);

            if($result->cena_pr != $_POST['cena_pr']){
            $result->cena_old = $result->cena_old;
            $result->cena_updateuser = $_SESSION['logged_user']->fio;
            $result->cena_update = date("Y-m-d H:i:s");
            }
            $result->saler = $_SESSION['logged_user']->fio;
            $result->salerstatus = 2;
            $result->cena_pr = $_POST['cena_pr'];
            $result->status = 5;
            $result->datesale = $_POST['datesale'];
            $result->dataatime = date("Y-m-d H:i:s");
            R::store($result);
            $_SESSION['message'] = 'Товар успешно реализован'; 
            header("Location: ../sale_product.php?nomerzb={$result['nomerzb']} ");

        };
        if (!empty($_POST['go_shop'])) {

            $data = R::load('product', $_POST['go_shop']);
            if($data->counttovar >= $_POST['counttovar']){
            $data->counttovar = $data->counttovar-$_POST['counttovar'];
            R::store($data);

            $result=R::dispense('productreport');
            $result->id_product = $_POST['go_shop'];
            $result->counttovar = $_POST['counttovar'];

            $result->saler = $_SESSION['logged_user']->fio;
            $result->user = $_SESSION['logged_user']->fio;

            $result->purchaseamount = $data->purchaseamount * $_POST['counttovar']; //приход товара
            $result->region = $data->region;
            $result->adress = $data->adress;
            $result->name = $data->name;
            $result->category = $data->category;

            $result->salerstatus = 2;
            $result->price = $_POST['price'] * $_POST['counttovar'];
            $result->datereg = $_POST['date_sale'];
            $result->datereport = date("Y-m-d H:i:s");

            R::store($result);

            $_SESSION['message'] = 'Товар успешно реализован'; 
            header("Location: ../sale_product.php?nomerzb={$_POST['go_shop']} ");
             }else{
            $_SESSION['error'] = 'Недостаточно товара на складе для реализации!';
            header("Location: ../sale_product.php?nomerzb={$_POST['go_shop']} ");
             }   

        };    
        endif; ?>