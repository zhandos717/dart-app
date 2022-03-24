<? //проверка существовании сессии
include("../../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
?>

    <?

    $id = (int) $_GET["id"];
    $id = strip_tags($_GET['id']);
    $id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES);

    $region = $_GET['region'];
    $adress = $_GET['adress'];


    $result = mysqli_query($connect, "DELETE FROM reports122020 WHERE id = $id ");


    echo "<meta http-equiv='Refresh' content='0; URL=../viewfilial12.php?region=$region&adress=$adress'>";
    ?>



  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
