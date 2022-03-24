<? //проверка существовании сессии			
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
?>

    <?
    $region = $_GET['region'];
    echo $region;
    ?>



    <div align="center"><a href="../../logout.php">
        <h2>Выход</h2>
      </a></div>



  <?php endif; ?>






<? else : ?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>