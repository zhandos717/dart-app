<?
include_once '../../../bd.php';

$data = $_POST;
    if (isset($data['rashodreg'])) {

      $datarashoda    = $data['datarashoda'];
      $summag      = $data['summag'];
      $region      = $data['region'];

      $resultc = mysqli_query($connect, "SELECT COUNT(*) FROM diruser WHERE status = 1 AND region ='$region'");
      $datac = mysqli_fetch_array($resultc);
       $kolvofill = $datac['COUNT(*)'];

       $summa = $summag/$kolvofill;


      $result2 = mysqli_query($connect, "SELECT region,adress FROM diruser WHERE status = 1 AND region ='$region'");
      while($data2 = mysqli_fetch_array($result2)){

        $userg = R::dispense('rashodfillialobs');
        $userg->datarashoda = $datarashoda;
        $userg->region = $region;
        $userg->adress = $data2['adress'];
        $userg->summarf = $summa;
        $userg->comments = $data['comments'];
        $userg->datez = date("Y-m-d");
        $userg->timez = date("H:i:s");
        R::store($userg);
        header('Location: /doit/adm/rashody_obs.php?s=succes');
      }




}
?>
