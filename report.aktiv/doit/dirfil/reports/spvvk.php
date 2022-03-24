<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 1) :

    $date1 = $_POST['date1'];

?>


    <?= $date1; ?>


  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>