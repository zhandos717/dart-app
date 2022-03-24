<?php
include("../../bd.php");

if ($_SESSION['logged_user']->status != 1) header('Location: /');

$month = intval($_GET['month']);

if (is_int($month)) {

  if ($month == 2) {
    $table = 'reports';
  } else {
    if (strlen($month) == 1)
      $table = 'reports0' . $month . '2022';
    else if (strlen($month) == 2)
      $table = 'reports' . $month . '2022';
  }
}


$result = R::getAll("SELECT * FROM $table WHERE `region`='$region' AND `adress`='$adress' ORDER BY data ");


$active1 = 'active';
$resultpl = mysqli_query($connect, "SELECT *FROM planlombard WHERE `region`='$region' AND `adress`='$adress'");
$datapl = mysqli_fetch_array($resultpl);
$planden = $datapl['plan'] / 30;

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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Отчет </h3>
          </div><!-- /.box-header -->

          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr class="info text-center">
                    <th>№</th>
                    <th>Дата</th>
                    <th>Доход ломбард</th>
                    <th>Доход магазин</th>
                    <!-- <th>Доход комиссионки</th> -->
                    <th>Доп доход</th>
                    <th>Доход</th>
                    <th>Расходы</th>
                    <th>ПРИБЫЛЬ</th>
                    <th>ЕЖЕДНЕВНЫЙ <br> ПЛАН</th>
                    <th>% Выполнения <br> плана</th>
                    <th>% + - </th>
                    <th>Все клиенты</th>
                    <th>Новые клиенты</th>
                    <th>Выдача за сутки</th>
                    <th>Возврат</th>
                    <th>Накладные</th>
                    <th>Чистая выдача</th>
                    <th>Аукционист техника</th>
                    <th>Аукционист шубы</th>
                    <th>Нал в залоге</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $i = 1;
                  foreach ($result as $data1) {
                    $data = $data1['data'];

                    $consumption = R::getRow("SELECT SUM(summarf),comments 
                                              FROM `rashodfillial` 
                                              WHERE region = '$region' 
                                              AND adress = '$adress'
                                              AND datarashoda = '$data'");

                    $pr =  $data1['dohod'] - $consumption['SUM(summarf)']; //прибыль

                    $summaplanvden += $planden;   //сумма плана в день

                    $procent = ($data1['dohod'] * 100) / $planden;                // процент выполнения плана

                    $summaprocent  += $procent;   //общая сумма процентов выполнения плана
                    $kolvozap = $kolvozap + 1;
                    $sredsummapr = $summaprocent / $kolvozap;  // средняя сумма процента
                    $pm =  $procent - 100;  // +- на сколько отстает от плана или перевыполняет


                  ?>
                    <tr style="white-space:nowrap;">
                      <td>
                        <? if ($table == 'reports') { ?>
                          <a href="upd.php?id=<?= $data1['id']; ?>" class="btn btn-success fa fa-edit"></a>
                        <? } else { ?>
                          <?= $i++ ?>
                        <? } ?>
                      </td>
                      <td class="success"><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                      <td><?= number_format($data1['dl'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['dm'], 0, '.', ' '); ?></td>
                      <!-- <td><?= number_format($data1['dk'], 0, '.', ' '); ?></td> -->
                      <td><?= number_format($data1['dop'], 0, '.', ' '); ?></td>
                      <td class="text-red">
                        <?= number_format($data1['dohod'], 0, '.', ' '); ?>
                      </td>

                      <td title="<?= $consumption['comments']; ?>"><?= number_format($consumption['SUM(summarf)'], 0, '.', ' ');
                                                                    $total_consumption +=   $consumption['SUM(summarf)'] ?></td>
            

                      <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td>
                      <td><?= number_format($planden, 0, '.', ' '); ?></td>
                      <td><?= number_format($procent, 0, '.', ' '); ?> %</td>
                      <td class="text-red"><?= number_format($pm, 0, '.', ' '); ?> %</td>
                      <td><?= number_format($data1['allclients'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['newclients'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['vzs'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['vozvrat'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['nakladnoy'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['chv'], 0, '.', ' '); ?></td>
                      <td class="info"><?= number_format($data1['auktech'], 0, '.', ' '); ?></td>
                      <td class="warning"><?= number_format($data1['aukshubs'], 0, '.', ' '); ?></td>
                      <td class="danger"><?= number_format($data1['nalvzaloge'], 0, '.', ' '); ?></td>
                    </tr>
                  <? } ?>
                </tbody>
                <tfoot>
                  <tr class="bg-gray" style="white-space:nowrap;">
                    <?
                    $result2 = mysqli_query($connect, " SELECT id, region,SUM(dk), SUM(dl), SUM(dm), SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        from $table WHERE region = '$region'  AND adress ='$adress' ");
                    $data2 = mysqli_fetch_array($result2);
                    ?>
                    <th></th>
                    <th>Итого</th>
                    <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                    <!-- <th><?= number_format($data2['SUM(dk)'], 0, '.', ' '); ?></th> -->
                    <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($total_consumption, 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(dohod)'] - $summarashodov, 0, '.', ' '); ?></th>
                    <th><?= number_format($summaplanvden, 0, '.', ' '); ?></th>
                    <th class="text-red"><?= number_format($sredsummapr, 0, '.', ' '); ?> %</th>
                    <th></th>
                    <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(vzs)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(vozvrat)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(nakladnoy)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data1['auktech'], 0, '.', ' '); ?> </th>
                    <th><?= number_format($data1['aukshubs'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data1['nalvzaloge'], 0, '.', ' '); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
  </section>

</div>
<?php include "footer.php"; ?>