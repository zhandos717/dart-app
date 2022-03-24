<?
include("../../../bd.php");
$data = $_POST;
$otkovo = $_SESSION['logged_user']->login;
if ($_SESSION['logged_user']->status == 10) {

$id = $_POST['id'];
$result = mysqli_query($connect, " UPDATE sluzhebki SET
                                                statusz = 3 
                                     WHERE id = '$id'
                                     ");
header('Location: /doit/buh/edo/');

}
?>
