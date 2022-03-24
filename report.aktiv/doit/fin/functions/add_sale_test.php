<?php
include("../../../bd.php");
    if ($_SESSION['logged_user']->status == 11) :

        if (isset($_POST['datesale'])) {

            $result=R::load('tickets',$_POST['id']);

            if( $result->status != 2){

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
            }

            exit(json_encode([
                'status' => 'success',
                'message' => $_POST['id'] . 'Товар ' . $result->nomerzb . ' успешно проторгован, за ' . $result->cena_pr,
            ]));

        };
        endif; ?>