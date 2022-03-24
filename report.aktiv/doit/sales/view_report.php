<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 5) :
  include "header.php";
  $report_2020 = 'active';
  include "menu.php";

  $table = htmlentities($_GET['t']);

  function calculate_percentage($price, $sale)
  {
    return round((($price - $sale) * 100) / $price, 2);
  }
  $result = R::getAll("SELECT  data,SUM(summaprihod), SUM(predoplata), SUM(summareal), SUM(pribl), SUM(summazaden), COUNT(*)
FROM $table 
WHERE region='$region' 
AND adress='$adress' 
AND statustovar  IS NULL 
GROUP BY data ");
  if (empty($result)) {
    $result = R::getAll("SELECT  data,SUM(summaprihod), SUM(predoplata), SUM(summareal), SUM(pribl), SUM(summazaden), COUNT(*)
FROM $table 
WHERE region='$region' 
AND adress='$adress' 
GROUP BY data ");
  }

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
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная </a></li>
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
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr class="info">
                      <th >ДАТА</th>
                      <th >Общая сумма прихода</th>
                      <th >ПРЕДОПЛАТА</th>
                      <th >Общ.сумма реализации</th>
                      <th >ПРИБЫЛЬ</th>
                      <th >Приход товара за день</th>
                      <th >Количество проданных товаров</th>
                    </tr>
                  </thead>
                  <tbody>
                    <? $i = 1;
                    foreach ($result as $data1) {
                      $sc += $data1['COUNT(*)'];
                      $procent = calculate_percentage($data1['SUM(pribl)'], $planden);
                    ?>
                      <tr>
                        <td><a href="detail.php?t=<?= $table; ?>&data=<?= $data1['data']; ?>"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
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