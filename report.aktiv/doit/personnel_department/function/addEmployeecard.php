<?
include("../../../bd.php");
if(!isset($fio)) header('Location: /');
if (!empty($_POST['gos'])) {

  $user = R::dispense('employeecard');
  $user->fio = $_POST['fio'];
  $user->iin = $_POST['iin'];
  $user->dpnr = $_POST['dpnr'];
  $user->typedogovor = $_POST['typedogovor'];
  $user->region = $_POST['region'];
  $user->adress = $_POST['adress'];
  $user->doljnost = $_POST['doljnost'];
  $user->otdel = $_POST['otdel'];
  $user->status = '1';

  $dataseg = date("Y-m-d");
  $user->dataseg = $dataseg;
  $reg_hi = date("H:i");
  $user->reg_hi = $reg_hi;
  R::store($user);

   echo "<meta http-equiv='Refresh' content='0; URL=../employeecard'>";
}
?>
