<?
include_once '../../../bd.php';

$data = $_POST;


  if (isset($data['rashodkz'])) {

    $datarashoda    = $data['datarashoda'];
    $summar      = $data['summarpokz'];

    $resultc = mysqli_query($connect, "SELECT COUNT(*) FROM diruser WHERE status = 1");
    $datac = mysqli_fetch_array($resultc);
    $kolvofill = $datac['COUNT(*)'];
    $summa = $summar/$kolvofill;

    $result2 = mysqli_query($connect, "SELECT region,adress FROM diruser WHERE status = 1 GROUP BY region,adress");
    while($data2 = mysqli_fetch_array($result2)){

      $user2 = R::dispense('rashodfillial');
      $user2->datarashoda = $datarashoda;
      $user2->region = $data2['region'];
      $user2->adress = $data2['adress'];
      $user2->summarf = $summa;
      $user2->comments = $data['comments'];
      $user2->datez = date("Y-m-d");
      $user2->timez = date("H:i:s");
      R::store($user2);
      header('Location: /doit/buh/rashody.php?s=succes');
    }
  }



?>
