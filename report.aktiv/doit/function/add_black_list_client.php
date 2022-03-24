<?php
include '../../bd.php';


    if (isset($_POST['iin'])) {
 
        $client = R::findOneOrDispense('clients', 'iin=?', [$_POST['iin']]);

        $client['name'] =           $_POST['fio'];
        $client['iin'] =            $_POST['iin'];
        $client['document_number'] =  $_POST['document_number'];
        $client['date_document'] =  $_POST['date_vyd'];
        $client['issued_by'] =      $_POST['issued_by'];
        $client['message'] =      $_POST['reason_blocking'];
        $client['date_add'] =      date('Y-m-d H:i:s'); 

        $client['status'] =         1;
        $client->add_user          = $fio;
        R::store($client);
    }
    header('Location: ../adm/clients.php');