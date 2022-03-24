<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
?>

    <?
    $id = $_POST['id'];

    $data = $_POST['data'];
    $region = $_POST['region'];
    $adress = $_POST['adress'];
    $codetovar = $_POST['codetovar'];
    $pereoceka = $_POST['pereoceka'];
    $comment = $_POST['comment'];


    $result = mysqli_query($connect, " UPDATE kosyak SET region = '$region', adress = '$adress', codetovar = '$codetovar', pereoceka = '$pereoceka'  WHERE id = $id ");
    echo "<meta http-equiv='Refresh' content='0; URL=../slichved.php'>";
    ?>



  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
