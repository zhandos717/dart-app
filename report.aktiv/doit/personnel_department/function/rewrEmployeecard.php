<?
include("../../../bd.php");
if(!isset($fio)) header('Location: /');
if (!empty($_POST['regos'])) {

  $id = $_POST['id'];
  $fio = $_POST['fio'];
  $iin = $_POST['iin'];
  $dpnr = $_POST['dpnr'];
  $typedogovor = $_POST['typedogovor'];
  $region = $_POST['region'];
  $adress = $_POST['adress'];
  $doljnost = $_POST['doljnost'];
  $otdel = $_POST['otdel'];
  $status = $_POST['status'];

  $result = mysqli_query($connect, " UPDATE employeecard SET
                                                fio = '$fio',
                                                iin = '$iin',
                                                dpnr = '$dpnr',
                                                typedogovor = '$typedogovor',
                                                region = '$region',
                                                adress= '$adress',
                                                doljnost = '$doljnost',
                                                otdel = '$otdel',
                                                status = '$status'

                                                WHERE id = '$id' ");

   echo "<meta http-equiv='Refresh' content='0; URL=../employeecard'>";
}

if (!empty($_POST['delgos'])) {

  $id = $_POST['id'];

  $result = mysqli_query($connect, " DELETE FROM employeecard  WHERE id = '$id' ");

   echo "<meta http-equiv='Refresh' content='0; URL=../employeecard'>";
}
?>
