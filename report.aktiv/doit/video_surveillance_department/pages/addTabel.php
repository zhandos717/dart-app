<?
include_once '../../../bd.php';
if($status == 12){
$data = $_GET;
$segdata = date("Y-m-d");

    if (isset($data['addtabel'])) {
$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM employeecard WHERE id = '$id' ");
$data2 = mysqli_fetch_array($result);
$region = $data2['region'];
$adress = $data2['adress'];
$fio = $data2['fio'];
$doljnost = $data2['doljnost'];
$time_work = $data2['time_work'];
$vrmeiya = $_GET['vrmeiya'];
$workhours = $data2['workhours'];

$result22 = mysqli_query($connect, "SELECT COUNT(id) FROM tabel WHERE idpred = '$id' AND segdata='$segdata' ");
$data22 = mysqli_fetch_array($result22);
$countsegid = $data22['COUNT(id)'];
$dopinfo = $_GET['dopinfo'];

$region2 = rawurlencode($region);
$adress2 = rawurlencode($adress);


if($countsegid>0){
  $result33 = mysqli_query($connect, " UPDATE tabel SET dopinfo = '$dopinfo', vrmeiya = '$vrmeiya' WHERE idpred = '$id' ");
  $data33 = mysqli_fetch_array($result33);
  header('Location: /doit/video_surveillance_department/tabel?region='.$region2.'&adress='.$adress2.'&gogogo=Подтвердить');
}
else{
        $userg = R::dispense('tabel');
        $userg->idpred = $id;
        $userg->region = $region;
        $userg->adress = $adress;
        $userg->fio = $fio;
        $userg->doljnost = $doljnost;
        $userg->segdata = $segdata;
        $userg->time_work = $time_work;
        $userg->vrmeiya = $vrmeiya;
        $userg->dopinfo = $_GET['dopinfo'];
        $userg->typedogovor = $_GET['typedogovor'];
        $userg->otdel = $_GET['otdel'];
        $userg->metka = '1';
        $userg->hours = $workhours;
        R::store($userg);
        header('Location: /doit/video_surveillance_department/tabel?region='.$region2.'&adress='.$adress2.'&id='.$userg->id.'&idpred='.$userg->idpred.'&gogogo=Подтвердить');
}
}
}
?>
