<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 13) :
    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region; ?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Сличительная ведомость
          <small><a href="index.php">назад к списку</a></small>
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
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"></h3>
              </div><!-- /.box-header -->

              <style>
                .layer {
                  overflow-x: scroll;
                  /* Добавляем полосу прокрутки */
                  width: 100%;
                  /* Ширина блока */
                  height: 100%;
                  /* Высота блока */
                  padding: 5px;
                  /* Поля вокруг текста */
                  //  border: solid 1px black; /* Параметры рамки */
                  white-space: nowrap;
                  /* Запрещаем перенос строк */
                }
              </style>

              <div class="box-body">
                <div class="layer">

                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th>Дата</th>
                        <th>Город</th>
                        <th>Адрес</th>
                        <th>Код товара</th>
                        <th>Сумма переоценки</th>
                        <th>Комментарий</th>
                        <th>Документ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT * FROM kosyak  ORDER BY id DESC ");
                      while ($data = mysqli_fetch_array($result))
                      { ?>

                        <tr>
                          <td><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                          <td><?= $data['region']; ?></td>
                          <td><?= $data['adress']; ?></td>
                          <td><?= $data['codetovar']; ?></td>
                          <td><b><?= number_format($data['pereoceka'], 0, '.', ' '); ?></b></td>
                          <td><?= $data['comment']; ?></td>
                          <td><a href="/report/doit/kurators/<?= $data['photo']; ?>" target="_blank">Просмотр</a></td>

                        </tr>
                      <? } ?>

                    </tbody>
                    <tfoot>
                      <?
                      $result2 = mysqli_query($connect, " SELECT SUM(pereoceka) from kosyak  ");
                      $data2 = mysqli_fetch_array($result2);
                      ?>

                      <tr style="background: #d3d7df; color: black;">

                        <th colspan="4">Итого (СУММА ПЕРЕОЦЕНКИ)</th>
                        <th><em><b><font size="3" color="red" face="Arial"><?= number_format($data2['SUM(pereoceka)'], 0, '.', ' '); ?></font></b></em></th>
                        <th colspan="2"></th>
                      </tr>

                    </tfoot>

                  </table>

                </div>

              </div><!-- /.box-body -->
            </div><!-- /.box -->


          </div><!-- /.col -->

      </section>

    </div><!-- /.content-wrapper -->


    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->


    <? include "footer.php"; ?>

  <?php endif; ?>

<? else : ?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
