<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
  include "header.php";
  include "menu.php";

  function post($param){
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
    $day =  date('Y-m-d'); // день
    $month =  11; // Месяц
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
  function percent($number, $percent)
  {
    return $number - ($number / 100 * $percent);
  }



  $result = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
  $data = $result[0];
  $pr = $data['SUM(dohod)'] - $data['SUM(stabrashod)'] - $data['SUM(tekrashod)'];
  $chistaya = percent($pr, 20);
  $fil = R::findAll($table, " GROUP BY adress");
  foreach ($fil as $value) {
    $fil = R::findOne($table, 'adress = ? ORDER BY data DESC', [$value['adress']]);
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
      <?
      $today2 = date('Y-m-d');
      $data_begin2 = date('Y-m-01');
      ?>


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
                      $regionobsh =  $data1['region'];
                      $resultr = mysqli_query($connect, "SELECT SUM(summarf) FROM `rashodfillial` WHERE region = '$regionobsh' ");
                      $datar = mysqli_fetch_array($resultr);
                      $obshirashodregiona = $datar['SUM(summarf)'];

                      $resultsr = mysqli_query($connect, "SELECT SUM(summarf) FROM `rashodfillial`  ");
                      $datasr = mysqli_fetch_array($resultsr);
                      $rashodporegionam = $datasr['SUM(summarf)'];

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
                        <?
                        $result4 = R::getCol("SELECT  adress FROM reports WHERE region='$region' GROUP BY adress ");

                        $s = 0;
                        $s2 = 0;
                        $s3 = 0;

                        foreach ($result4 as $filial) {
                          $nal = R::findOne('reports', 'adress =? ORDER BY data DESC LIMIT 1', [$filial]);
                          $s += $nal['auktech'];
                          $s2 += $nal['aukshubs'];
                          $s3 += $nal['nalvzaloge'];
                          // $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports WHERE segdata=(SELECT MAX(segdata) FROM reports WHERE region = '$region' AND adress = '$filial' ) ");
                          // $data5 = mysqli_fetch_array($result5);
                          // $s += $data5['auktech'];
                          // $s2 += $data5['aukshubs'];
                          // $s3 += $data5['nalvzaloge'];
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

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b> OBS </b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="example1">
                  <thead style="white-space:nowrap;">
                    <tr class="bg-blue">
                      <th rowspan="2">РЕГИОНЫ</th>
                      <th rowspan="2">КОМИССИОНКА</th>
                      <th colspan="5" class="text-center">МАГАЗИН доход</th>
                      <!-- <th>ДОП <br> ДОХОДЫ</th> -->
                      <!-- <th rowspan="2">ДОХОДЫ</th> -->
                      <!-- <th rowspan="2">РАСХОДЫ</th> -->
                      <th rowspan="2">ПРИБЫЛЬ</th>
                      <th rowspan="2">РАСХОД</th>
                      <th rowspan="2">ПРИБЫЛЬ -3%</th>
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
                    <?
                    $result = R::getAll("SELECT COUNT(*) as count , SUM(p1), region FROM tickets WHERE NOT (status = '11' OR status = '1' )
                                              AND dataseg BETWEEN '$data_begin' AND '$data_end'  GROUP BY region  ");
                    foreach ($result as $data1) {
                      ##################### Регион
                      $region = $data1['region'];
                      #####################
                      $data19 = R::getRow("SELECT SUM(proc) FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                      ##################### Сумма процентов выкупленных товаров
                      $result8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit),COUNT(*) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                      $data8 = $result8[0];
                      ##################### Сумма выдачи, сумма продажи и количество проданных товаров
                      $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                      $acc = $accsess[0];
                      ##################### Сумма прихода и продажи товаров товаров
                      $sales = R::getAll("SELECT SUM(pribl), SUM(remainder), SUM(summaprihod),COUNT(*) FROM sales WHERE regionlombard = '$region'  AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'   AND statustovar IS NULL ");
                      $sale_com = $sales[0];
                      ##################### Сумму и количество проданных товаров в магазине
                      //Аукционист шуб
                      $auctioneer_fur = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region'  AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND  type = 'Шубы'  ");
                      //Аукционист техники
                      $auctioneer_teh = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы'  ");
                      //Нал в залоге
                      $cash_in_pledge_end = R::getRow("SELECT SUM(summa_vydachy) FROM tickets  WHERE region = '$region' AND status = '2' ");
                      ############################## Аукционист шуб // Аукционист техники
                      $rashod = R::getRow("SELECT SUM(tekrashod) FROM comisstest  WHERE region = '$region' AND data BETWEEN '$data_begin' AND '$data_end' ");
                      // var_dump($rashod)
                    ?>
                      <tr>
                        <td><a class="btn btn-block bg-olive" href="viewreportregion2.php?region=<?= $data1['region']; ?>"><?= $data1['region']; ?></a></td>
                        <td>
                          <? echo number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' ');
                          $dohod += $data1['SUM(p1)'] + $data19['SUM(proc)']; ?>
                        </td>
                        <td><?= $data8['COUNT(*)'];
                            $countm += $data8['COUNT(*)']; ?></td>
                        <td>
                          <? echo number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' ');
                          $dohodm += ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)']; ?>
                        </td>
                        <th>
                          <?= number_format($acc['SUM(price)'] - $acc['SUM(purchaseamount)'], 0, '.', ' ');
                          $accses_obs += ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);  ?>
                        </th>
                        <td class="danger">
                          <?= number_format($sale_com['SUM(remainder)'] - $sale_com['SUM(summaprihod)'], 0, '.', ' ');
                          $dohodml += $sale_com['SUM(remainder)'] - $sale_com['SUM(summaprihod)'] ?>
                        </td>
                        <td class="danger"><?= $sale_com['COUNT(*)'];
                                            $countml += $sale_com['COUNT(*)']; ?></td>


                        <!-- <td>0</td> -->
                        <? $chistaya = $data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'] - $data451['SUM(summa)'] + ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);
                        $ch = percent($chistaya, 3);
                        ?>

                        <th><?= number_format($chistaya, 0, '.', ' '); ?></th>
                        <td>
                          <?= number_format($rashod['SUM(tekrashod)'],  0, '.', ' ');
                          $tekrashod_com += $rashod['SUM(tekrashod)'];
                          ?>

                        </td>
                        <td class="info">
                          <?= number_format($ch - $tekrashod_com, 0, '.', ' ');
                          $total_ch += $ch; ?>
                        </td>

                        <td>
                          <?= number_format($data1['count'], 0, '.', ' ');
                          $count += $data1['count']; ?>
                        </td>
                        <td class="success">
                          <?= number_format($auctioneer_teh['SUM(summa_vydachy)'], 0, '.', ' ');
                          $summa_vydachy += $auctioneer_teh['SUM(summa_vydachy)']; ?>
                        </td>
                        <td class="warning">
                          <?= number_format($auctioneer_fur['SUM(summa_vydachy)'], 0, '.', ' ');
                          $summa_vydachy2 += $auctioneer_fur['SUM(summa_vydachy)']; ?>
                        </td>
                        <td> <?= number_format($sale['SUM(summaprihod)'] - $data8['SUM(summa_vydachy)'], 0, '.', ' ');
                              $auct += $sale['SUM(summaprihod)'] - $data8['SUM(summa_vydachy)']; ?></td>
                        <td class="danger">
                          <?= number_format($cash_in_pledge_end['SUM(summa_vydachy)'], 0, '.', ' ');
                          $cash_in_pledge += $cash_in_pledge_end['SUM(summa_vydachy)'];
                          ?>
                        </td>
                      </tr>
                    <? }; ?>
                  </tbody>
                  <tfoot>
                    <tr class="bg-gray">
                      <th>Итого (СУММА)</th>
                      <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                      <td> <?= $countm; ?></td>
                      <th><?= number_format($dohodm, 0, '.', ' '); ?></th>
                      <th><?= number_format($accses_obs, 0, '.', ' '); ?></th>

                      <th class="bg-red"><?= number_format($dohodml, 0, '.', ' '); ?></th>
                      <td class="bg-red"> <?= $countml; ?></td>
                      <!-- <th></th> -->
                      <!-- <th>0</th> -->

                      <th><?= number_format($dohodm + $dohod + $accses_obs, 0, '.', ' '); ?></th>
                      <td> <?= $tekrashod_com?></td>
                      <td class="bg-blue"><?= number_format($total_ch - $tekrashod_com, 0, '.', ' '); ?></td>

                      <th><?= number_format($count, 0, '.', ' '); ?></th>
                      <th><?= number_format($summa_vydachy, 0, '.', ' '); ?></th>
                      <th><?= number_format($summa_vydachy2, 0, '.', ' '); ?></th>
                      <td><?= number_format($auct, 0, '.', ' '); ?> </td>
                      <th>
                        <? echo number_format($cash_in_pledge, 0, '.', ' ');
                        unset($dohod, $dohodm, $count, $newclients, $summa_vydachy, $summa_vydachy2, $cash_in_pledge_end); ?>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
        <!--  -->
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
                <table class="table table-bordered table-hover" style="white-space:nowrap;">
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
else :
  header('Location: ../../index.php');
endif; ?>
