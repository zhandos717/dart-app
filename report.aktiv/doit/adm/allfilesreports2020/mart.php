<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
    $active_lombard = 'active';
    $active_report = 'active';



    $result2 = mysqli_query($connect, " SELECT id, region, SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                        SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports032020  ");
    $data2 = mysqli_fetch_array($result2);

    $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
    $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов





    $result = mysqli_query($connect, " SELECT id, region, SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                    from reports032020  GROUP BY region  ");
    $ss = 0;
    $ss2 = 0;
    $ss3 = 0;
    while ($data1 = mysqli_fetch_array($result)) {

      $region =  $data1['region'];

      $result4 = mysqli_query($connect, "SELECT *FROM reports032020 WHERE region='$region' GROUP BY adress ");


      $s = 0;
      $s2 = 0;
      $s3 = 0;

      while ($data4 = mysqli_fetch_array($result4)) {
        $filial =  $data4['adress'];
        $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports032020 WHERE reg_date=(SELECT MAX(reg_date) FROM reports032020 WHERE region = '$region' AND adress = '$filial' ) ");
        $data5 = mysqli_fetch_array($result5);



        $s += $data5['auktech'];
        $s2 += $data5['aukshubs'];
        $s3 += $data5['nalvzaloge'];
      }

      $ss += $s;   //аукц т
      $ss2 += $s2; //ауц шубы
      $ss3 += $s3;  //нал в залоге

    }



?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет за МАРТ 2020
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
                <h3><?= number_format($chistaya, 0, '.', ' '); ?> тг</h3>
                <p>ЧИСТАЯ ПРИБЫЛЬ</p>
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
                <h3><?= number_format($ss, 0, '.', ' ');; ?> тг</h3>
                <p>Аукционист техника</p>
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
                <h3><?= number_format($ss2, 0, '.', ' ');; ?> тг</h3>
                <p>Аукционист Шуба</p>
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
                <h3><?= number_format($ss3, 0, '.', ' ');; ?> тг</h3>
                <p>Нал в залоге</p>
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
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th style="width: 10px">id</th>
                        <th>РЕГИОНЫ</th>
                        <th>ДОХОДЫ</th>
                        <th>СТАБ.РАСХОДЫ</th>
                        <th>ТЕК.РАСХОДЫ</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>ЧИСТАЯ ПРИБЫЛЬ (-20%)</th>
                        <th>ВСЕ КЛИЕНТЫ</th>
                        <th>НОВЫЕ КЛИЕНТЫ</th>
                        <th>ЧИСТАЯ ВЫДАЧА</th>
                        <th>АУКЦИОНИСТ ТЕХНИКА</th>
                        <th>АУКЦИОНИСТ ШУБА</th>
                        <th>НАЛ В ЗАЛОГЕ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, " SELECT id, region, SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                   from reports032020  GROUP BY region  ");
                      $ss = 0;
                      $ss2 = 0;
                      $ss3 = 0;
                      while ($data1 = mysqli_fetch_array($result)) {

                        $region =  $data1['region'];

                      ?>
                        <tr>
                          <td>*</td>
                          <td><a href="viewreportregion03.php?region=<?= $data1['region']; ?>"><?= $data1['region']; ?></a></td>
                          <td>
                            <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                          </td>
                          <td><?= number_format($data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td>
                          <?
                          $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)']; //прибыль = доход - стабиль расх - тек расх
                          $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                          ?>
                          <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td>
                          <td><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                          <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>



                          <?
                          $result4 = mysqli_query($connect, "SELECT *FROM reports032020 WHERE region='$region' GROUP BY adress ");


                          $s = 0;
                          $s2 = 0;
                          $s3 = 0;

                          while ($data4 = mysqli_fetch_array($result4)) {
                            $filial =  $data4['adress'];
                            $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports032020 WHERE reg_date=(SELECT MAX(reg_date) FROM reports032020 WHERE region = '$region' AND adress = '$filial' ) ");
                            $data5 = mysqli_fetch_array($result5);



                            $s += $data5['auktech'];
                            $s2 += $data5['aukshubs'];
                            $s3 += $data5['nalvzaloge'];
                          }

                          $ss += $s;
                          $ss2 += $s2;
                          $ss3 += $s3;
                          ?>


                          <td><?= number_format($s, 0, '.', ' ');; ?></td>
                          <td><?= number_format($s2, 0, '.', ' ');; ?></td>
                          <td><?= number_format($s3, 0, '.', ' ');; ?></td>


                        </tr>
                      <? } ?>


                    </tbody>
                    <tfoot>
                      <?
                      $result2 = mysqli_query($connect, " SELECT id, region, SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports032020  ");

                      $data2 = mysqli_fetch_array($result2);


                      ?>
                      <tr style="background: #d3d7df; color: black;">
                        <th></th>
                        <th>Итого (СУММА)</th>
                        <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
                        <?
                        $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
                        $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                        ?>
                        <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td>
                        <td><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                        <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
                        <th style="background: #00a759; color: white;"><?= number_format($ss, 0, '.', ' '); ?></th>
                        <th style="background: #f39d0a; color: white;"><?= number_format($ss2, 0, '.', ' '); ?></th>
                        <th style="background: #de4936; color: white;"><?= number_format($ss3, 0, '.', ' '); ?></th>
















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
