<? //проверка существовании сессии

include("../../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
?>

    <?
    $id = $_POST['id'];


    $region = $_POST['region'];
    $adress = $_POST['adress'];


    $data = $_POST['data'];
    $reg_date = $_POST['reg_date'];

    $dl = $_POST['dl'];
    $dm = $_POST['dm'];
    $dop = $_POST['dop'];
    $dohod = $dl + $dm + $dop;
    $stabrashod = $_POST['stabrashod'];
    $tekrashod = $_POST['tekrashod'];
    $allclients = $_POST['allclients'];
    $newclients = $_POST['newclients'];
    $vzs = $_POST['vzs'];
    $vozvrat = $_POST['vozvrat'];
    $nakladnoy = $_POST['nakladnoy'];
    $chv = $_POST['chv'];
    $auktech = $_POST['auktech'];
    $aukshubs = $_POST['aukshubs'];
    $nalvzaloge = $_POST['nalvzaloge'];
    $comment = $_POST['comment'];

    $result = mysqli_query($connect, "UPDATE reports122020 SET

data = '$data', reg_date = '$reg_date', dohod = '$dohod', stabrashod = '$stabrashod', tekrashod ='$tekrashod', allclients = '$allclients', newclients = '$newclients', vzs = '$vzs',

vozvrat = '$vozvrat', nakladnoy = '$nakladnoy', chv = '$chv', auktech = '$auktech', aukshubs = '$aukshubs', nalvzaloge = '$nalvzaloge', comment = '$comment', dl = '$dl', dm = '$dm', dop = '$dop'

WHERE id = $id ");
    //echo "<meta http-equiv='Refresh' content='0; URL=../look.php?id=$id'>";
    echo "<meta http-equiv='Refresh' content='0; URL=../viewfilial12.php?region=$region&adress=$adress'>";

    ?>



  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
