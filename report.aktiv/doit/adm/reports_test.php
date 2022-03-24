<?php

include __DIR__ . '/../../bd.php';

if ($_SESSION['logged_user']->status != 3)  header('Location: ../../index.php');
  include "header.php";
  include "menu.php";
  
    function percent(int $number, int $percent)
    {
      $result = $number - ($number / 100 * $percent);
      return ($result > 0) ?  $result  : $number;
    }
    function post($param)
    {
      $myCurl = curl_init();
      curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'https://report.commission2.kz/doit/api/report.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($param)
      ));
      $response = json_decode(curl_exec($myCurl), true);
      curl_close($myCurl);
      return $response;
    };

    $table = 'reports';
    $data_begin = '2022-02-01'; //Дата начало
    $data_end   = '2022-02-28'; //Дата конец
    $day =  date('Y-m-d'); // день


  // $arr = post([
  //   'token' => 'qfq5441fa65f4654w',
  //   'start' => $data_begin,
  //   'end' => $data_end,
  // ]);
  // foreach ($region as $key => $value) {
  //   
  //   $month =  11; // Месяц
  //   $test = R::findOne('comision2region', 'region=? AND data =? AND month =?', [$arr['region'], $day, $month]);
  //   if (empty($test)) {
  //     $test = R::dispense('comision2region');
  //   };
  //   $test->region         = $value;
  //   $test->summa_vydachy  = $arr['summa_vydachy'];
  //   $test->comis          = $arr['comis'];
  //   $test->count          = $arr['count'];
  //   $test->proc           = $arr['proc'];
  //   $test->tehnica        = $arr['tehnica'];
  //   $test->vozvrat        = $arr['vozvrat'];
  //   $test->shuby          = $arr['shuby'];
  //   $test->nal            = $arr['nal'];
  //   $test->sale           = $arr['sale'];
  //   $test->cena_pr        = $arr['cena_pr'];
  //   $test->dop            = $arr['dop'];
  //   $test->month          = $month;
  //   $test->sales          = $arr['sales'];
  //   $test->data           = $day;
  //   $test->purchaseamount = $arr['purchaseamount'];
  //   $test->price          = $arr['price'];
  //   R::store($test);
  // }

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Отчет за 02 2022
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
            <div class="box-body">
              <div class="">
                <table class="table table-bordered table-hover" style="white-space:nowrap;" id="datatable-tabletools">

                  <!-- datatable-tabletools  -->
                  <thead>
                    <tr style="background: #398ebd; color: white;">
                      <th rowspan="2">РЕГИОНЫ</th>
                      <th colspan="5" class="text-center">Доход</th>
                      <!-- <th rowspan="2">ДОХОДЫ</th> -->
                      <th rowspan="2">РАСХОДЫ</th>
                      <!--    <th>СТАБ.РАСХОДЫ</th>
                      <th>ТЕК.РАСХОДЫ</th>
                      <th>ПРИБЫЛЬ</th>  -->
                      <th colspan="4" class="text-center">ЧИСТАЯ ПРИБЫЛЬ </th>
                      <th colspan="2" class="text-center">КЛИЕНТЫ</th>
                      <th rowspan="2">ЧИСТАЯ <br> ВЫДАЧА</th>
                      <th colspan="2" class="text-center">АУКЦИОНИСТ</th>
                      <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                    </tr>
                    <tr style="background: #398ebd; color: white;">
                      <th>ЛОМБАРДА</th>
                      <th>МАГАЗИНА</th>
                      <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>
                      <!-- <th>ДОХОД КОМИССИОНКИ</th> -->
                      <th>ДОП</th>
                      <th>ИТОГ</th>
                      <th>ЛОМБАРДА (-20%)</th>
                      <th>TBS (-3%)</th>
                      <th>OBS (-3%)</th>
                      <th>ИТОГ</th>
                      <th>ВСЕ </th>
                      <th>НОВЫЕ</th>
                      <th>ТЕХНИКА</th>
                      <th>ШУБА</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $result = R::getAll("SELECT id, region,
                    SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),
                    SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                    SUM(newclients),SUM(vzs),SUM(vozvrat),
                    SUM(nakladnoy),COUNT(adress),SUM(chv)
                    FROM reports
                    GROUP BY region ORDER BY SUM(dl) ASC");
                    $ss = 0;
                    $ss2 = 0;
                    $ss3 = 0;
                    
                    foreach($result as $data1) {
                      $regionobsh =  $data1['region'];
                      $resultr = mysqli_query($connect, "SELECT SUM(summarf) FROM `rashodfillial` WHERE region = '$regionobsh' ");
                      $datar = mysqli_fetch_array($resultr);
                      $obshirashodregiona = $datar['SUM(summarf)'];

                      $region =  $data1['region'];
                      $sales = R::getAll("SELECT SUM(pribl),SUM(remainder) ,  SUM(summaprihod) ,COUNT(*) FROM sales WHERE regionlombard = '$region' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");
                      $sale12 = $sales[0];
                      $reg = ['Нур-Султан', 'Костанай', 'Кокшетау', 'Павлодар', 'Караганда', 'Петропавловск'];

                      $ras = R::getCol("SELECT SUM(tekrashod) FROM comisstest WHERE region=? AND data BETWEEN '$data_begin' AND '$data_end' ", [$region]);
                      $ras = $ras[0];

                      if (in_array($region, $reg)) {
                        $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                        $accsess = $accsess[0];
                        $result12 = $mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$data_begin' AND '$data_end' ");
                        $data89 = mysqli_fetch_array($result12);
                        $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                        $data81 = mysqli_fetch_array($result81);
                        $result19 = $mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                        $data19 = mysqli_fetch_array($result19);
                        $obs = $data89['SUM(p1)'] + $data19['SUM(proc)'] + ($data81['SUM(cena_pr)'] - $data81['SUM(summa_vydachy)']) + $data81['SUM(profit)'] - $data451['SUM(summa)'] + ($accsess['SUM(price)'] - $accsess['SUM(purchaseamount)']) - $ras;                                                  // чистая прибыль  = за минусом 20 процентов

                        $obs = percent($obs, 3);
                      } else {

                        $da = R::findOne('comision2region', "data = ? AND region = ? ", [$day, $region]);  //findAll('comision2region',"data = ? AND region IS NOT NULL GROUP BY region",[$day])
                        $tbs = $da['comis'] + $da['proc'] + ($da['cena_pr'] - $da['sale']) + $da['profit'] - $da['SUM(summa)'] + ($da['price'] - $da['purchaseamount']) - $ras;
                        $tbs = percent($tbs, 3);
                      }; ?>
                      <tr>
                        <td><a href="viewreportregion2.php?region=<?= $region  ?>"> <?= $region  ?></a></td>
                        <td>
                          <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
                        </td>
                        <td>
                          <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
                        </td>
                        <td class="danger">

                          <?= number_format($sale12['SUM(remainder)'] - $sale12['SUM(summaprihod)'], 0, '.', ' ');
                          $report_sales_pribl += $sale12['SUM(remainder)'] - $sale12['SUM(summaprihod)'] ?> </td>


                        <td>
                          <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                        </td>
                        <td class="info">
                          <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                        </td>
                        <?
                        $chistaya = percent($data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'], 20); // чистая прибыль  = за минусом 20 процентов
                        ?>
                        <td>
                          <?= number_format($obshirashodregiona, 0, '.', ' '); ?>
                          <?/* number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); */?>
                        </td>
                        <td style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                        <th>
                          <?= number_format($tbs, 0, '.', ' ');
                          $tbsTotal += $tbs;  ?>
                        </th>
                        <th class="danger">
                          <?= number_format($obs + ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']), 0, '.', ' ');
                          $obsTotal += $obs+ ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);  ?>
                        </th>
                        <th class="success"><?= number_format($obs + $chistaya + $tbs, 0, '.', ' '); ?>
                          <? unset($obs, $tbs, $accsess); ?>
                        </th>
                        <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>

                        <td style="background: #00a759; color: black;"><?= number_format($s, 0, '.', ' ');; ?></td>
                        <td style="background: #f39d0a; color: black;"><?= number_format($s2, 0, '.', ' ');; ?></td>
                        <td style="background: #de4936; color: black;"><?= number_format($s3, 0, '.', ' ');; ?></td>
                      <? } ?>
                  </tbody>
                  <tfoot>

                    <tr style="background: #d3d7df; color: black;">
                      <th>Итого (СУММА)</th>
                      <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                      <th class="bg-red"><?= number_format($report_sales_pribl, 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                      <!--<th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th> -->
                      <?
                      $chistaya = percent($data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'], 20);                                                   // чистая прибыль  = за минусом 20 процентов
                      ?>
                      <!-- <th><?= number_format($data2['SUM(stabrashod)'] + $data2['SUM(tekrashod)'], 0, '.', ' '); ?></th> -->
                      <th>
                        <?= number_format($rashodporegionam, 0, '.', ' '); ?>

                      </th>
                      <th style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></th>
                      <th>
                        <?= number_format($tbsTotal, 0, '.', ' '); ?>
                      </th>
                      <th class="danger"><?= number_format($obsTotal, 0, '.', ' '); ?></th>

                      <th class="success"><?= number_format($obsTotal + $chistaya + $tbsTotal, 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
                      <th style="background: #00a759; color: black;"><?= number_format($ss, 0, '.', ' '); ?></th>
                      <th style="background: #f39d0a; color: black;"><?= number_format($ss2, 0, '.', ' '); ?></th>
                      <th style="background: #de4936; color: black;"><?= number_format($ss3, 0, '.', ' '); ?></th>
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
<?php include "footer.php"; ?>
