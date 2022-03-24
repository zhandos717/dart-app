<? //проверка существовании сессии
include("../../bd.php");
if($_SESSION['logged_user']->status == 3) :
    $region = $_GET['region'];
      include "header.php";
      include "menu.php";

  $table = 'reports';

  function percent($number, $percent){
    return  $number - ($number / 100 * $percent);
  }

      $data_begin = $_GET['data_begin']; //Дата начало
      $data_end   = $_GET['data_end']; //Дата конец
      $month = date('m');
      $day =  date('Y-m-d');

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
                    'start'=>$data_begin,
                    'end'=>$data_end,
                  ];

                  $arr = post($array);
                 if(!empty($arr['summa_vydachy'])){
                  $test=R::findOne('comision2','adress=? AND day =? ',[$find['filial'],$day]);
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
                  $test->month          = $month;
                  $test->sales          = $arr['sales'];
                  $test->day            = $day;
                  R::store($test);
                  }
        };
      if($region != 'Караганда' AND  $region != 'Нур-Султан'){
        $comis2 = R::findAll('comision2', "region=:region AND day =:day GROUP BY adress",[ ':region'=>$region, ':day'=>$day]);
      };
      ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Отчет по филиалам города <?=$region;?> на период с <?=date("d.m.Y", strtotime($data_begin));?> по <?=date("d.m.Y", strtotime($data_end));?>
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
            <h3 class="box-title">asdfasdf</h3>
          </div> -->
          <div class="box-body">
            <div class="">
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
                   $result = R::getAll(" SELECT id, region,adress, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                       FROM reports WHERE region = '$region' AND data BETWEEN '$data_begin' AND '$data_end'  GROUP BY adress  ");
                   foreach ($result as $data1){
                    $region =  $data1['region'];
                    $adress=  $data1['adress'];
                    $nal = R::findOne('reports','adress =? ORDER BY data DESC LIMIT 1',[$adress]);
                    $table =R::getCol("SELECT SUM(tekrashod),adress FROM comisstest WHERE adress=? AND data BETWEEN '$data_begin' AND '$data_end' ",[$adress]);
                    $ras =$table[0];
                    $res = R::getRow("SELECT * FROM reports WHERE adress = '$adress' ORDER BY reg_date DESC LIMIT 1");
                    if($adress == 'Шахтеров (Ермекова) 52'){
                    $adress1 = 'Шахтеров 52';
                    }elseif($adress == 'Назарбекова 11 (Нурсат)'){
                    $adress1 = 'Назарбекова 11';
                    }elseif($adress == 'Уалиханова 192 (11 мкрн)'){
                    $adress1 = 'Уалиханова 192';
                    }else {
                    $adress1 = $adress;
                    }
                    $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                    $chistaya_lombard = percent($pr,20);

                    if(!empty($comis2)){
                      $tbs_reg = R::findOne('comision2', "adress=:adress AND day =:day ORDER BY id DESC ",[':adress'=> $adress, ':day'=>$day]);

                      $chistaya1= $tbs_reg['comis']+$tbs_reg['proc']+($tbs_reg['cena_pr']-$tbs_reg['sale'])+$tbs_reg['profit']-$ras;
                    }else {
                    $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND NOT (status = '11' OR status = '1') AND dataseg BETWEEN '$data_begin' AND '$data_end' ");
                    $data89 = mysqli_fetch_array($result12);
                    $result19 =$mysqli->query("SELECT SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                    $data19 = mysqli_fetch_array($result19);
                    $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress1' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                    $data81 = mysqli_fetch_array($result81);
                    $chistaya1 = $data89['SUM(p1)']+$data19['SUM(proc)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)'])+$data81['SUM(profit)']-$ras; // чистая прибыль  = за минусом 20 процентов
                    }
                    $chistaya1 = percent($chistaya1,3);
                    $dl += $data1['SUM(dl)'];
                    $dm += $data1['SUM(dm)'];
                    $dop += $data1['SUM(dop)'];
                    $dohod += $data1['SUM(dohod)'];
                    $rashod += $data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'];
                    $chistaya_lombard_total += $chistaya_lombard;
                    $allclients += $data1['SUM(allclients)'];
                    $newclients += $data1['SUM(newclients)'];
                    $chv += $data1['SUM(chv)'];
                    $auktech += $nal['auktech'];
                    $aukshubs += $nal['aukshubs'];
                    $nalvzaloge += $nal['nalvzaloge'];
                    ?>
                  <tr>
                    <td>
                      <!-- <a href="viewfilial.php?region=<?= $region; ?>&adress=<?= $data1['adress']; ?>"> -->
                        <?= $data1['adress']; ?>
                      <!-- </a> -->
                    </td>
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
                    <th><?= number_format($dop, 0, '.', ' '); ?></th>
                    <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                    <th><?= number_format($rashod, 0, '.', ' '); ?></th>
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
          </div>
        </div>
      </div>

    </div>
</div>
<?
include "footer.php";
  else :
  header('Location: index.php');
endif; ?>
