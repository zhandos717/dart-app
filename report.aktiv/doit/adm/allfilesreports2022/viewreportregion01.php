<? //проверка существовании сессии
include("../../../bd.php");
if ($_SESSION['logged_user']->status == 3) :


  $region = $_GET['region'];
  include "header.php";
  include "menu.php";

  $table = 'reports012022';

  function percent(int $number, int $percent)
  {

    $result = $number - ($number / 100 * $percent);
    if ($result > 0)
    return $result;
    else
    return $number;
  }

  $data_begin = '2022-01-01'; //Дата начало
  $data_end   = '2022-01-31'; //Дата конец
  $month = date('m');
  $day =  date('Y-m-d');

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
    //  $response = curl_exec($myCurl);
    curl_close($myCurl);
    return $response;
  };

  $filOne = R::findAll('kassa', 'region = ? GROUP BY filial', [$region]);
  foreach ($filOne as $find) {
    $array = [
      'token' => 'qfq5441fa65f4654w',
      'filial' => $find['filial'],
      'start' => $data_begin,
      'end' => $data_end,
    ];

    $arr = post($array);
    if (!empty($arr['summa_vydachy'])) {
      $test = R::findOne('comision2', 'adress=? AND day =? ', [$find['filial'], $day]);
      if (empty($test)) {
        $test = R::dispense('comision2');
      };
      $test->region         = $region;
      $test->adress         = $find['filial'];
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
      $test->day            = $day;
      R::store($test);
    }
  };
  if ($region != 'Караганда' and  $region != 'Нур-Султан') {
    $comis2 = R::findAll('comision2', "region=:region AND day =:day GROUP BY adress", [':region' => $region, ':day' => $day]);
  };
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Отчет
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
            <!-- <div class="box-header">
            <h3 class="box-title"></h3>
          </div> -->
            <div class="box-body">
              <div class="responsive">
                <table class="table table-bordered table-hover" id="datatable-tabletools" style="white-space:nowrap;">
                  <thead>
                    <tr class="bg-blue">
                      <th>Филиалы</th>
                      <th>Доход <br> ЛОМБАРДА</th>
                      <th>Доход <br> МАГАЗИНА</th>
                      <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>

                      <th>ДОП <br> Доход</th>
                      <th>ИТОГ</th>
                      <th>РАСХОДЫ</th>
                      <th>ЛОМБАРДА (-20%)</th>
                      <th>КОМИССИОНКА (-3%)</th>
                      <th>ИТОГ</th>
                      <th>ВСЕ <br> КЛИЕНТЫ</th>
                      <th>НОВЫЕ <br> КЛИЕНТЫ</th>
                      <th>ЧИСТАЯ <br> ВЫДАЧА</th>
                      <th>ТЕХНИКА</th>
                      <th>ШУБА</th>
                      <th>НАЛ В <br> ЗАЛОГЕ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $result = R::getAll(" SELECT id, region,adress, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                       FROM reports012022 WHERE region = '$region'  GROUP BY adress  ");
                    foreach ($result as $data1) {
                      $region =  $data1['region'];
                      $adress =  $data1['adress'];



                      $datar = R::getRow("SELECT SUM(summarf) FROM rashodfillial WHERE  adress = '$adress' AND datarashoda BETWEEN '$data_begin' AND '$data_end' ");

                      $obshirashodfiliala = $datar['SUM(summarf)'];



                      $nal = R::findOne('reports012022', 'adress =? ORDER BY data DESC LIMIT 1', [$adress]);
                      $table = R::getCol("SELECT SUM(tekrashod),adress FROM comisstest WHERE adress=? AND data BETWEEN '$data_begin' AND '$data_end' ", [$adress]);
                      $ras = $table[0];

                      if ($adress == 'Шахтеров (Ермекова) 52') {
                        $adress1 = 'Шахтеров 52';
                      } elseif ($adress == 'Назарбекова 11 (Нурсат)') {
                        $adress1 = 'Назарбекова 11';
                      } elseif ($adress == 'Уалиханова 192 (11 мкрн)') {
                        $adress1 = 'Уалиханова 192';
                      } else {
                        $adress1 = $adress;
                      }

                      $sales = R::getAll("SELECT SUM(pribl),SUM(remainder) ,  SUM(summaprihod) ,COUNT(*) FROM sales WHERE adresslombard = '$adress1' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");

                      $sale12 = $sales[0];

                      $pr = $data1['SUM(dohod)'] - $obshirashodfiliala;
                      $chistaya_lombard = percent($pr, 20);

                      if (!empty($comis2)) {
                        $tbs_reg = R::findOne('comision2', "adress=:adress AND day =:day ORDER BY id DESC ", [':adress' => $adress, ':day' => $day]);

                        $chistaya1 = $tbs_reg['comis'] + $tbs_reg['proc'] + ($tbs_reg['cena_pr'] - $tbs_reg['sale']) + $tbs_reg['profit'] - $ras;
                      } else {
                        $result12 = $mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND NOT (status = '11' OR status = '1') AND dataseg BETWEEN '$data_begin' AND '$data_end' ");
                        $data89 = mysqli_fetch_array($result12);
                        $result19 = $mysqli->query("SELECT SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                        $data19 = mysqli_fetch_array($result19);

                        $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress1' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                        $data81 = mysqli_fetch_array($result81);

                        $chistaya1 = $data89['SUM(p1)'] + $data19['SUM(proc)'] + ($data81['SUM(cena_pr)'] - $data81['SUM(summa_vydachy)']) + $data81['SUM(profit)'] - $ras; // чистая прибыль  = за минусом 20 процентов
                      }
                      $chistaya1 = percent($chistaya1, 3);
                      $dl += $data1['SUM(dl)'];
                      $dm += $data1['SUM(dm)'];
                      $dop += $data1['SUM(dop)'];
                      $dohod += $data1['SUM(dohod)'];

                      // $rashod += $data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'];

                      $chistaya_lombard_total += $chistaya_lombard;
                      $allclients += $data1['SUM(allclients)'];
                      $newclients += $data1['SUM(newclients)'];
                      $chv += $data1['SUM(chv)'];
                      $auktech += $nal['auktech'];
                      $aukshubs += $nal['aukshubs'];
                      $nalvzaloge += $nal['nalvzaloge'];
                      $totalR +=  $obshirashodfiliala;
                    ?>
                      <tr>
                        <td><a href="viewfilial01.php?region=<?= $region; ?>&adress=<?= $data1['adress']; ?>"><?= $data1['adress']; ?></a></td>
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
                        <td>
                          <?= number_format($obshirashodfiliala, 0, '.', ' '); ?>
                          <!-- <?/* number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); */ ?> -->
                        </td>
                        <td class="info"><strong><?= number_format($chistaya_lombard, 0, '.', ' '); ?></strong></td>
                        <th class="danger"><?= number_format($chistaya1, 0, '.', ' ');
                                            $chistaya_tbs += $chistaya1; ?></th>
                        <th class="success"><?= number_format($chistaya_lombard + $chistaya1, 0, '.', ' '); ?></th>
                        <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                        <td style="background: #00a759; color: black;"><?= number_format($nal['auktech'], 0, '.', ' ');; ?></td>
                        <td style="background: #f39d0a; color: black;"><?= number_format($nal['aukshubs'], 0, '.', ' ');; ?></td>
                        <td style="background: #de4936; color: black;"><?= number_format($nal['nalvzaloge'], 0, '.', ' ');; ?></td>
                      </tr>
                    <? } ?>
                  </tbody>
                  <tfoot>
                    <tr class="bg-gray">
                      <th>Итого (СУММА)</th>
                      <th><?= number_format($dl, 0, '.', ' '); ?></th>
                      <th><?= number_format($dm, 0, '.', ' '); ?></th>
                      <th> <?= number_format($report_sales_pribl, 0, '.', ' '); ?> </th>
                      <th><?= number_format($dop, 0, '.', ' '); ?></th>
                      <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                      <th><?= number_format($totalR, 0, '.', ' '); ?></th>
                      <th class="info"><?= number_format($chistaya_lombard_total, 0, '.', ' '); ?></th>
                      <th class="danger"><?= number_format($chistaya_tbs, 0, '.', ' '); ?></th>
                      <th class="success"><?= number_format($chistaya_tbs + $chistaya_lombard_total, 0, '.', ' '); ?></th>
                      <th><?= number_format($allclients, 0, '.', ' '); ?></th>
                      <th><?= number_format($newclients, 0, '.', ' '); ?></th>
                      <th><?= number_format($chv, 0, '.', ' '); ?></th>
                      <th style="background: #00a759; color: black;"><?= number_format($auktech, 0, '.', ' '); ?></th>
                      <th style="background: #f39d0a; color: black;"><?= number_format($aukshubs, 0, '.', ' '); ?></th>
                      <th style="background: #de4936; color: black;"><?= number_format($nalvzaloge, 0, '.', ' '); ?></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
        <? if ($comis2) { ?>
          <div class="col-xs-12">
            <div class="box box-danger">
              <div class="box-header with-border">
                <h2 class="box-title"> <span class="label label-danger">TBS</span> </h2>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr class="bg-blue">
                        <th>РЕГИОНЫ</th>
                        <th>ДОХОД <br> КОМИССИОНКИ</th>
                        <th>ДОХОД <br> МАГАЗИНА</th>
                        <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>

                        <th>РАСХОДЫ</th>
                        <th>ДОХОДЫ</th>
                        <th>ПРИБЫЛЬ - 3%</th>
                        <th>ВСЕ <br> КЛИЕНТЫ</th>
                        <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                        <th>АУКЦИОНИСТ <br> ШУБА</th>
                        <th>НАЛ В <br> ЗАЛОГЕ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $report_sales_pribl = 0;

                      foreach ($comis2 as $data2) {
                        $ras = R::getCol("SELECT SUM(tekrashod) FROM comisstest WHERE adress=? AND data BETWEEN '$data_begin' AND '$data_end' ", [$data2['adress']]);
                        $ras = $ras[0];
                        $dohod = $data2['comis'] + $data2['proc'] + ($data2['cena_pr'] - $data2['sale']) + $data2['profit'] - $ras;
                        $chistaya_tbs = percent($dohod, 3);

                        $sales = R::getAll("SELECT SUM(pribl),SUM(remainder) ,  SUM(summaprihod) ,COUNT(*) FROM sales WHERE adresslombard = '{$data2['adress']}' AND fromtovar = '2'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");

                        $sale12 = $sales[0];

                      ?>
                        <tr style="white-space:nowrap;">
                          <td><a class="btn btn-block bg-olive"><?= $data2['adress']; ?></a></td>
                          <td>
                            <?= number_format($data2['comis'] + $data2['proc'], 0, '.', ' ');
                            $dohod1 += $data2['comis'] + $data2['proc']; ?>
                          </td>
                          <td>
                            <? echo number_format(($data2['cena_pr'] - $data2['sale']) + $data2['profit'], 0, '.', ' ');
                            $dohodm1 += ($data2['cena_pr'] - $data2['sale']) + $data2['profit']; ?>
                          </td>

                          <td class="danger">
                            <?= number_format($sale12['SUM(remainder)'] - $sale12['SUM(summaprihod)'], 0, '.', ' ');
                            $report_sales_pribl += $sale12['SUM(remainder)'] - $sale12['SUM(summaprihod)'] ?> </td>

                          <td><?= number_format($ras, 0, '.', ' ');
                              $ras_tbs += $ras; ?></td>
                          <td>
                            <?= number_format($dohod, 0, '.', ' '); ?>
                          </td>
                          <th class="bg-blue"><?= number_format($chistaya_tbs, 0, '.', ' ');
                                              $chistaya_tbs_total += $chistaya_tbs; ?></th>
                          <td>
                            <?= number_format($data2['count'], 0, '.', ' ');
                            $count1 += $data2['count']; ?>
                          </td>
                          <td style="background: #00a759; color: black;">
                            <?= number_format($data2['tehnica'], 0, '.', ' ');
                            $summa_vydachy1 += $data2['tehnica']; ?>
                          </td>
                          <td style="background: #f39d0a; color: black;">
                            <?= number_format($data2['shuby'], 0, '.', ' ');
                            $summa_vydachy21 += $data2['shuby']; ?>
                          </td>
                          <td style="background: #de4936; color: black;">
                            <?= number_format($data2['nal'], 0, '.', ' ');
                            $summa_vydachy31 += $data2['nal'];
                            unset($ras);
                            ?>
                          </td>
                        </tr>
                      <? }; ?>
                    </tbody>
                    <tfoot>
                      <tr style="background: #d3d7df; color: black; white-space:nowrap;">
                        <th>Итого (СУММА)</th>
                        <th><?= number_format($dohod1, 0, '.', ' '); ?></th>
                        <th><?= number_format($dohodm1, 0, '.', ' '); ?></th>

                        <th> <?= number_format($report_sales_pribl, 0, '.', ' '); ?> </th>
                        <th><?= number_format($ras_tbs, 0, '.', ' '); ?></th>
                        <th><?= number_format($dohod1 + $dohodm1 - $ras_tbs, 0, '.', ' '); ?></th>
                        <th style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya_tbs_total, 0, '.', ' '); ?></strong></th>
                        <th><?= number_format($count1, 0, '.', ' '); ?></th>
                        <th style="background: #00a759; color: black;"><?= number_format($summa_vydachy1, 0, '.', ' '); ?></th>
                        <th style="background: #f39d0a; color: black;"><?= number_format($summa_vydachy21, 0, '.', ' '); ?></th>
                        <th style="background: #de4936; color: black;"><?= number_format($summa_vydachy31, 0, '.', ' '); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->

            </div><!-- /.box -->
          </div><!-- /.col -->

        <? } else { ?>
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h2 class="box-title"> <span class="label label-danger">OBS</span> </h2>
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
                        <th>РЕГИОНЫ</th>
                        <th>ДОХОД <br> КОМИССИОНКИ</th>
                        <th>ДОХОД <br> МАГАЗИНА</th>
                        <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>

                        <th>ДОХОДЫ</th>
                        <!-- <th>РАСХОДЫ</th> -->
                        <th>ПРИБЫЛЬ - 3%</th>
                        <th>ВСЕ <br> КЛИЕНТЫ</th>
                        <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                        <th>АУКЦИОНИСТ <br> ШУБА</th>
                        <th>НАЛ В <br> ЗАЛОГЕ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $report_sales_pribl = 0;

                      $result = R::getAll("SELECT COUNT(*) as count , SUM(p1), adressfil,SUM(proc) FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND region = '$region'  AND dataseg BETWEEN '$data_begin' AND '$data_end'  GROUP BY adressfil  ");
                      foreach ($result as $data1) {
                        ##################### Регион
                        $adress = $data1['adressfil'];
                        #####################
                        $data19 = R::getRow("SELECT SUM(proc) FROM tickets WHERE adressfil = '$adress' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                        ##################### Сумма процентов выкупленных товаров
                        $result8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit),COUNT(*) FROM tickets  WHERE adressfil = '$adress' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                        $data8 = $result8[0];
                        ##################### Сумма выдачи, сумма продажи и количество проданных товаров
                        $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE adressfil ='$adress' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                        $acc = $accsess[0];
                        ##############################
                        //Аукционист шуб
                        $auctioneer_fur = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress'  AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND  type = 'Шубы'  ");
                        //Аукционист техники
                        $auctioneer_teh = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы'  ");
                        //Нал в залоге
                        $cash_in_pledge_end = R::getRow(" SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress'  AND status = '2' ");

                        $chistaya = percent($data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']), 3);

                        $sales = R::getAll("SELECT SUM(pribl),SUM(remainder) ,  SUM(summaprihod) ,COUNT(*) FROM sales WHERE adresslombard = '$adress' AND fromtovar = '2'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");

                        $sale12 = $sales[0];

                      ?>
                        <tr>
                          <td><a href="#" class="btn btn-block bg-olive"> <?= $adress; ?></a></td>
                          <td>
                            <?= number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' ');
                            $dohod_obs += $data1['SUM(p1)'] + $data19['SUM(proc)']; ?>
                          </td>
                          <td>
                            <?= number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' ');
                            $dohod_mag_obs += ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)']; ?>
                          </td>
                          <td class="danger">
                            <?= number_format($sale12['SUM(remainder)'] - $sale12['SUM(summaprihod)'], 0, '.', ' ');
                            $report_sales_pribl += $sale12['SUM(remainder)'] - $sale12['SUM(summaprihod)'] ?> </td>

                          <td>
                            <?= number_format($data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']), 0, '.', ' '); ?>
                          </td>

                          <!-- <td><?= number_format($ras, 0, '.', ' ');
                                    $ras_obs += $ras; ?></td> -->
                          <th class="bg-blue"><?= number_format($chistaya, 0, '.', ' ');
                                              $chistaya_obs += $chistaya; ?></th>
                          <td><?= number_format($data1['count'], 0, '.', ' ');
                              $count_cl += $data1['count']; ?></td>
                          <td class="success">
                            <? echo number_format($auctioneer_teh['SUM(summa_vydachy)'], 0, '.', ' ');
                            $tehnica_obs += $auctioneer_teh['SUM(summa_vydachy)']; ?>
                          </td>
                          <td class="warning">
                            <? echo number_format($auctioneer_fur['SUM(summa_vydachy)'], 0, '.', ' ');
                            $shuby_obs += $auctioneer_fur['SUM(summa_vydachy)']; ?>
                          </td>
                          <td class="danger">
                            <? echo number_format($cash_in_pledge_end['SUM(summa_vydachy)'], 0, '.', ' ');
                            $nal_obs += $cash_in_pledge_end['SUM(summa_vydachy)'];
                            ?>
                          </td>
                        </tr>
                      <? } ?>
                    </tbody>
                    <tfoot>
                      <tr class="bg-gray">
                        <th>Итого (СУММА)</th>
                        <th><?= number_format($dohod_obs, 0, '.', ' '); ?></th>
                        <th><?= number_format($dohod_mag_obs, 0, '.', ' '); ?></th>

                        <th> <?= number_format($report_sales_pribl, 0, '.', ' '); ?> </th>
                        <th><?= number_format($dohod_obs + $dohod_mag_obs, 0, '.', ' '); ?></th>

                        <!-- <td><?= number_format($ras_obs, 0, '.', ' '); ?></td> -->
                        <th class="bg-blue"><?= number_format($chistaya_obs, 0, '.', ' '); ?></th>
                        <th><?= number_format($count_cl, 0, '.', ' '); ?></th>
                        <th class="bg-olive"><?= number_format($tehnica_obs, 0, '.', ' '); ?></th>
                        <th class="bg-yellow"><?= number_format($shuby_obs, 0, '.', ' '); ?></th>
                        <th class="bg-red"><?= number_format($nal_obs, 0, '.', ' '); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        <? } ?>
      </div><!-- /.row -->
  </div><!-- /.content-wrapper -->
<?
  include "footer.php";
else :
  header('Location: index.php');
endif; ?>
