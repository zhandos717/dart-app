<?php

include __DIR__ . "/../../bd.php";
if ($status == 3) :
include "header.php";
include "menu.php";

  $data_begin = '2021-12-01'; //Дата начало
  $data_end   = '2021-12-31'; //Дата конец

  $table = 'reports122021';
  function percent($number, $percent)
  {
    return $number - ($number / 100 * $percent);
  }

  function post($param)
  {
    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
      CURLOPT_URL => 'https://report.commission2.kz/doit/api/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => http_build_query($param)
    ));
    $response = json_decode(curl_exec($myCurl), true);
    curl_close($myCurl);
    return $response;
  };

  $day = '2022-01-04';
  $data_begin = '2021-12-01'; //Дата начало
  $data_end   = '2021-12-31'; //Дата конец

  $region = ['Атырау', 'Актобе', 'Актау', 'Шымкент', 'Алматы', 'Талдыкорган', 'Уральск', 'Семей', 'Тараз', 'Кызылорда', 'Туркестан'];
  foreach ($region as $key => $value) {
    $array = [
      'token' => 'qfq5441fa65f4654w',
      'region' => $value,
      'start' => $data_begin,
      'end' => $data_end,
    ];

    $month =  12; // Месяц
    $arr = post($array);
    $test = R::findOne('comision2region', 'region=? AND data =? AND month =?', [$arr['region'], $day, $month]);
    if (empty($test)) {
      $test = R::dispense('comision2region');
    };
    $test->region         = $value;
    $test->summa_vydachy  = $arr['summa_vydachy'];
    $test->comis          = $arr['comis'];
    $test->count          = $arr['count'];
    $test->proc           = $arr['proc'];
    $test->tehnica        = $arr['tehnica'];
    $test->vozvrat        = $arr['vozvrat'];
    $test->shuby          = $arr['shuby'];
    $test->nal            = $arr['nal'];
    $test->sale           = $arr['sale'];
    $test->cena_pr        = $arr['cena_pr'];
    $test->dop            = $arr['dop'];
    $test->month          = $month;
    $test->sales          = $arr['sales'];
    $test->data           = $day;
    $test->purchaseamount = $arr['purchaseamount'];
    $test->price          = $arr['price'];
    R::store($test);
  }


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Отчет за декабрь 2021
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
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><b> TBS </b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabletools2" style="white-space:nowrap;">
                  <thead>
                    <tr class="bg-blue">
                      <th rowspan="2">РЕГИОНЫ</th>
                      <th rowspan="2">КОМИССИОНКА</th>
                      <th colspan="5" class="text-center">МАГАЗИН доход</th>
                      <!-- <th>ДОП <br> ДОХОДЫ</th> -->
                      <!-- <th rowspan="2">ДОХОДЫ</th> -->
                      <!-- <th>РАСХОДЫ</th> -->
                      <th rowspan="2">РАСХОД</th>
                      <th rowspan="2">ПРИБЫЛЬ</th>

                      <th rowspan="2">ПРИБЫЛЬ-3 % </th>
                      <!-- ЧИСТАЯ -->
                      <th rowspan="2">ВСЕ <br> КЛИЕНТЫ</th>
                      <!-- <th>НОВЫЕ <br> КЛИЕНТЫ</th> -->
                      <th rowspan="2">АУКЦИОНИСТ <br> ТЕХНИКА</th>
                      <th rowspan="2">АУКЦИОНИСТ <br> ШУБА</th>
                      <th rowspan="2">АУКЦИОНИСТ <br> В ОЖИДАНИИ</th>
                      <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                    </tr>
                    <tr>
                      <td class="info">
                        По факту кол-во.
                      </td>
                      <td class="info">
                        По факту СУММ.
                      </td>
                      <td class="info">
                        Аксессуары
                      </td>
                      <td class="bg-red">
                        ОТЧЕТ магазина
                      </td>
                      <td class="bg-red">
                        По списку кол-во.
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? $result1 = R::findAll('comision2region', "data = ? AND region IS NOT NULL GROUP BY region", [$day]); //(region = 'Талдыкорган' OR region = 'Уральск' OR region = 'Атырау')
                    foreach ($result1 as $data2) {
                      $region = $data2['region'];
                      $sales_tbs = R::getAll("SELECT SUM(pribl),COUNT(*) ,SUM(remainder), SUM(summaprihod) FROM sales WHERE regionlombard = '$region' AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'  AND statustovar IS NULL   ");
                      $sale_tbs = $sales_tbs[0];

                      $ras = R::getCol("SELECT SUM(tekrashod) FROM comisstest WHERE region=? AND data BETWEEN '$data_begin' AND '$data_end' ", [$data2['region']]);
                      $ras = $ras[0];
                    ?>
                      <tr>
                        <td><a class="btn btn-block bg-olive"><?= $data2['region']; ?></a></td>
                        <td>
                          <?= number_format($data2['comis'] + $data2['proc'], 0, '.', ' ');
                          $dohod1 += $data2['comis'] + $data2['proc']; ?>
                        </td>

                        <td>
                          <?= $data2['sales'];
                          $count_sales += $data2['sales']; ?>
                        </td>
                        <td>
                          <?= number_format(($data2['cena_pr'] - $data2['sale']) + $data2['profit'], 0, '.', ' ');
                          $dohodm1 += ($data2['cena_pr'] - $data2['sale']) + $data2['profit']; ?>
                        </td>
                        <td>
                          <?= number_format($data2['price'] - $data2['purchaseamount'], 0, '.', ' ');
                          $accses_tbs += ($data2['price'] - $data2['purchaseamount']);  ?>
                        </td>

                        <td class="danger"><?= number_format($sale_tbs['SUM(remainder)'] - $sale_tbs['SUM(summaprihod)'], 0, '.', ' ');
                                            $dohodml_tbs += $sale_tbs['SUM(remainder)'] - $sale_tbs['SUM(summaprihod)']; ?></td>
                        <td class="danger"><?= $sale_tbs['COUNT(*)'];
                                            $countml_tbs += $sale_tbs['COUNT(*)']; ?></td>

                        <th>
                          <?= number_format($ras, 0, '.', ' ');
                          $ras_total += $ras; ?></th>

                        <!-- Аксесуары -->
                        <? $chistaya1 = ($data2['comis'] + $data2['proc'] + ($data2['cena_pr'] - $data2['sale']) + $data2['profit'] + ($data2['price'] - $data2['purchaseamount'])) - $ras;
                        $tbs_chistaya = percent($chistaya1, 3);
                        ?>
                        <th>
                          <?= number_format($chistaya1, 0, '.', ' ');

                          ?></th>
                        <th class="info"> <?= number_format($tbs_chistaya, 0, '.', ' ');
                                          $total_tbs_ch += $tbs_chistaya; ?> </th>
                        <td>
                          <?= number_format($data2['count'], 0, '.', ' ');
                          $count1 += $data2['count']; ?>
                        </td>
                        <td class="success">
                          <? echo number_format($data2['tehnica'], 0, '.', ' ');
                          $summa_vydachy1 += $data2['tehnica']; ?>
                        </td>
                        <td class="warning">
                          <? echo number_format($data2['shuby'], 0, '.', ' ');
                          $summa_vydachy21 += $data2['shuby']; ?>
                        </td>
                        <td title="<?= 'В магазине: ' . number_format($sale1['SUM(summaprihod)'], 0, '.', ' ') . '- По базе: ' . number_format($data2['sale'], 0, '.', ' ')  ?>"> <?= number_format($sale1['SUM(summaprihod)'] - $data2['sale'], 0, '.', ' ');
                                                                                                                                                                                  $auct_tbs += $sale1['SUM(summaprihod)'] - $data2['sale']; ?></td>
                        <td class="danger">
                          <? echo number_format($data2['nal'], 0, '.', ' ');
                          $summa_vydachy31 += $data2['nal'];
                          ?>
                        </td>
                      </tr>
                    <? }; ?>
                  </tbody>
                  <tfoot>
                    <tr style="background: #d3d7df; color: black;">
                      <th>Итого (СУММА)</th>
                      <th><?= number_format($dohod1, 0, '.', ' '); ?></th>
                      <th><?= $count_sales; ?></th>
                      <th><?= number_format($dohodm1, 0, '.', ' '); ?></th>

                      <td>
                        <?= number_format($accses_tbs, 0, '.', ' '); ?>
                      </td>
                      <th class="bg-red"><?= number_format($dohodml_tbs, 0, '.', ' '); ?></th>
                      <th class="bg-red"><?= number_format($countml_tbs, 0, '.', ' '); ?></th>
                      <th><?= number_format($ras_total, 0, '.', ' '); ?></th>
                      <th><?= number_format(($dohodm1 + $dohod1 + $accses_tbs) - $ras_total, 0, '.', ' '); ?></th>

                      <th class="bg-blue"><?= number_format($total_tbs_ch, 0, '.', ' '); ?></th>
                      <th><?= number_format($count1, 0, '.', ' '); ?></th>
                      <th><?= number_format($summa_vydachy1, 0, '.', ' '); ?></th>
                      <th><?= number_format($summa_vydachy21, 0, '.', ' '); ?></th>
                      <td><?= number_format($auct_tbs, 0, '.', ' '); ?> </td>
                      <th><?= number_format($summa_vydachy31, 0, '.', ' '); ?></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->

    </section>
  </div>
<?
  include "footer.php";
  endif; ?>