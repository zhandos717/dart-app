<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 11) :
      $active = 'active';
?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <? include "commis/index.php"; ?>
    <? include "footer.php"; ?>

  <?php endif; ?>

<? else : ?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
