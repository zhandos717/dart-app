<? //проверка существовании сессии
include("../../../bd.php");
if($_SESSION['logged_user']->status == 3) :
    $region = $_GET['region'];
      include "header.php";
      include "menu.php";
      function percent($number) {
        $percent = '20';
        $number_percent = $number / 100 * $percent;
        return $number - $number_percent;
      }



      $table = 'reports012021';
      $fil = R::findAll($table,'region = ? GROUP BY adress',[$region]);

      foreach ($fil as $value){
        $adress = R::findOne($table,'adress = ?  ORDER BY reg_date DESC',[$value['adress']]);
        $auktech += $adress['auktech'];
        $aukshubs += $adress['aukshubs'];
        $nalvzaloge += $adress['nalvzaloge'];
      }



      function post($param){
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
                                $filOne =R::findAll('kassa','region = ? GROUP BY filial',[$region]);
                                 foreach ($filOne as $find) {
                                              $array = [
                                              'token'=>'qfq5441fa65f4654w',
                                              'filial'=>$find['filial'],
                                              'start'=>'2021-01-01',
                                              'end'=>'2021-01-31'
                                              ];
                                              $arr = post($array);
                                              if(!empty($arr['summa_vydachy'])){
                                              $test=R::findOne('comision2','adress=?',[$find['filial']]);
                                              if(empty($test)){
                                                $test=R::dispense('comision2');
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
                                              $test->month          = 1;
                                              $test->sales          = $arr['sales'];
                                              R::store($test);
                                              }
                                    };
      $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                          SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports012021 WHERE `region`='$region'  ");
      $data2 = mysqli_fetch_array($result2);
      $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
      $chistaya = percent($pr);                                                  // чистая прибыль  = за минусом 20 процентов


      if($region != 'Караганда'){
        $comis2 = R::find('comision2',"region=:region GROUP BY adress ORDER BY nal DESC ",[':region'=>$region]);
      };

      ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Отчет за январь 2021
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
          <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= number_format($auktech, 0, '.', ' ');; ?> тг</h3>
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
            <h3><?= number_format($aukshubs, 0, '.', ' ');; ?> тг</h3>
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
            <h3><?= number_format($nalvzaloge, 0, '.', ' ');; ?> тг</h3>
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
          <!-- <div class="box-header">
            <h3 class="box-title"></h3>
          </div> -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="datatable-tabletools" style="white-space:nowrap;">
                <thead>
                  <tr class="bg-blue">
                    <th>Филиалы</th>
                    <th>Доход <br> ЛОМБАРДА</th>
                    <th>Доход <br> МАГАЗИНА</th>
                    <th>ДОП <br> Доход</th>
                    <th>ИТОГ</th>
                    <th>РАСХОДЫ</th>
                    <th>ЛОМБАРДА (-20%)</th>
                    <th>КОМИССИОНКА (-20%)</th>
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
                   $result = mysqli_query($connect, " SELECT id, region,adress, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                       FROM reports012021 WHERE region = '$region'  GROUP BY adress  ");
                   while ($data1 = mysqli_fetch_array($result)) {
                    $region =  $data1['region'];
                    $adress=  $data1['adress'];
                    $table =R::getCol('SELECT SUM(tekrashod),adress FROM comisstest WHERE adress=?',[$adress]);
                    $ras =$table[0];
                    $res = R::getRow("SELECT * FROM reports012021 WHERE adress = '$adress' ORDER BY id DESC LIMIT 1");
                    if($adress == 'Тауелсыздык 45/1'){
                    $adress1 = 'Тауелсыздык 45';
                    }elseif($adress == 'Шахтеров (Ермекова) 52'){
                    $adress1 = 'Шахтеров 52';
                    }elseif($adress == 'Назарбекова 11 (Нурсат)'){
                    $adress1 = 'Назарбекова 11';
                    }elseif($adress == 'Уалиханова 192 (11 мкрн)'){
                    $adress1 = 'Уалиханова 192';
                    }else {
                    $adress1 = $adress;
                    }
                    $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                    $chistaya_lombard = percent($pr);
                    $region1 = $region;
                    if(!empty($comis2)){
                        $tbs_reg = R::findOne('comision2','adress=?',[$adress1]);
                    };
                    if(!empty($tbs_reg)){
                    $chistaya1= $tbs_reg['comis']+$tbs_reg['proc']+($tbs_reg['cena_pr']-$tbs_reg['sale'])+$tbs_reg['profit']-$tbs_reg['SUM(summa)']-$ras;
                    }else {
                    if($region1 == 'Астана'){$region1= 'Нур-султан';};
                    $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-01-01' AND '2021-01-31' ");
                    $data89 = mysqli_fetch_array($result12);
                    $result19 =$mysqli->query("SELECT SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND status = '4' AND datavykup BETWEEN '2021-01-01' AND '2021-01-31' ");
                    $data19 = mysqli_fetch_array($result19);
                    $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress1' AND status = '5' AND datesale BETWEEN '2021-01-01' AND '2021-01-31'  ");
                    $data81 = mysqli_fetch_array($result81);
                    $chistaya1 = $data89['SUM(p1)']+$data19['SUM(proc)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)'])+$data81['SUM(profit)']-$ras; // чистая прибыль  = за минусом 20 процентов
                    }
                    $chistaya1 = percent($chistaya1);
                    ?>
                  <tr>
                    <td><a href="viewfilial01.php?region=<?= $region; ?>&adress=<?= $data1['adress']; ?>"><?= $data1['adress']; ?></a></td>
                    <td>
                      <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
                    </td>
                    <td>
                      <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
                    </td>
                    <td>
                      <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                    </td>
                    <td class="info">
                      <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                    </td>
                    <td><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                    <td style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya_lombard, 0, '.', ' '); ?></strong></td>
                    <th class="danger"><?= number_format($chistaya1, 0, '.', ' ');
                                        $chistaya_tbs += $chistaya1; ?></th>
                    <th class="success"><?= number_format($chistaya_lombard + $chistaya1, 0, '.', ' '); ?></th>
                    <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                    <td style="background: #00a759; color: black;"><?= number_format($res['auktech'], 0, '.', ' ');; ?></td>
                    <td style="background: #f39d0a; color: black;"><?= number_format($res['aukshubs'], 0, '.', ' ');; ?></td>
                    <td style="background: #de4936; color: black;"><?= number_format($res['nalvzaloge'], 0, '.', ' ');; ?></td>
                  </tr>
                  <? } ?>
                </tbody>
                <tfoot>
                  <tr class="bg-gray">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                    <!-- <th><?= number_format($data2['SUM(dk)'], 0, '.', ' '); ?></th> -->
                    <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                    <!--    <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                       <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th> -->
                    <!--   <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->
                    <th><?= number_format($data2['SUM(stabrashod)'] + $data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
                    <th style="background: #00c2f0; color: black;"><?= number_format($chistaya, 0, '.', ' '); ?></th>
                    <th class="danger"><?= number_format($chistaya_tbs, 0, '.', ' '); ?></th>
                    <th class="success"><?= number_format($chistaya_tbs + $chistaya, 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
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
      <?if($comis2){?>
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
            <div class="">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class="bg-blue">
                    <th>РЕГИОНЫ</th>
                    <th>ДОХОД <br> КОМИССИОНКИ</th>
                    <th>ДОХОД <br> МАГАЗИНА</th>
                    <th>РАСХОДЫ</th>
                    <th>ДОХОДЫ</th>
                    <th>ПРИБЫЛЬ - 20%</th>
                    <th>ВСЕ <br> КЛИЕНТЫ</th>
                    <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                    <th>АУКЦИОНИСТ <br> ШУБА</th>
                    <th>НАЛ В <br> ЗАЛОГЕ</th>
                  </tr>
                </thead>
                <tbody>
                  <?  foreach($comis2 as $data2) {

                      $table =R::getCol('SELECT SUM(tekrashod) FROM comisstest WHERE adress=?',[$data2['adress']]);
                      $ras =$table[0];

                      $dohod = $data2['comis'] + $data2['proc'] + ($data2['cena_pr'] - $data2['sale']) + $data2['profit']-$ras;
                      $chistaya_tbs = percent($dohod);
                      ?>
                  <tr style="white-space:nowrap;">
                    <td><a class="btn btn-block bg-olive"><?= $data2['adress']; ?></a></td>
                    <td>
                      <?= number_format($data2['comis'] + $data2['proc'], 0, '.', ' ');
                      $dohod1 += $data2['comis'] + $data2['proc']; ?>
                    </td>
                    <td>
                      <? echo number_format(($data2['cena_pr'] - $data2['sale']) + $data2['profit'], 0, '.', ' ');
                      $dohodm1 +=($data2['cena_pr'] - $data2['sale']) + $data2['profit'];?>
                    </td>
                    <td><?= number_format($ras, 0, '.', ' ');
                        $ras_tbs += $ras; ?></td>
                    <td>
                      <? echo number_format($dohod, 0, '.', ' '); ?>
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
                      ?>
                    </td>
                  </tr>
                  <?};?>
                </tbody>
                <tfoot>
                  <tr style="background: #d3d7df; color: black;">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($dohod1, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohodm1, 0, '.', ' '); ?></th>
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

      <?}else {?>
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
                    <th>ДОХОДЫ</th>
                    <th>РАСХОДЫ</th>
                    <th>ПРИБЫЛЬ - 20%</th>
                    <th>ВСЕ <br> КЛИЕНТЫ</th>
                    <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                    <th>АУКЦИОНИСТ <br> ШУБА</th>
                    <th>НАЛ В <br> ЗАЛОГЕ</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                   $result = mysqli_query($connect, " SELECT SUM(p1), region,adressfil FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-01-01' AND '2021-01-31' AND region = '$region1'  GROUP BY adressfil  ");
                  while ($data1 = mysqli_fetch_array($result)) {
                     $adress = $data1['adressfil'];
                     $region = $data1['region'];
                     $result19 = mysqli_query($connect, " SELECT SUM(proc) FROM tickets WHERE status = '4' AND adressfil = '$adress' AND datavykup BETWEEN '2021-01-01' AND '2021-01-31'  ");
                     $data19 = mysqli_fetch_array($result19);
                     $result12 =$mysqli->query("SELECT COUNT(*) as count ,SUM(summa_vydachy)  FROM tickets WHERE adressfil = '$adress' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-01-01' AND '2021-01-31' ");
                     $data89 = mysqli_fetch_array($result12);
                     $result12 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы' ");
                     $data12 = mysqli_fetch_array($result12);
                     $result13 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  status = '4' AND dataseg BETWEEN '2021-01-01' AND '2021-01-31' ");
                     $data13 = mysqli_fetch_array($result13);
                     $result122 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы'  ");
                     $data122 = mysqli_fetch_array($result122);
                     $result5 = mysqli_query($connect, " SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress'  AND status = '2' AND dataseg BETWEEN '2021-01-01' AND '2021-01-31'  ");
                     $data5 = mysqli_fetch_array($result5);
                     $result8 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress' AND status = '5' AND datesale BETWEEN '2021-01-01' AND '2021-01-31'  ");
                     $data8 = mysqli_fetch_array($result8);
                    $table =R::getCol('SELECT SUM(tekrashod) FROM comisstest WHERE adress=?',[$adress]);
                    $ras =$table[0];

                    $chistaya = $data1['SUM(p1)']+$data19['SUM(proc)']+($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)'])+$data8['SUM(profit)']- $ras;
                    $chistaya = percent($chistaya);
                   ?>
                  <tr>
                    <td><a href="#" class="btn btn-block bg-olive"> <?= $data1['adressfil']; ?></a></td>
                    <td>
                      <?= number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' ');
                      $dohod_obs += $data1['SUM(p1)'] + $data19['SUM(proc)']; ?>
                    </td>
                    <td>
                      <?= number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' ');
                      $dohod_mag_obs += ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)']; ?>
                    </td>
                    <td>
                      <?= number_format($data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']), 0, '.', ' '); ?>
                    </td>
                    <td><?= number_format($ras, 0, '.', ' ');
                        $ras_obs += $ras; ?></td>
                    <th class="bg-blue"><?= number_format($chistaya, 0, '.', ' ');
                                        $chistaya_obs += $chistaya; ?></th>
                    <td><?= number_format($data89['count'], 0, '.', ' ');
                        $count_cl += $data89['count']; ?></td>
                    <td class="success"><?= number_format($data12['SUM(summa_vydachy)'], 0, '.', ' ');
                                        $tehnica_obs += $data12['SUM(summa_vydachy)']; ?></td>
                    <td class="warning"><?= number_format($data122['SUM(summa_vydachy)'], 0, '.', ' ');
                                        $shuby_obs += $data122['SUM(summa_vydachy)']; ?></td>
                    <td class="danger"><?= number_format($data5['SUM(summa_vydachy)'], 0, '.', ' ');
                                        $nal_obs += $data5['SUM(summa_vydachy)']; ?></td>
                  </tr>
                  <?}?>
                </tbody>
                <tfoot>
                  <tr class="bg-gray">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($dohod_obs, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohod_mag_obs, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohod_obs + $dohod_mag_obs, 0, '.', ' '); ?></th>
                    <td><?= number_format($ras_obs, 0, '.', ' '); ?></td>
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
      <?}?>
    </div><!-- /.row -->
</div><!-- /.content-wrapper -->
<?
include "footer.php";
  else :
  header('Location: index.php');
endif; ?>
