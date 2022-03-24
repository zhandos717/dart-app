<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
             function post($param){
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
              $i = 1;    
                while ($i <= 9) {
                      $region = [1=>'Атырау',2=>'Актобе',3=>'Актау',4=>'Шымкент',5=>'Алматы',6=>'Талдыкорган',7=>'Уральск',8=>'Семей',9=>'Тараз'];
                      $array = [
                      'token'=>'qfq5441fa65f4654w',
                      'region'=>$region[$i++],
                      'start'=>'2020-12-01',
                      'end'=>'2020-12-31',
                      ]; 
                      $arr = post($array);
                      $test=R::findOne('comision2region','region=? AND month = ?',[$arr['region'],12]);
                      if(empty($test)){
                        $test=R::dispense('comision2region');
                      };
                      $test->region         = $arr['region'];
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
                      $test->month          = 12;
                      R::store($test);
                 };
  if ($_SESSION['logged_user']->status == 3) :  ?>

<? include "header.php"; ?>
<? include "menu.php"; ?>

<? $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                        SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports122020  ");
  $data2 = mysqli_fetch_array($result2);
  $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
  $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
  $result = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
from reports122020  GROUP BY region  ");
  $ss = 0;
  $ss2 = 0;
  $ss3 = 0;
  while ($data1 = mysqli_fetch_array($result)) {
    $region =  $data1['region'];
    $result4 = mysqli_query($connect, "SELECT *FROM reports122020 WHERE region='$region' GROUP BY adress ");
    $s = 0;
    $s2 = 0;
    $s3 = 0;
    while ($data4 = mysqli_fetch_array($result4)) {
      $filial =  $data4['adress'];
      $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports122020 WHERE segdata=(SELECT MAX(segdata) FROM reports122020 WHERE region = '$region' AND adress = '$filial' ) ");
      $data5 = mysqli_fetch_array($result5);
      $s += $data5['auktech'];
      $s2 += $data5['aukshubs'];
      $s3 += $data5['nalvzaloge'];
    }
    $ss += $s;   //аукц т
    $ss2 += $s2; //ауц шубы
    $ss3 += $s3;  //нал в залоге
  }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Отчет за Декабрь 2020
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
          <a <?if ($_SESSION['logged_user']->fio == 'Шаграева Индира Бекмырзаевна'):?>href="torgi_lombard.php
            "
            <?endif;?> class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i>
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
                    <th colspan="4" class="text-center">Доход</th>
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
                    <!-- <th>ДОХОД КОМИССИОНКИ</th> -->
                    <th>ДОП</th>
                    <th>ИТОГ</th>
                    <th>ЛОМБАРДА (-20%)</th>
                    <th>TBS</th>
                    <th>OBS</th>
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
                                    FROM reports122020  GROUP BY region  ");
                    $ss = 0;
                    $ss2 = 0;
                    $ss3 = 0;
                    while ($data1 = mysqli_fetch_array($result)) {
                      $region =  $data1['region'];
                    ?>
                  <tr>
                    <td><a href="viewreportregion12.php?region=<?= $data1['region']; ?>"> <?= $data1['region']; ?></a></td>
                    <td>
                      <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
                    </td>
                    <td>
                      <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
                    </td>
                    <!-- <td>
                        <?= number_format($data1['SUM(dk)'], 0, '.', ' '); ?>
                      </td> -->
                    <td>
                      <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                    </td>
                    <td class="info">
                      <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                    </td>
                    <!--  <td><?= number_format($data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td> -->
                    <?
                        $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                        $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                        ?>
                    <!--  <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->
                    <td><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                    <td style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                    <?
                       $region1 = $region;

                      $reg = ['Нур-Султан','Костанай','Кокшетау','Павлодар','Караганда'];

                       if(in_array($region1,$reg)){
                       $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region1' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2020-12-01' AND '2020-12-31' ");
                       $data89 = mysqli_fetch_array($result12);
                       $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region = '$region1' AND status = '5' AND datesale BETWEEN '2020-12-01' AND '2020-12-31'  ");
                       $data81 = mysqli_fetch_array($result81);
                       $result19 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE region = '$region1' AND status = '4' AND datavykup BETWEEN '2020-12-01' AND '2020-12-31' ");
                       $data19 = mysqli_fetch_array($result19);
                       $obs = $data89['SUM(p1)']+$data19['SUM(proc)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)'])+$data81['SUM(profit)']-$data451['SUM(summa)'];                                                  // чистая прибыль  = за минусом 20 процентов
                      }else{
                        $da = R::findOne('comision2region',"month = 12 AND region = ? ",[$region1]);
                        $tbs= $da['comis']+$da['proc']+($da['cena_pr']-$da['sale'])+$da['profit']-$da['SUM(summa)'];
                      };?>

                    <th>
                      <?echo number_format($tbs, 0, '.', ' '); $tbsTotal += $tbs;  ?>
                    </th>
                    <th class="danger">
                      <?echo number_format($obs, 0, '.', ' '); $obsTotal += $obs;  ?>

                    </th>
                    <th class="success"><?= number_format($obs + $chistaya + $tbs, 0, '.', ' '); ?>
                      <?unset($obs,$tbs);?>
                    </th>
                    <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                    <?
                        $result4 = mysqli_query($connect, "SELECT *FROM reports122020 WHERE region='$region' GROUP BY adress ");
                        $s = 0;
                        $s2 = 0;
                        $s3 = 0;

                        while ($data4 = mysqli_fetch_array($result4)) {
                          $filial =  $data4['adress'];
                          $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports122020 WHERE segdata=(SELECT MAX(segdata) FROM reports122020 WHERE region = '$region' AND adress = '$filial' ) ");
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
                  </tr>
                  <?  } ?>
                </tbody>
                <tfoot>
                  <?
                    $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports122020  ");
                    $data2 = mysqli_fetch_array($result2);
                    ?>
                  <tr style="background: #d3d7df; color: black;">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                    <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                    <!-- <th><?= number_format($data2['SUM(dk)'], 0, '.', ' '); ?></th> -->
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
            <div class="">
              <table class="table table-bordered table-hover" style="white-space:nowrap;">
                <thead>
                  <tr style="background: #398ebd; color: white;">
                    <th>РЕГИОНЫ</th>
                    <th>ДОХОД <br> КОМИССИОНКИ</th>
                    <th>ДОХОД <br> МАГАЗИНА</th>
                    <th>ДОП <br> ДОХОДЫ</th>
                    <th>ДОХОДЫ</th>
                    <th>РАСХОДЫ</th>
                    <th>ЧИСТАЯ <br> ПРИБЫЛЬ</th>
                    <th>ВСЕ <br> КЛИЕНТЫ</th>
                    <th>НОВЫЕ <br> КЛИЕНТЫ</th>
                    <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                    <th>АУКЦИОНИСТ <br> ШУБА</th>
                    <th>НАЛ В <br> ЗАЛОГЕ</th>
                  </tr>
                </thead>
                <tbody>
                  <?$result = R::getAll("SELECT SUM(p1), region FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND (region = 'Караганда' OR region = 'Кокшетау' OR region = 'Костанай' OR region = 'Павлодар' OR region = 'Нур-Султан') AND dataseg BETWEEN '2020-12-01' AND '2020-12-31'  GROUP BY region  ");
                      foreach($result as $data1) {
                      // $city_north = ['Нур-Султан','Костанай','Павлодар','Кокшетау','Караганда'];
                      $region = $data1['region'];
                      // if(in_array($region, $city_north)){

                      $data89 = R::getAll("SELECT COUNT(*) as count ,SUM(summa_vydachy)  FROM tickets WHERE region = '$region' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2020-12-01' AND '2020-12-31' ");
                      $data89 =$data89[0];
                      $result19 =$mysqli->query("SELECT SUM(proc) FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '2020-12-01' AND '2020-12-31' ");
                      $data19 = mysqli_fetch_array($result19);
                      $result12 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND  (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы' ");
                      $data12 = mysqli_fetch_array($result12);
                      $result13 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND  status = '4' AND dataseg BETWEEN '2020-12-01' AND '2020-12-31' ");
                      $data13 = mysqli_fetch_array($result13);
                      $result122 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы'  ");
                      $data122 = mysqli_fetch_array($result122);
                      $result5 = mysqli_query($connect, " SELECT SUM(summa_vydachy) FROM tickets  WHERE region = '$region'  AND status = '2' AND dataseg BETWEEN '2020-12-01' AND '2020-12-31'  ");
                      $data5 = mysqli_fetch_array($result5);
                      $result8 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '2020-12-01' AND '2020-12-31'  ");
                      $data8 = mysqli_fetch_array($result8);
                      ?>
                  <tr>
                    <td><a class="btn btn-block bg-olive" href="viewreportregion12.php?region=<?if($data1['region'] == 'Нур-султан'){echo " Астана";}else { echo $data1['region']; };?>"><?= $data1['region']; ?></a></td>
                    <td>
                      <?echo number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' ');
                        $dohod += $data1['SUM(p1)'] + $data19['SUM(proc)'];?>
                    </td>
                    <td>
                      <? echo number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' ');
                      $dohodm +=($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'];?>
                    </td>
                    <td>0</td>
                    <td>
                      <? echo number_format($data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']), 0, '.', ' '); ?>
                    </td>
                    <? $chistaya = $data1['SUM(p1)']+$data19['SUM(proc)']+($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)'])+$data8['SUM(profit)']-$data451['SUM(summa)'];
                        ?>
                    <td>0</td>
                    <th style="background: #00c2f0; color: black;"><?= number_format($chistaya, 0, '.', ' '); ?></th>
                    <td>
                      <? echo number_format($data89['count'], 0, '.', ' ');
                            $count += $data89['count'];?>
                    </td>
                    <td>
                      <?echo number_format($data1['SUM(newclients)'], 0, '.', ' ');
                          $newclients += $data1['SUM(newclients)'];
                      ?>
                    </td>
                    <td style="background: #00a759; color: black;">
                      <? echo number_format($data12['SUM(summa_vydachy)'], 0, '.', ' ');
                    $summa_vydachy += $data12['SUM(summa_vydachy)']; ?>
                    </td>
                    <td style="background: #f39d0a; color: black;">
                      <? echo number_format($data122['SUM(summa_vydachy)'], 0, '.', ' ');
                      $summa_vydachy2 +=$data122['SUM(summa_vydachy)']; ?>
                    </td>
                    <td style="background: #de4936; color: black;">
                      <? echo number_format($data5['SUM(summa_vydachy)'], 0, '.', ' ');
                     $summa_vydachy3 += $data5['SUM(summa_vydachy)'];
                    ?>
                    </td>
                  </tr>
                  <?};?>
                </tbody>
                <tfoot>
                  <tr style="background: #d3d7df; color: black;">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohodm, 0, '.', ' '); ?></th>
                    <th>0</th>
                    <th><?= number_format($dohodm + $dohod, 0, '.', ' '); ?></th>
                    <td>0</td>
                    <th style="background: #00c2f0; color: black;"><strong><?= number_format($dohodm + $dohod, 0, '.', ' '); ?></strong></th>
                    <th><?= number_format($count, 0, '.', ' '); ?></th>
                    <th><?= number_format($newclients, 0, '.', ' '); ?></th>
                    <th style="background: #00a759; color: black;"><?= number_format($summa_vydachy, 0, '.', ' '); ?></th>
                    <th style="background: #f39d0a; color: black;"><?= number_format($summa_vydachy2, 0, '.', ' '); ?></th>
                    <th style="background: #de4936; color: black;">
                      <?echo number_format($summa_vydachy3, 0, '.', ' '); unset($dohod,$dohodm,$count,$newclients,$summa_vydachy,$summa_vydachy2,$summa_vydachy3);?>
                    </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
          <!--<div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li>

              </li>
            </ul>
          </div>-->
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
            <div class="">
              <table class="table table-bordered table-hover" style="white-space:nowrap;">
                <thead>
                  <tr style="background: #398ebd; color: white;">
                    <th>РЕГИОНЫ</th>
                    <th>ДОХОД <br> КОМИССИОНКИ</th>
                    <th>ДОХОД <br> МАГАЗИНА</th>
                    <th>ДОП <br> ДОХОДЫ</th>
                    <th>ДОХОДЫ</th>
                    <th>РАСХОДЫ</th>
                    <th>ЧИСТАЯ <br> ПРИБЫЛЬ</th>
                    <th>ВСЕ <br> КЛИЕНТЫ</th>
                    <th>НОВЫЕ <br> КЛИЕНТЫ</th>
                    <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                    <th>АУКЦИОНИСТ <br> ШУБА</th>
                    <th>НАЛ В <br> ЗАЛОГЕ</th>
                  </tr>
                </thead>
                <tbody>
                  <?$result1 = R::find('comision2region',"month = 12 GROUP BY region ORDER BY nal DESC "); //(region = 'Талдыкорган' OR region = 'Уральск' OR region = 'Атырау')
                      foreach($result1 as $data2) {
                        $region = $data2['region']; ?>
                  <tr>
                    <td><a class="btn btn-block bg-olive"><?= $data2['region']; ?></a></td>
                    <td>
                      <?echo number_format($data2['comis'] + $data2['proc'], 0, '.', ' ');
                        $dohod1 += $data2['comis'] + $data2['proc'];?>
                    </td>
                    <td>
                      <? echo number_format(($data2['cena_pr'] - $data2['sale']) + $data2['profit'], 0, '.', ' ');
                      $dohodm1 +=($data2['cena_pr'] - $data2['sale']) + $data2['profit'];?>
                    </td>
                    <td>0</td>
                    <td>
                      <? echo number_format($data2['comis'] + $data2['proc'] + ($data2['SUM(cena_pr)'] - $data2['SUM(summa_vydachy)']), 0, '.', ' '); ?>
                    </td>
                    <? $chistaya1= $data2['comis']+$data2['proc']+($data2['cena_pr']-$data2['sale'])+$data2['profit']-$data2['SUM(summa)'];
                        ?>
                    <td><?= number_format($data2['SUM(summa)'], 0, '.', ' '); ?></td>
                    <th style="background: #00c2f0; color: black;"><?= number_format($chistaya1, 0, '.', ' '); ?></th>
                    <td>
                      <? echo number_format($data2['count'], 0, '.', ' ');
                            $count1 += $data2['count'];?>
                    </td>
                    <td>
                      <? echo number_format($data2['count'], 0, '.', ' ');
                            $count1 += $data2['count'];?>
                    </td>
                    <td style="background: #00a759; color: black;">
                      <? echo number_format($data2['tehnica'], 0, '.', ' ');
                    $summa_vydachy1 += $data2['tehnica']; ?>
                    </td>
                    <td style="background: #f39d0a; color: black;">
                      <? echo number_format($data2['shuby'], 0, '.', ' ');
                      $summa_vydachy21 +=$data2['shuby']; ?>
                    </td>
                    <td style="background: #de4936; color: black;">
                      <? echo number_format($data2['nal'], 0, '.', ' ');
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
                    <th><?= number_format(0, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohodm1 + $dohod1, 0, '.', ' '); ?></th>
                    <td><?= number_format($data451['SUM(summa)'], 0, '.', ' '); ?></td>
                    <th style="background: #00c2f0; color: black;"><strong><?= number_format($dohodm1 + $dohod1, 0, '.', ' '); ?></strong></th>
                    <th><?= number_format($count1, 0, '.', ' '); ?></th>
                    <th><?= number_format($count1, 0, '.', ' '); ?></th>
                    <th style="background: #00a759; color: black;"><?= number_format($summa_vydachy1, 0, '.', ' '); ?></th>
                    <th style="background: #f39d0a; color: black;"><?= number_format($summa_vydachy21, 0, '.', ' '); ?></th>
                    <th style="background: #de4936; color: black;"><?= number_format($summa_vydachy31, 0, '.', ' '); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li>
                <!--  -->
              </li>
            </ul>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->


      <!--    <div class="col-xs-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title"> 2 КОМИССИОНКА до <b>16.12.2020 г. </b></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="">
              <table class="table table-bordered table-hover" style="white-space:nowrap;">
                <thead>
                  <tr style="background: #398ebd; color: white;">
                    <th>РЕГИОНЫ</th>
                    <th>ДОХОД <br> КОМИССИОНКИ</th>
                    <th>ДОХОД <br> МАГАЗИНА</th>
                    <th>ДОП <br> ДОХОДЫ</th>
                    <th>ДОХОДЫ</th>
                    <th>РАСХОДЫ</th>
                    <th>ЧИСТАЯ <br> ПРИБЫЛЬ</th>
                    <th>ВСЕ <br> КЛИЕНТЫ</th>
                    <th>НОВЫЕ <br> КЛИЕНТЫ</th>
                    <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                    <th>АУКЦИОНИСТ <br> ШУБА</th>
                    <th>НАЛ В <br> ЗАЛОГЕ</th>
                  </tr>
                </thead>
                <tbody>
                  <?$result1 = R::getAll("SELECT SUM(p1), region FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND NOT (region = 'Караганда' OR region = 'Кокшетау' OR region = 'Костанай' OR region = 'Павлодар' OR region = 'Нур-Султан' OR region = 'Тараз') AND dataseg BETWEEN '2020-12-01' AND '2020-12-31'  GROUP BY region  ");
                      foreach($result1 as $data1) {
                        $region = $data1['region'];
                      $result12 =$mysqli->query("SELECT COUNT(*) as count ,SUM(summa_vydachy)  FROM tickets WHERE region = '$region' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2020-12-01' AND '2020-12-31' ");
                      $data89 = mysqli_fetch_array($result12);
                      $result19 =$mysqli->query("SELECT SUM(proc) FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '2020-12-01' AND '2020-12-31' ");
                      $data19 = mysqli_fetch_array($result19);
                      $result12 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND  (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы' ");
                      $data12 = mysqli_fetch_array($result12);
                      //$result13 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND  status = '4' AND dataseg BETWEEN '2020-12-01' AND '2020-12-31' ");
                      //$data13 = mysqli_fetch_array($result13);
                      $result122 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы'  ");
                      $data122 = mysqli_fetch_array($result122);
                      $result5 = mysqli_query($connect, " SELECT SUM(summa_vydachy) FROM tickets  WHERE region = '$region'  AND status = '2' AND dataseg BETWEEN '2020-12-01' AND '2020-12-31'  ");
                      $data5 = mysqli_fetch_array($result5);
                      $result8 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '2020-12-01' AND '2020-12-31'  ");
                      $data8 = mysqli_fetch_array($result8);
                      ?>
                  <tr>
                    <td><a class="btn btn-block bg-olive" href="viewreportregion12.php?region=<?if($data1['region'] == 'Нур-султан'){echo " Астана";}else { echo $data1['region']; };?>"><?= $data1['region']; ?></a></td>
                    <td>
                      <?echo number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' ');
                        $dohod += $data1['SUM(p1)'] + $data19['SUM(proc)'];?>
                    </td>
                    <td>
                      <? echo number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' ');
                      $dohodm +=($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'];?>
                    </td>
                    <td>0</td>
                    <td>
                      <? echo number_format($data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']), 0, '.', ' '); ?>
                    </td>
                    <? $chistaya = $data1['SUM(p1)']+$data19['SUM(proc)']+($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)'])+$data8['SUM(profit)']-$data451['SUM(summa)'];
                        ?>
                    <td><?= number_format($data451['SUM(summa)'], 0, '.', ' '); ?></td>
                    <th style="background: #00c2f0; color: black;"><?= number_format($chistaya, 0, '.', ' '); ?></th>
                    <td>
                      <? echo number_format($data89['count'], 0, '.', ' ');
                            $count += $data89['count'];?>
                    </td>
                    <td>
                      <?echo number_format($data1['SUM(newclients)'], 0, '.', ' ');
                          $newclients += $data1['SUM(newclients)'];
                      ?>
                    </td>
                    <td style="background: #00a759; color: black;">
                      <? echo number_format($data12['SUM(summa_vydachy)'], 0, '.', ' ');
                    $summa_vydachy += $data12['SUM(summa_vydachy)']; ?>
                    </td>
                    <td style="background: #f39d0a; color: black;">
                      <? echo number_format($data122['SUM(summa_vydachy)'], 0, '.', ' ');
                      $summa_vydachy2 +=$data122['SUM(summa_vydachy)']; ?>
                    </td>
                    <td style="background: #de4936; color: black;">
                      <? echo number_format($data5['SUM(summa_vydachy)'], 0, '.', ' ');
                     $summa_vydachy3 += $data5['SUM(summa_vydachy)'];
                    ?>
                    </td>
                  </tr>
                  <?};?>
                </tbody>
                <tfoot>
                  <tr style="background: #d3d7df; color: black;">
                    <th>Итого (СУММА)</th>
                    <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohodm, 0, '.', ' '); ?></th>
                    <th><?= number_format(0, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohodm + $dohod, 0, '.', ' '); ?></th>
                    <td><?= number_format($data451['SUM(summa)'], 0, '.', ' '); ?></td>
                    <th style="background: #00c2f0; color: black;"><strong><?= number_format($dohodm + $dohod, 0, '.', ' '); ?></strong></th>
                    <th><?= number_format($count, 0, '.', ' '); ?></th>
                    <th><?= number_format($newclients, 0, '.', ' '); ?></th>
                    <th style="background: #00a759; color: black;"><?= number_format($summa_vydachy, 0, '.', ' '); ?></th>
                    <th style="background: #f39d0a; color: black;"><?= number_format($summa_vydachy2, 0, '.', ' '); ?></th>
                    <th style="background: #de4936; color: black;"><?= number_format($summa_vydachy3, 0, '.', ' '); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li>

              </li>
            </ul>
          </div>
        </div>
      </div> /.col -->


    </div><!-- /.row -->
</div><!-- /.content-wrapper -->


<? include "footer.php"; ?>
<? endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>
чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь
<? endif; ?>