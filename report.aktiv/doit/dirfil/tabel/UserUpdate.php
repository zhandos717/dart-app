<?
include("../../../bd.php");
$data = $_POST;

if ($_SESSION['logged_user']->status == 1) {

    $id = $data['id'];
    $time_work = $data['time_work'];
    $result1 = mysqli_query($connect, " SELECT * FROM timework WHERE workschedule ='$time_work'");
    $data1 = mysqli_fetch_array($result1);
    $designation = $data1['designation'];
    $segdata = date("Y-m-d");

   $result = mysqli_query($connect, " UPDATE employeecard SET
                                             time_work = '$time_work',
                                             workhours = '$designation',
                                             datasegdir = '$segdata'
                                      WHERE id = '$id' ");
                                      
   header('Location: /doit/dirfil/tabel/');

    }

?>
