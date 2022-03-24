<?php
    include_once '../../bd.php';
    if (!$region) exit;

    $output = json_decode(file_get_contents('php://input'), true);


    

    exit(json_encode([
        'ticket' => R::getRow(
        'SELECT  
        tickets.id, 
        tickets.tovarname,tickets.hdd,tickets.sn,
        tickets.imei, 
        tickets.iin,
        tickets.nomerzb,
        tickets.fio,
        tickets.complect,
        tickets.category,
        tickets.opisanie,
        tickets.summa_vydachy,
        tickets.reg_data,
        tickets.dv,
        tickets.dataseg,
        tickets.dataatime,
        tickets.cena_pr,
        tickets.residualvalu,
        tickets.status,
        status_zb.name,
        tickets.srok,
        tickets.zadatok,
        tickets.saler,
        tickets.datesale,
        tickets.dateshop,
        tickets.data_pos

        FROM tickets JOIN status_zb ON tickets.status = status_zb.id  
        WHERE nomerzb = :nomerzb  LIMIT 1',
        [':nomerzb' => $output['num_contract']]
        ),
        'sale'=> R::getAll('SELECT * FROM salecomision WHERE codetovar = :nomerzb', 
        [':nomerzb' => $output['num_contract']]
    ), 


    ]));