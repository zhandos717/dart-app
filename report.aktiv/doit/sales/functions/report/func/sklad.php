<?
include_once '../../../../../bd.php';
if($_POST['status'] == 15 OR $_POST['status'] == 14 OR $_POST['status'] == 10){
$result = R::load('tickets',$_POST['id']);
$result->status = $_POST['status'];
if($_POST['status']==15){
$result->statusremont = 1;
$result->dateremont = date('Y-m-d');
$result->remontmessage = $_POST['message'];
}
R::store($result);
}