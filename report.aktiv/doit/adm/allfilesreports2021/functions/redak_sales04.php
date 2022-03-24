<? //проверка существовании сессии
include("../../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
?>

    <?
    $id = $_POST['id'];

    $data = $_POST['data'];

    $data_z = $data;
    $region = $_POST['region'];
    $shop   = $_POST['adress'];


    $codetovar = $_POST['codetovar'];
    $tovarname = $_POST['tovarname'];
    $summaprihod = $_POST['summaprihod'];
    $summakredit = $_POST['summakredit'];
    $predoplata = $_POST['predoplata'];
    $summareal = $_POST['summareal'];
    $pribl = $_POST['pribl'];
    $vid = $_POST['vid'];
    $saler = $_POST['saler'];
    $pokupatel = $_POST['pokupatel'];
    $summazaden = $_POST['summazaden'];

    $result = mysqli_query($connect, "UPDATE sales04 SET

data = '$data', codetovar = '$codetovar', tovarname = '$tovarname', summaprihod ='$summaprihod', summakredit = '$summakredit', predoplata = '$predoplata', summareal = '$summareal', pribl = '$pribl',

vid = '$vid', saler = '$saler', pokupatel = '$pokupatel', summazaden = '$summazaden'

WHERE id = $id ");
    echo "<meta http-equiv='Refresh' content='0; URL=../detail04.php?region=$region&shop=$shop&data_z=$data_z'>";
    ?>



  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
