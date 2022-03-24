<?php
    include_once __DIR__ . '/../../bd.php';
    header('Content-TYPE: application/json');
    
    if($_POST['token'] == 'VxLvvdw0M7GKwxVsEK0rjViWpuPYjxMcz7DWGq9BmY1YhWvm2caWZCQeHdPzbnks1pFKHCtQ3ZBgXwMKkyynueVXidjhvzdceHwb'){

    $login = strip_tags($_POST['login']);

    $statusread = $_POST['status_read'] ?? 1;
    $statusread =  strip_tags($statusread);


    $mail = R::getAll('SELECT diruser.fio, sluzhebki.tema,sluzhebki.date,sluzhebki.time  FROM sluzhebki JOIN diruser ON sluzhebki.otkovo = diruser.login  WHERE sluzhebki.komu = :to_whom  AND sluzhebki.statusread = :statusread ORDER BY sluzhebki.id DESC LIMIT 10' , [':to_whom' => $login , ':statusread' => $statusread]); //

    exit(json_encode($mail));

    }else {  
    exit(json_encode("{'error': 1,'text': 'Срок действия сессии истек'}"));
    };
