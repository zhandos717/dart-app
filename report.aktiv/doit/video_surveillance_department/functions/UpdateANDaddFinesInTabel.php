<?
include ("../../../bd.php");
echo $id=$_POST['id'];
echo '<br>';
echo $segdata=$_POST['segdata'];
echo '<br>';
echo $vidfine=$_POST['vidfine'];
echo '<br>';
echo $price=$_POST['price'];

$data = $_POST;

if ($_SESSION['logged_user']->status == 12) {

   $result = mysqli_query($connect, " UPDATE tabel  SET 
                                             vidfine = '$vidfine',
                                             price = '$price'
                                      WHERE idpred = '$id' AND segdata = '$segdata' ");

   header('Location: /doit/video_surveillance_department/addFine');

 }

?>
