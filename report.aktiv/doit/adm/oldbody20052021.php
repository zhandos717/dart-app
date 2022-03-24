<?


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
  // $response = curl_exec($myCurl);
  curl_close($myCurl);
  return $response;
};

$data_begin = '2021-05-01'; //Дата начало
$data_end   = '2021-05-31'; //Дата конец
$day =  date('Y-m-d');
$month =  date('m');
$region = ['Атырау', 'Актобе', 'Актау', 'Шымкент', 'Алматы', 'Талдыкорган', 'Уральск', 'Семей', 'Тараз', 'Кызылорда', 'Туркестан'];
foreach ($region as $key => $value) {
  $array = [
    'token' => 'qfq5441fa65f4654w',
    'region' => $value,
    'start' => $data_begin,
    'end' => $data_end,
  ];
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

$table = 'reports';
function percent($number, $percent){
  return $number - ($number / 100 * $percent);
}

$result = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data = $result[0];
$pr = $data['SUM(dohod)'] - $data['SUM(stabrashod)'] - $data['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya = percent($pr,20);    // чистая прибыль  = за минусом 20 процентов
$fil = R::findAll($table, " GROUP BY adress");
foreach ($fil as $value) {
  $fil = R::findOne($table, 'adress = ? ORDER BY segdata DESC', [$value['adress']]);
  $ss += $fil['auktech'];
  $ss2 += $fil['aukshubs'];
  $ss3 += $fil['nalvzaloge'];
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Отчет за МАЙ
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
          <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i>
          </a>
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
                  $result = mysqli_query($connect, "SELECT id, region,
                    SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),
                    SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                    SUM(newclients),SUM(vzs),SUM(vozvrat),
                    SUM(nakladnoy),COUNT(adress),SUM(chv)
                    FROM reports
                      GROUP BY region ORDER BY SUM(dl) ASC");
                  $ss = 0;
                  $ss2 = 0;
                  $ss3 = 0;
                  while ($data1 = mysqli_fetch_array($result)) {
                    $region =  $data1['region'];
                    $sales = R::getAll("SELECT SUM(pribl),COUNT(*) FROM sales WHERE regionlombard = '$region' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");
                    $sale12 = $sales[0];
                    $reg = ['Нур-Султан', 'Костанай', 'Кокшетау', 'Павлодар', 'Караганда'];
                    if (in_array($region, $reg)) {
                      $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                      $accsess = $accsess[0];
                      $result12 = $mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$data_begin' AND '$data_end' ");
                      $data89 = mysqli_fetch_array($result12);
                      $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                      $data81 = mysqli_fetch_array($result81);
                      $result19 = $mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                      $data19 = mysqli_fetch_array($result19);
                      $obs = $data89['SUM(p1)'] + $data19['SUM(proc)'] + ($data81['SUM(cena_pr)'] - $data81['SUM(summa_vydachy)']) + $data81['SUM(profit)'] - $data451['SUM(summa)'] + ($accsess['SUM(price)'] - $accsess['SUM(purchaseamount)']);                                                  // чистая прибыль  = за минусом 20 процентов
                      $obs = percent($obs,3);
                    } else {
                      $da = R::findOne('comision2region', "data = ? AND region = ? ", [$day, $region]);  //findAll('comision2region',"data = ? AND region IS NOT NULL GROUP BY region",[$day])
                      $tbs = $da['comis'] + $da['proc'] + ($da['cena_pr'] - $da['sale']) + $da['profit'] - $da['SUM(summa)'] + ($da['price'] - $da['purchaseamount']);
                      $tbs = percent($tbs,3);
                    }; ?>
                    <tr>
                      <td><a href="viewreportregion.php?region=<?= $region  ?>"> <?= $region  ?></a></td>
                      <td>
                        <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
                      </td>
                      <td>
                        <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
                      </td>
                      <td class="danger">
                        <?= number_format($sale12['SUM(pribl)'], 0, '.', ' ');
                        $report_sales_pribl += $sale12['SUM(pribl)']; ?>
                      </td>
                      <td>
                        <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                      </td>
                      <td class="info">
                        <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                      </td>
                      <?
                      $chistaya = percent($data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'],20); // чистая прибыль  = за минусом 20 процентов
                      ?>
                      <td><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                      <td style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                      <th>
                        <?= number_format($tbs, 0, '.', ' ');
                        $tbsTotal += $tbs;  ?>
                      </th>
                      <th class="danger">
                        <?= number_format($obs, 0, '.', ' ');
                        $obsTotal += $obs;  ?>
                      </th>
                      <th class="success"><?= number_format($obs + $chistaya + $tbs, 0, '.', ' '); ?>
                        <? unset($obs, $tbs, $accsess); ?>
                      </th>
                      <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                      <?
                      $result4 = mysqli_query($connect, "SELECT *FROM reports WHERE region='$region' GROUP BY adress ");
                      $s = 0;
                      $s2 = 0;
                      $s3 = 0;

                      while ($data4 = mysqli_fetch_array($result4)) {
                        $filial =  $data4['adress'];
                        $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports WHERE segdata=(SELECT MAX(segdata) FROM reports WHERE region = '$region' AND adress = '$filial' ) ");
                        $data5 = mysqli_fetch_array($result5);
                        $s += $data5['auktech'];
                        $s2 += $data5['aukshubs'];
                        $s3 += $data5['nalvzaloge'];
                      }

                      $ss += $s;
                      $ss2 += $s2;
                      $ss3 += $s3;
                      ?>
                      <td style="background: #00a759; color: black;"><?= number_format($s, 0, '.', ' ');; ?></td>
                      <td style="background: #f39d0a; color: black;"><?= number_format($s2, 0, '.', ' ');; ?></td>
                      <td style="background: #de4936; color: black;"><?= number_format($s3, 0, '.', ' ');; ?></td>
                    <? } ?>
                </tbody>
                <tfoot>
                  <? $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports  ");
                  $data2 = mysqli_fetch_array($result2);
                  ?>
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
                    <th><?= number_format($data2['SUM(stabrashod)'] + $data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
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


    <div class="row">

    </div><!-- /.row -->


</div><!-- /.content-wrapper -->
