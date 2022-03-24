<? //проверка существовании сессии
include("../../../bd.php");

if ($_SESSION['logged_user']->status == 3) :

  $data_begin = '2021-03-01'; //Дата начало
  $data_end   = '2021-03-31'; //Дата конец
 

    include "header.php";
    include "menu.php";

  $table = 'reports032021';
  function percent($number) {
  $percent = '20';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  function percent_comiss($number) {
  $percent = '3';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  $result = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
  $data = $result[0];
  $pr = $data['SUM(dohod)'] - $data['SUM(stabrashod)'] - $data['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
  $chistaya = percent($pr);    // чистая прибыль  = за минусом 20 процентов
  $fil = R::findAll($table," GROUP BY adress");
  foreach ($fil as $value){
  $fil = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
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
      Отчет за Март 2021
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
                <!--  -->
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
                        FROM $table
                        GROUP BY region");
                        $ss = 0;
                        $ss2 = 0;
                        $ss3 = 0;
                        while ($data1 = mysqli_fetch_array($result)) {
                          $region =  $data1['region'];
                          $sales = R::getAll("SELECT SUM(pribl),COUNT(*) FROM sales WHERE regionlombard = '$region' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");
                          $sale12 = $sales[0];
                          $reg = ['Нур-Султан','Костанай','Кокшетау','Павлодар','Караганда'];
                          if(in_array($region,$reg)){
                          $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                          $accsess = $accsess[0];
                          $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$data_begin' AND '$data_end' ");
                          $data89 = mysqli_fetch_array($result12);
                          $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                          $data81 = mysqli_fetch_array($result81);
                          $result19 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                          $data19 = mysqli_fetch_array($result19);
                          $obs = $data89['SUM(p1)']+$data19['SUM(proc)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)'])+$data81['SUM(profit)']-$data451['SUM(summa)'] + ($accsess['SUM(price)'] - $accsess['SUM(purchaseamount)']);                                                  // чистая прибыль  = за минусом 20 процентов
                          $obs= percent_comiss($obs);
                          }else{

                          $da = R::findOne('comision2region',"data = ? AND region = ? ",[$data_end,$region]);  //findAll('comision2region',"data = ? AND region IS NOT NULL GROUP BY region",[$day])
                          $tbs= $da['comis']+$da['proc']+($da['cena_pr']-$da['sale'])+$da['profit']-$da['SUM(summa)'] + ($da['price'] - $da['purchaseamount']);
                          $tbs= percent_comiss($tbs);
                          }; ?>
                  <tr>
                    <td><a href="viewreportregion03.php?region=<?= $region  ?>"> <?= $region  ?></a></td>
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
                        $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                        $chistaya = $pr - ($pr * 20) / 100;  // чистая прибыль  = за минусом 20 процентов
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
                      <?unset($obs,$tbs,$accsess);?>
                    </th>
                    <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                    <?
                            $result4 = mysqli_query($connect, "SELECT *FROM $table WHERE region='$region' GROUP BY adress ");
                            $s = 0;
                            $s2 = 0;
                            $s3 = 0;

                            while ($data4 = mysqli_fetch_array($result4)) {
                              $filial =  $data4['adress'];
                              $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM $table WHERE segdata=(SELECT MAX(segdata) FROM $table WHERE region = '$region' AND adress = '$filial' ) ");
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
                    <?}?>
                </tbody>
                <tfoot>
                  <?
                      $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from $table  ");
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
                          $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
                          $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                          ?>
                    <!--   <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->
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
              <table class="table table-bordered table-hover" style="white-space:nowrap;">
                <thead>
                  <tr class="bg-blue">
                    <th rowspan="2">РЕГИОНЫ</th>
                    <th rowspan="2">КОМИССИОНКА</th>
                    <th colspan="5" class="text-center">МАГАЗИН прибыль</th>
                    <!-- <th>ДОП <br> ДОХОДЫ</th> -->
                    <!-- <th rowspan="2">ДОХОДЫ</th> -->
                    <!-- <th rowspan="2">РАСХОДЫ</th> -->
                    <th rowspan="2">ПРИБЫЛЬ</th>
                    <!-- ЧИСТАЯ -->
                    <th rowspan="2">ПРИБЫЛЬ -3%</th>
                    <th rowspan="2">ВСЕ <br> КЛИЕНТЫ</th>
                    <!-- <th>НОВЫЕ <br> КЛИЕНТЫ</th> -->
                    <th rowspan="2">АУКЦИОНИСТ <br> ТЕХНИКА</th>
                    <th rowspan="2">АУКЦИОНИСТ <br> ШУБА</th>
                    <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                  </tr>
                  <tr>
                    <td class="bg-red">
                      По списку кол-во.
                    </td>
                    <td class="bg-red">
                      По списку СУММ.
                    </td>
                    <td class="info">
                      По факту кол-во.
                    </td>
                    <td class="info">
                      По факту СУММ.
                    </td>
                    <td class="info">
                      Аксессуары
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <?
                $result = R::getAll("SELECT COUNT(*) as count , SUM(p1), region FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND (region = 'Караганда' OR region = 'Кокшетау' OR region = 'Костанай' OR region = 'Павлодар' OR region = 'Нур-Султан') AND dataseg BETWEEN '$data_begin' AND '$data_end'  GROUP BY region  ");
                foreach($result as $data1) {
                ##################### Регион 
                $region = $data1['region'];
                #####################
                $data19 = R::getRow("SELECT SUM(proc) FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                ##################### Сумма процентов выкупленных товаров
                $result8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit),COUNT(*) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                $data8 =$result8[0];
                ##################### Сумма выдачи, сумма продажи и количество проданных товаров
                $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                $acc = $accsess[0];
                ##################### Сумма прихода и продажи товаров товаров
                $sales = R::getAll("SELECT SUM(pribl),COUNT(*) FROM sales WHERE regionlombard = '$region'  AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'   AND statustovar IS NULL ");
                $sale = $sales[0];
                ##################### Сумму и количество проданных товаров в магазине
                $auctioneer = R::getAll("SELECT SUM(auctioneer_fur), SUM(auctioneer_teh), SUM(cash_in_pledge_end),COUNT(*) as count FROM repotscom WHERE kassa = 'Касса 1' AND region = :region AND datereport = :datereport  GROUP BY region ",[':region'=>$region,':datereport'=>$data_end]);
                $auctioneer =$auctioneer[0]; 
                ############################## Аукционист шуб // Аукционист техники // Нал в залоге
                ?>
                  <tr>
                    <td><a class="btn btn-block bg-olive" href="viewreportregion03.php?region=<?= $data1['region']; ?>"><?= $data1['region']; ?></a></td>
                    <td>
                      <?echo number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' ');
                            $dohod += $data1['SUM(p1)'] + $data19['SUM(proc)'];?>
                    </td>
                    <td class="danger"><?= $sale['COUNT(*)'];
                                        $countml += $sale['COUNT(*)']; ?></td>
                    <td class="danger"><?= number_format($sale['SUM(pribl)'], 0, '.', ' ');
                                        $dohodml += $sale['SUM(pribl)']; ?></td>
                    <td><?= $data8['COUNT(*)'];
                        $countm += $data8['COUNT(*)']; ?></td>
                    <td>
                      <? echo number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' ');
                          $dohodm +=($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'];?>
                    </td>
                    <th>
                      <?= number_format($acc['SUM(price)'] - $acc['SUM(purchaseamount)'], 0, '.', ' ');
                      $accses_obs += ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);  ?>
                    </th>
                    <!-- <td>0</td> -->
                    <? $chistaya = $data1['SUM(p1)']+$data19['SUM(proc)']+($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)'])+$data8['SUM(profit)']-$data451['SUM(summa)']+($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);
                        $ch = percent_comiss($chistaya);
                        ?>
                    <th><?= number_format($chistaya, 0, '.', ' '); ?></th>
                    <td class="info">
                      <? echo number_format($ch, 0, '.', ' ');
                                $total_ch += $ch;?>
                    </td>
                    <td>
                      <?= number_format($data1['count'], 0, '.', ' ');
                      $count += $data1['count']; ?>
                    </td>
                    <td class="success">
                      <? echo number_format($auctioneer['SUM(auctioneer_teh)'], 0, '.', ' ');
                        $summa_vydachy += $auctioneer['SUM(auctioneer_teh)']; ?>
                    </td>
                    <td class="warning">
                      <? echo number_format($auctioneer['SUM(auctioneer_fur)'], 0, '.', ' ');
                          $summa_vydachy2 +=$auctioneer['SUM(auctioneer_fur)']; ?>
                    </td>
                    <td class="danger">
                      <? echo number_format($auctioneer['SUM(cash_in_pledge_end)'], 0, '.', ' ');
                         $summa_vydachy3 += $auctioneer['SUM(cash_in_pledge_end)'];
                        ?>
                    </td>
                  </tr>
                  <?};?>
                </tbody>
                <tfoot>
                  <tr class="bg-gray">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($dohod, 0, '.', ' '); ?></th>

                    <td class="bg-red"> <?= $countml; ?></td>
                    <th class="bg-red"><?= number_format($dohodml, 0, '.', ' '); ?></th>
                    <td> <?= $countm; ?></td>
                    <th><?= number_format($dohodm, 0, '.', ' '); ?></th>
                    <th><?= number_format($accses_obs, 0, '.', ' '); ?></th>
                    <!-- <th></th> -->
                    <!-- <th>0</th> -->
                    <th><?= number_format($dohodm + $dohod + $accses_obs, 0, '.', ' '); ?></th>
                    <td class="bg-blue"><?= number_format($total_ch, 0, '.', ' '); ?></td>
                    <th><?= number_format($count, 0, '.', ' '); ?></th>
                    <th><?= number_format($summa_vydachy, 0, '.', ' '); ?></th>
                    <th><?= number_format($summa_vydachy2, 0, '.', ' '); ?></th>
                    <th>
                      <?echo number_format($summa_vydachy3, 0, '.', ' '); unset($dohod,$dohodm,$count,$newclients,$summa_vydachy,$summa_vydachy2,$summa_vydachy3);?>
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
                    <th colspan="5" class="text-center">МАГАЗИН прибыль</th>
                    <!-- <th>ДОП <br> ДОХОДЫ</th> -->
                    <!-- <th rowspan="2">ДОХОДЫ</th> -->
                    <th>РАСХОДЫ</th>
                    <th rowspan="2">ПРИБЫЛЬ</th>
                    <th rowspan="2">ПРИБЫЛЬ-3 % </th>
                    <!-- ЧИСТАЯ -->
                    <th rowspan="2">ВСЕ <br> КЛИЕНТЫ</th>
                    <!-- <th>НОВЫЕ <br> КЛИЕНТЫ</th> -->
                    <th rowspan="2">АУКЦИОНИСТ <br> ТЕХНИКА</th>
                    <th rowspan="2">АУКЦИОНИСТ <br> ШУБА</th>
                    <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                  </tr>
                  <tr>
                    <td class="bg-red">
                      По списку кол-во.
                    </td>
                    <td class="bg-red">
                      По списку СУММ.
                    </td>
                    <td class="info">
                      По факту кол-во.
                    </td>
                    <td class="info">
                      По факту СУММ.
                    </td>
                    <td class="info">
                      Аксессуары
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <?
                    $result1 = R::findAll('comision2region',"data = ? AND region IS NOT NULL GROUP BY region",[$data_end]); 
                    foreach($result1 as $data2) {
                    $region = $data2['region'];
                    $sales = R::getAll("SELECT SUM(pribl),COUNT(*) FROM sales WHERE regionlombard = '$region' AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'  AND statustovar IS NULL   ");
                    $sale1 = $sales[0];
                    ?>
                  <tr>
                    <td><a class="btn btn-block bg-olive"><?= $data2['region']; ?></a></td>
                    <td>
                      <?= number_format($data2['comis'] + $data2['proc'], 0, '.', ' ');
                      $dohod1 += $data2['comis'] + $data2['proc']; ?>
                    </td>
                    <td class="danger"><?= $sale1['COUNT(*)'];
                                        $countml_tbs += $sale1['COUNT(*)']; ?></td>
                    <td class="danger"><?= number_format($sale1['SUM(pribl)'], 0, '.', ' ');
                                        $dohodml_tbs += $sale1['SUM(pribl)']; ?></td>
                    <td>
                      <?= $data2['sales'];
                      $count_sales += $data2['sales']; ?>
                    </td>
                    <td>
                      <?= number_format(($data2['cena_pr'] - $data2['sale']) + $data2['profit'], 0, '.', ' ');
                      $dohodm1 += ($data2['cena_pr'] - $data2['sale']) + $data2['profit'] + ($data2['price'] - $data2['purchaseamount']); ?>
                    </td>
                    <td>
                      <?= number_format($data2['price'] - $data2['purchaseamount'], 0, '.', ' ');
                      $accses_tbs += ($data2['price'] - $data2['purchaseamount']);  ?>
                    </td>
                    <!-- Аксесуары -->
                    <td>расход</td>
                    <? $chistaya1= $data2['comis']+$data2['proc']+($data2['cena_pr']-$data2['sale'])+$data2['profit'] + ($data2['price'] - $data2['purchaseamount']);
                         $tbs_chistaya = percent_comiss($chistaya1);
                          ?>
                    <th>
                      <?= number_format($chistaya1, 0, '.', ' '); ?></th>
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
                          $summa_vydachy21 +=$data2['shuby']; ?>
                    </td>
                    <td class="danger">
                      <? echo number_format($data2['nal'], 0, '.', ' ');
                         $summa_vydachy31 += $data2['nal'];
                        ?>
                    </td>
                  </tr>
                  <?};?>
                </tbody>
                <tfoot>
                  <tr class="bg-gray">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($dohod1, 0, '.', ' '); ?></th>
                    <th class="bg-red"><?= $countml_tbs; ?></th>
                    <th class="bg-red"><?= number_format($dohodml_tbs, 0, '.', ' '); ?></th>
                    <th><?= $count_sales; ?></th>
                    <th><?= number_format($dohodm1, 0, '.', ' '); ?></th>
                    <td>
                      <?= number_format($accses_tbs, 0, '.', ' '); ?>
                    </td>
                    <th><?= number_format($dohodm1 + $dohod1, 0, '.', ' '); ?></th>
                    <th class="bg-blue"><?= number_format($total_tbs_ch, 0, '.', ' '); ?></th>
                    <th><?= number_format($count1, 0, '.', ' '); ?></th>
                    <th><?= number_format($summa_vydachy1, 0, '.', ' '); ?></th>
                    <th><?= number_format($summa_vydachy21, 0, '.', ' '); ?></th>
                    <th><?= number_format($summa_vydachy31, 0, '.', ' '); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.content-wrapper -->
<? 
include "footer.php";  else :
header('Location: /');
endif; ?>