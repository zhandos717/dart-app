<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 5) :
  include "header.php";
  $active_report = 'active';
  include "menu.php";
  $month = $_GET['month'];
  $year = $_GET['year'];
  $month_start = date("Y-$month-01");
  $month_end = date("Y-$month-31");

  $date = new DateTime($month_start);
  $date->modify('last day of this month');
  $last_day = $date->format('d');
  $month = $date->format('m');


  function calculate_percentage($price, $sale)
  {
    return round((($price - $sale) * 100) / $price, 2);
  }
  $result = R::getAll("SELECT  data,SUM(summaprihod), SUM(predoplata), SUM(summareal), SUM(pribl), SUM(summazaden), COUNT(*)
FROM sales 
WHERE region='$region' 
AND adress='$adress' 
AND statustovar  IS NULL 
AND data BETWEEN '$month_start' AND  '$month_end'
GROUP BY data ");
  include_once 'functions/notification.php';
  $plan = R::findOne('magplan', "month = '$month' AND region ='$region' AND adress = '$adress'");
  $planden = $plan['plan'] / $last_day;
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $region; ?>/<?= $adress; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная <?= $month_start; ?> <?= $month_end ?> </a></li>
        <li><a href="index.php"><?= $region; ?></a></li>
        <li class="active"><?= $adress; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <? if (!empty($res)) { ?>
        <!-- если товары есть показываем их  -->
        <div class="row">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h4>У вас
                  <?= $res['count']; ?> ед. товара находятся более 10 дней на реализации
                </h4>
                <h3>На общую сумму <?= number_format($res['SUM(cena_pr)'], 0, '.', ' '); ?> тг</h3>
              </div>
              <div class="icon">
                <i class="fa fa-warning"></i>
              </div>
              <a href="a_report.php?id=7" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      <? } ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Отчет </h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example" class="table table-bordered table-hover">

                  <thead>
                    <tr style="background: #398ebd; color: white;">
                      <th rowspan="2">ДАТА</th>
                      <th rowspan="2">Общая сумма прихода</th>
                      <th rowspan="2">ПРЕДОПЛАТА</th>
                      <th rowspan="2">Общ.сумма реализации</th>
                      <th rowspan="2">ПРИБЫЛЬ</th>
                      <th rowspan="2">Приход товара за день</th>
                      <th rowspan="2">Количество проданных товаров</th>
                      <th style="white-space:nowrap;" colspan="2" class="text-center">ПЛАН: <?= number_format($plan['plan'], 0, '.', ' '); ?> тг.</th>
                    </tr>
                    <tr class="info">
                      <th class="text-center">В день</th>
                      <th class="text-center">%</th>
                    </tr>
                  </thead>
                  <tbody>
                    <? $i = 1;
                    foreach ($result as $data1) {
                      $sc += $data1['COUNT(*)'];
                      $procent = calculate_percentage($data1['SUM(pribl)'], $planden);
                    ?>
                      <tr>
                        <td><a href="detali.php?data=<?= $data1['data']; ?>"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
                        <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' ');
                            $summaprihod += $data1['SUM(summaprihod)']; ?></td>
                        <td><?= number_format($data1['SUM(predoplata)'], 0, '.', ' ');
                            $predoplata += $data1['SUM(predoplata)']; ?></td>
                        <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' ');
                            $summareal += $data1['SUM(summareal)'];  ?></td>
                        <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' ');
                            $pribl += $data1['SUM(pribl)'];  ?></td>
                        <td><?= number_format($data1['SUM(summazaden)'], 0, '.', ' '); ?></td>
                        <td><?= $data1['COUNT(*)']; ?></td>
                        <td class="text-center">
                          <?= number_format($planden, 0, '.', ' ');
                          $plan += $planden; ?>
                        </td>
                        <td class="text-center">
                          <? if ($procent > 0) { ?>
                            <a title="<?= number_format(round($data1['SUM(pribl)']), 0, '.', ' '); ?>-<?= number_format(round($planden1), 0, '.', ' ') ?>=<?= number_format(round($procent2), 0, '.', ' ') ?>" class="description-percentage text-green">
                              <i class="fa fa-caret-up"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                          <? } elseif ($procent < 0) { ?>
                            <a title="<?= number_format(round($data1['SUM(pribl)']), 0, '.', ' '); ?>-<?= number_format(round($planden1), 0, '.', ' ') ?>=<?= number_format(round($procent2), 0, '.', ' ') ?>" class="description-percentage text-danger">
                              <i class="fa fa-caret-down"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                          <? }; ?>
                        </td>
                      </tr>
                    <? } ?>
                  </tbody>
                  <tfoot>
                    <tr class='info'>
                      <th>Итого</th>
                      <th><?= number_format($summaprihod, 0, '.', ' '); ?></th>
                      <th><?= number_format($predoplata, 0, '.', ' '); ?></th>
                      <th><?= number_format($summareal, 0, '.', ' '); ?></th>
                      <th><?= number_format($pribl, 0, '.', ' '); ?></th>
                      <th><?= number_format($summazaden, 0, '.', ' '); ?></th>
                      <th><?= $sc; ?></th>
                      <th><?= number_format($plan, 0, '.', ' '); ?></th>
                      <th>
                        <?
                        $procent =  (($pribl - $plan) * 100) / $pribl; //($plan*$pribl)*100;

                        $res = $pribl - $plan;
                        if ($procent > 0) { ?>
                          <a title="<?= number_format(round($pribl), 0, '.', ' '); ?>-<?= number_format(round($plan), 0, '.', ' ') ?>=<?= number_format(round($res), 0, '.', ' ') ?>" class="description-percentage text-green">
                            <i class="fa fa-caret-up"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                        <? } elseif ($procent < 0) { ?>
                          <a title="<?= number_format(round($pribl), 0, '.', ' '); ?>-<?= number_format(round($plan), 0, '.', ' ') ?>=<?= number_format(round($res), 0, '.', ' ') ?>" class="description-percentage text-danger">
                            <i class="fa fa-caret-down"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                        <? }; ?>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
    </section>
  </div><!-- /.content-wrapper -->
<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>