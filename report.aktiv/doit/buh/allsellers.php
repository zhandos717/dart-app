<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 7) :
    include "header.php";
    include "menu.php";

    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Список всех Продавцов

        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-md-6">
            <div class="box">
              <div class="box-header">
                <!--<h3 class="box-title">Продавцы магазинов</h3>-->

              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>ФИО продавца</th>
                    <th>Регион</th>
                    <th>Магазин</th>
                  </tr>
                  <?
                  $result = mysqli_query($connect, " SELECT *from saler ");

                  while ($data = mysqli_fetch_array($result)) { ?>
                    <tr>
                      <td>*</td>
                      <td><a href="updsaler.php?id=<?= $data['id']; ?>"><?= $data['fiosaler']; ?></a></td>
                      <td><?= $data['region']; ?></td>
                      <td><?= $data['shop']; ?></td>
                    </tr>
                  <? } ?>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->


          </div><!-- /.col -->

      </section>

    </div><!-- /.content-wrapper -->

    <? include "footer.php"; ?>

  <?php endif; ?>
<? else :

  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
