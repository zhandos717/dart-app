<?
include_once '../../../bd.php';

if(is_numeric($_POST['id']) && $status==12){
    $ticket = R::load('tickets', $_POST['id']);
    if($ticket->status == 1){
        $no_sms = R::dispense('withoutsms');
        $no_sms->nomerzb = $ticket->nomerzb;
        $no_sms->ticketid = $ticket->id;
        $no_sms->timeadd_accept = date('Y-m-d H:i:s');
        $no_sms->status = 2;
        $no_sms->user_accept = $fio;
        R::store($no_sms);
        exit(json_encode(['Оформление договора без смс разрешен! Передайте сотруднику.']));
    }elseif($ticket->status == 2){
        $no_sms = R::findOneOrDispense('withoutsms', 'ticketid = ?',[$ticket->id]);
        if(empty($no_sms->nomerzb)){
            $no_sms->nomerzb = $ticket->nomerzb;
            $no_sms->ticketid = $ticket->id;
        }
        $no_sms->status = 4;
        $no_sms->timeadd_give_out = date('Y-m-d H:i:s');
        $no_sms->user_give_out = $fio;
        R::store($no_sms);
        exit(json_encode(['Выкуп без смс разрешен! Передайте сотруднику.']));
    }else {
        exit(json_encode(['Ошибка, статус данного договора уже выдан!']));
    }
}

