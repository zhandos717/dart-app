<?
include("../../../bd.php");
$data = $_POST;
$doljnost = $data['doljnost'];
if ($_SESSION['logged_user']->status == 1) :

  if(R::findOne('cardlc', 'fio=? AND region=? AND adress = ? AND doljnost = ?',[$data['fio'], $region , $adress, $doljnost ])){
    header('Location: /doit/dirfil/tabel/');
  }
  else {

$user = R::dispense('cardlc');
$user->region = $data['region'];
$user->adress = $data['adress'];
$user->fio = $data['fio'];
$user->time_work = $data['time_work'];
$user->doljnost = $data['doljnost'];
$user->datatime = date("Y-m-d H:i:s");
R::store($user);
header('Location: /doit/dirfil/tabel/');
}
endif;
?>
