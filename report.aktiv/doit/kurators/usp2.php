<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 9) :
?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $_SESSION['logged_user']->fio; ?> - <?= $region; ?> / <?= $_SESSION['logged_user']->adress; ?>

        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регион - <?= $region; ?></a></li>
          <li class="active"><?= $_SESSION['logged_user']->adress; ?></li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <!-- Horizontal Form -->

            <h1>Отчет успешно отправлен!!!</h1>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </section><!-- /.content -->




    </div><!-- /.content-wrapper -->


    <? include "footer.php"; ?>

  <?php endif; ?>

<? else : ?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>