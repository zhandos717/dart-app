<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
    $active_mag = 'active';
    $result22 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summaprihod), SUM(pribl), SUM(summazaden) from sales06  ");
    $data22 = mysqli_fetch_array($result22);
    $aukminus = $data22['SUM(summareal)'] - $data22['SUM(summazaden)'];
?>


    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет МАГАЗИНОВ за ИЮНЬ 2020
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
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= number_format($data22['SUM(summareal)'], 0, '.', ' '); ?> тг</h3>
                <p>ВЫРУЧКА</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= number_format($data22['SUM(summaprihod)'], 0, '.', ' '); ?> тг</h3>
                <p>Приход.Сумма</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= number_format($data22['SUM(pribl)'], 0, '.', ' '); ?> тг</h3>
                <p>ПРИБЫЛЬ</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?= number_format($aukminus, 0, '.', ' '); ?> тг</h3>
                <p>АУКЦИОНИСТ +-</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->


        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <div class="box-body">
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
                <div class="layer">
                  <table  class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th style="width: 10px">id</th>
                        <th>МАГАЗИНЫ</th>
                        <th>ВЫРУЧКА</th>
                        <th>Приход.Сумма</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Количество <br /> проданных<br />товаров</p></th>
                        <th>ПРИБЫЛЬ %</th>
                        <th>АУКЦИОНИСТ +/-</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT COUNT(*), region, adress, SUM(summareal), SUM(summaprihod), SUM(pribl)
                                                        from sales06 GROUP BY adress ");

// COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,

                      $sc = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $sc = $sc + $data1['COUNT(*)'];

                      ?>

                        <tr>
                          <td><i class="fa fa-shopping-cart"></i></td>
                          <td><a href="viewshop06.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
                          <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></td>
                          <td><?= $data1['COUNT(*)']; ?></td>
                          <td><em><b><?= number_format(($data1['SUM(pribl)']*100)/$data1['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></td>
                        </tr>
                      <? } ?>


                    </tbody>
                    <tfoot>
                      <?
                      $result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summaprihod), SUM(pribl), SUM(summazaden) from sales06  ");
                      $data2 = mysqli_fetch_array($result2);

                      $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];



                      ?>
                      <tr style="background: #d3d7df; color: black;">
                        <th></th>

                        <th>Итого (СУММА)</th>
                        <th><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></th>
                        <th><?= $sc; ?></th>
                        <th></th>
                        <th style="background: #de4936; color: white;"><strong><?= number_format($aukminus, 0, '.', ' '); ?></strong></th>

                      </tr>

                    </tfoot>


                  </table>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer clearfix">

              </div>
            </div><!-- /.box -->


          </div><!-- /.col -->

        </div><!-- /.row -->

      </section><!-- /.content -->




    </div><!-- /.content-wrapper -->

    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
