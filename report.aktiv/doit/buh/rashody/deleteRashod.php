<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 10) :
?>

    <?

    $id = (int) $_POST["id"];
    $id = strip_tags($_POST['id']);
    $id = htmlentities($_POST['id'], ENT_QUOTES, "UTF-8");
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES);




    $result = mysqli_query($connect, "DELETE FROM rashodfillial WHERE id = $id ");


    echo "<meta http-equiv='Refresh' content='0; URL=../fordelRashod.php'>";
    ?>



  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
