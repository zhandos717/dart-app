<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 2) :
    $active_lombard = 'active';
    $adress = $_GET['adress'];
    include "header.php"; 
    include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $region; ?>/<?= $adress; ?>
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
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Отчет за Декабрь 2020</h3>
              </div><!-- /.box-header -->
              <div class="box-body">

                <div class="table-responsive">
                  <table id="example" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white; white-space:nowrap;">
             
                        <th>Дата</th>
                        <th>Доход ломбард</th>
                        <th>Доход магазин</th>
                        <th>ДОХОД КОМИССИОНКИ</th>
                        <th>Доп доход</th>
                        <th>Доход</th>
                        <th>Стабильные расходы</th>
                        <th>Текущие расходы</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Чистая прибыль (-20%)</th>
                        <th>ЕЖЕДНЕВНЫЙ ПЛАН</th>
                        <th>% Выполнения <br> плана</th>
                        <th>% + - </th>
                        <th>Все клиенты</th>
                        <th>Новые клиенты</th>
                        <th>Выдача за сутки</th>
                        <!--  <th>Возврат</th>
                        <th>Накладные</th> -->
                        <th>Чистая выдача</th>
                        <th>Аукционист техника</th>
                        <th>Аукционист шубы</th>
                        <th>Нал в залоге</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?

                      $result = mysqli_query($connect, "SELECT *FROM reports WHERE `region`='$region' AND `adress`='$adress' ORDER BY data ");

                      $resultpl = mysqli_query($connect, "SELECT *FROM planlombard WHERE `region`='$region' AND `adress`='$adress'");
                      $datapl = mysqli_fetch_array($resultpl);
                      $planden = $datapl['plan']/30;    //еждневный план = Ежемесячный план деленная на 30 дней

                      $summaplanvden = 0; $summaprocent = 0; $kolvozap = 0; $q = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $summaplanvden = $summaplanvden + $planden;   //сумма плана в день
                        $procent = ($data1['dohod']*100)/$planden;                // процент выполнения плана
                        $summaprocent = $summaprocent + $procent;   //общая сумма процентов выполнения плана

                        $kolvozap = $kolvozap +1;
                        $sredsummapr = $summaprocent/$kolvozap;  // средняя сумма процента

                        $pm =  $procent - 100;  // +- на сколько отстает от плана или перевыполняет



                        ?>

                        <tr style="white-space:nowrap;">
                     
                          <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                          <td><?= number_format($data1['dl'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dm'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dk'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dop'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dohod'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['stabrashod'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['tekrashod'], 0, '.', ' '); ?>

                            <?
                            if (strlen($data1['comment']) != 0) echo '<font style="color:red">+</font>';

                            ?>



                          </td>

                          <?
                          $pribl = $data1['dohod'] - $data1['stabrashod'] - $data1['tekrashod'];
                          $pr20 = ($pribl * 20) / 100;
                          $chistpribl = $pribl - $pr20;

                          ?>

                          <td><strong><?= number_format($pribl, 0, '.', ' '); ?></strong></td>
                          <td><strong><?= number_format($chistpribl, 0, '.', ' '); ?></strong></td>
                          <td><?= number_format($planden, 0, '.', ' '); ?></td>
                          <td><?= number_format($procent, 0, '.', ' '); ?> %</td>
                          <td><b><font size="2" color="red" face="Arial"><?= number_format($pm, 0, '.', ' '); ?> %</font></b></td>
                          <td><?= number_format($data1['allclients'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['newclients'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['vzs'], 0, '.', ' '); ?></td>
                          <!--   <td><?= number_format($data1['vozvrat'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['nakladnoy'], 0, '.', ' '); ?></td>-->
                          <td><?= number_format($data1['chv'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['auktech'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['aukshubs'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['nalvzaloge'], 0, '.', ' '); ?></td>
                        </tr>
                      <? } ?>

                    </tbody>
                    <tfoot>
                      <tr style="background: #398ebd; color: white;">
                        <?
                        $result2 = mysqli_query($connect, " SELECT id, region, auktech, SUM(dl),SUM(dk) ,SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        from reports WHERE region = '$region'  AND adress ='$adress' ");
                        $data2 = mysqli_fetch_array($result2);
                        ?>
                        <th>Итого</th>
                        <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dk)'], 0, '.', ' '); ?></th>
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
                        <th><?= number_format($summachistpribl, 0, '.', ' '); ?></th>
                        <th><?= number_format($summaplanvden, 0, '.', ' '); ?></th>
                        <th><b><?= number_format($sredsummapr, 0, '.', ' '); ?> %</b></th>
                        <th></th>
                        <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(vzs)'], 0, '.', ' '); ?></th>
                        <!--  <th><?= number_format($data2['SUM(vozvrat)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(nakladnoy)'], 0, '.', ' '); ?></th>-->
                        <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
                        <th>
                          <?
                          $result3 = mysqli_query($connect, " SELECT * FROM reports WHERE segdata=(SELECT MAX(segdata) FROM reports WHERE region ='$region'  AND adress ='$adress') ");
                          $data3 = mysqli_fetch_array($result3);
                          ?>
                          <?= number_format($data3['auktech'], 0, '.', ' '); ?>
                        </th>
                        <th><?= number_format($data3['aukshubs'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data3['nalvzaloge'], 0, '.', ' '); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
      </section>
      </div>
    </div><!-- /.row -->
    </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<? include "footer.php"; 
else :
header('Location: ../../index.php');
endif; ?>
