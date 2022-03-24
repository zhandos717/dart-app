<? //проверка существовании сессии			
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
?>

    <?

    $id = (int) $_GET["id"];
    $id = strip_tags($_GET['id']);
    $id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES);


    $result = mysqli_query($connect, "DELETE FROM reports WHERE id = $id ");

    echo "<meta http-equiv='Refresh' content='0; URL=look.php?id=$id>";
    ?>



  <?php endif; ?>
<? else : ?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>