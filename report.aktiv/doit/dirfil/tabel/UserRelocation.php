<?
include("../../../bd.php");
$data = $_POST;

if ($_SESSION['logged_user']->status == 1) {

    $id = $data['id'];
    $region = $data['region'];
    $adress = $data['adress'];
    $result = mysqli_query($connect, " UPDATE employeecard SET
                                             region = '$region',
                                             adress = '$adress',
                                             metkaper = '1'
                                      WHERE id = '$id' ");

   header('Location: /doit/dirfil/tabel/');

    }

?>
