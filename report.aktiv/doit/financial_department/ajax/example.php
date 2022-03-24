<?php
 include ("../../../bd.php");
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $input = filter_input_array(INPUT_POST);
} else {
  $input = filter_input_array(INPUT_GET);
}

if ($input['action'] === 'edit') {
  if(is_numeric($input['cena_pr'])){
    $ticket = R::load('tickets',$input['id'] );
    $ticket->cena_pr = trim($input['cena_pr']);
    R::store($ticket);
  }
} else if ($input['action'] === 'delete') {
 
} else if ($input['action'] === 'restore') {
 
}
echo json_encode($input);
