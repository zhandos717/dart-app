<? //проверка существовании сессии
include("../../bd.php");
$region = $_GET['region'];
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 9) :


    //$adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;

?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>


    <?
    $region = $_SESSION['logged_user']->region;
    $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                        SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports072020 WHERE `region`='$region'  ");
    $data2 = mysqli_fetch_array($result2);
    $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх

    $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов


    $result4 = mysqli_query($connect, "SELECT *FROM reports072020 WHERE region='$region' GROUP BY adress ");
    $ss = 0;
    $ss2 = 0;
    $ss3 = 0;
    while ($data4 = mysqli_fetch_array($result4)) {
      $filial =  $data4['adress'];
      $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports072020 WHERE segdata=(SELECT MAX(segdata) FROM reports072020 WHERE region = '$region' AND adress = '$filial' ) ");
      $data5 = mysqli_fetch_array($result5);




      //echo " * ".$data5['auktech']." * ";

      $ss += $data5['auktech'];
      $ss2 += $data5['aukshubs'];
      $ss3 += $data5['nalvzaloge'];
    }





    ?>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет ломбарда за Июль 2020, по региону - <b><?= $region; ?></b>
          <small><a href="index.php">назад к списку</a></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>

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
                <p>АУКЦИОНИСТ ТЕХНИКА</p>
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
                <p>АУКЦИОНИСТ ШУБА</p>
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
                <p>НАЛИЧНЫЕ В ЗАЛОГЕ</p>
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
              <div class="box-header">
                <h3 class="box-title">Филиалы <?= $region; ?></h3>
              </div><!-- /.box-header -->
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
                        <th>Адрес филиала</th>
                        <th>Доход ломбард</th>
                        <th>Доход магазин</th>
                        <th>Доп доход</th>
                        <th>Доходы</th>
                        <th>Стаб расходы</th>
                        <th>Текущие расходы</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Чистая прибыль (-20%)</th>
                        <th>Все клиенты</th>
                        <th>Новые клиенты</th>
                        <th>Чистая выдача</th>
                        <th>Аукционист техника</th>
                        <th>Аукционист шубы</th>
                        <th>Нал в залоге</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?





                      $result = mysqli_query($connect, "SELECT adress,id, region, SUM(dl),SUM(dm),SUM(dop), SUM(stabrashod), SUM(dohod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        FROM reports072020 WHERE `region`='$region' GROUP BY `adress` ");

                      while ($data1 = mysqli_fetch_array($result)) {


                        $filial =  $data1['adress'];

                      ?>


                        <tr>
                          <td>


                            <form action="viewfilial07.php" method="post">
                              <input type="text" name="region" value="<?= $region; ?>" hidden="" />
                              <input type="text" name="adress" value="<?= $data1['adress']; ?>" hidden="" />
                              <input type="submit" name="gogo" value="<?= $data1['adress']; ?>" />
                            </form>

                          </td>
                          <td><?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td>

                          <?
                          $pribl = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                          $pr20 = ($pribl * 20) / 100;
                          $chistpribl = $pribl - $pr20;

                          ?>

                          <td><?= number_format($pribl, 0, '.', ' '); ?></td>
                          <td><strong><?= number_format($chistpribl, 0, '.', ' '); ?></strong></td>
                          <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>



                          <?
                          $result3 = mysqli_query($connect, " SELECT * FROM reports072020 WHERE segdata=(SELECT MAX(segdata) FROM reports072020 WHERE region = '$region' AND adress = '$filial' ) ");
                          $data12 = mysqli_fetch_array($result3);
                          ?>


                          <td><?= number_format($data12['auktech'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data12['aukshubs'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data12['nalvzaloge'], 0, '.', ' '); ?></td>

                        </tr>
                      <? } ?>



                    </tbody>

                    <tfoot>
                      <tr style="background: #d3d7df; color: black;">
                        <?
                        $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        from reports072020 WHERE region = '$region' ");

                        $data2 = mysqli_fetch_array($result2);
                        ?>
                        <th>Итого</th>
                        <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>

                        <?
                        $summapribl = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];
                        $pr20 = ($summapribl * 20) / 100;
                        $summachistpribl = $summapribl - $pr20;

                        ?>

                        <th><?= number_format($summapribl, 0, '.', ' '); ?></th>
                        <th style="background: #00c2f0; color: black;"><?= number_format($summachistpribl, 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>

                        <?
                        $result4 = mysqli_query($connect, "SELECT *FROM reports072020 WHERE region='$region' GROUP BY adress ");
                        $s = 0;
                        $s2 = 0;
                        $s3 = 0;
                        while ($data4 = mysqli_fetch_array($result4)) {
                          $filial =  $data4['adress'];
                          $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports072020 WHERE segdata=(SELECT MAX(segdata) FROM reports072020 WHERE region = '$region' AND adress = '$filial' ) ");
                          $data5 = mysqli_fetch_array($result5);




                          //echo " * ".$data5['auktech']." * ";

                          $s += $data5['auktech'];
                          $s2 += $data5['aukshubs'];
                          $s3 += $data5['nalvzaloge'];
                        }

                        ?>
                        <th style="background: #00a759; color: black;"><?= number_format($s, 0, '.', ' '); ?></th>
                        <th style="background: #f39d0a; color: black;"><?= number_format($s2, 0, '.', ' '); ?></th>
                        <th style="background: #de4936; color: black;"><?= number_format($s3, 0, '.', ' '); ?></th>

                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
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
