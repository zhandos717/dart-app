<?php
include("../../bd.php");
if ($_SESSION['logged_user']->status == 1) :

  // include "header.php";
  // include "menu.php";

  function percent(int $number, int $percent): int
  {
    $result = $number - ($number / 100 * $percent);
    return $result > 0 ? $result : $number;
  }


  $result = R::getAll(" SELECT
              SUM(dl),SUM(dm),SUM(dop), SUM(dk),
              SUM(dohod),SUM(stabrashod),SUM(tekrashod),
              SUM(allclients),SUM(newclients),SUM(vzs),
              SUM(vozvrat),SUM(nakladnoy),COUNT(adress),
              SUM(chv), data
                  FROM reports WHERE adress = ? ",[$adress]);

  $data1 = $result[0];

  $start = $data1['data'] ? date("Y-m-01", strtotime($data1['data'])) : date('Y-m-01');
  $end  =  $data1['data'] ?  date("Y-m-t", strtotime($data1['data'])) : date('Y-m-t');

  $costs = R::getCell("SELECT SUM(summarf) FROM rashodfillial WHERE adress = ? AND datarashoda BETWEEN '$start' AND '$end'", [$adress]);


  $chistaya = percent($data1['SUM(dohod)'] - $costs, 20);

  $data5 = R::findOne('reports', "adress = ? ORDER BY data DESC", [$adress]);

  $reg = R::getCol('SELECT region FROM kassa WHERE status = 1 GROUP BY region');

  if (in_array($region, $reg)) {
    $data89 = R::getAll("SELECT COUNT(*) as count ,SUM(summa_vydachy)  FROM tickets WHERE adressfil = '$adress' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$start' AND '$end' ");
    $data11 = R::getCol(" SELECT SUM(p1) FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$start' AND '$end' AND adressfil = '$adress'  ");
    $data19 = R::getCol(" SELECT SUM(proc) FROM tickets WHERE status = '4'  AND datavykup BETWEEN '$start' AND '$end' AND adressfil = '$adress'  ");

    $data122 = R::getCol("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND status IN (7,10,14,15) AND type = 'Шубы'  ");

    $data55 = R::getCol("SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress'  AND status = '2' ");
    $data8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress' AND status = '5' AND datesale BETWEEN '$start' AND '$end'  ");

    $shuby = $data122[0];


    $nal =  R::getCell("SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress'  AND status = '2' ");

    $tehnica = R::getCell("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  status IN (7,10,14,15) AND NOT type = 'Шубы' ");

    $proc = $data19[0];
    $comis = $data11[0];
    $count = $data89[0]['count'];
    $summa_vydachy = $data89[0]['summa_vydachy'];
    $sale = $data8[0]["SUM(summa_vydachy)"];
    $cena_pr = $data8[0]["SUM(cena_pr)"];
    $chistaya1 = percent(($cena_pr - $sale) + ($comis + $proc) - $ras, 3);
  } else {
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
    $array = [
      'token' => 'qfq5441fa65f4654w',
      'filial' => $adress,
      'start' => $start,
      'end' => $end
    ];
    $arr = post($array);
    $day = date('Y-m-d');
    $month  = date('m');
    $test = R::findOne('comision2', 'adress=:adress AND month = :month AND day = :day', [':adress' => $adress, ':month' => $month, ':day' => $day]);
    if (empty($test)) {
      $test = R::dispense('comision2');
    };
    $test->region         = $region;
    $test->adress         = $adress;
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
    $test->day          = $day;
    R::store($test);
    $shuby = $arr['shuby'];
    $nal =  $arr['nal'];
    $sale = $arr['sale'];
    $cena_pr = $arr['cena_pr'];
    $vozvrat = $arr['vozvrat'];
    $tehnica = $arr['tehnica'];
    $proc = $arr['proc'];
    $count = $arr['count'];
    $comis = $arr['comis'];
    $summa_vydachy = $arr['summa_vydachy'];
    $chistaya1 = percent(($cena_pr - $sale) + ($comis + $proc) - $ras, 3);
  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $region; ?>/<?= $adress; ?> с <?= $start ?> по <?= $end ?>
        <small><a href="index.php">назад к списку</a></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регионы</a></li>
        <li class="active">Филиалы</li>
      </ol>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Отчет за ломбард </h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th><?= $adress; ?></th>
                        <th class="info">Ломбард</th>
                        <th class="warning">Комиссионка </th>
                        <th class="danger">ИТОГ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>ДОХОД</th>
                        <td class="info"><?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?></td>
                        <td class="warning"> <?= number_format($comis + $proc, 0, '.', ' '); ?> </td>
                        <td class="danger"><?= number_format($data1['SUM(dl)'] + $comis + $proc, 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>ДОХОД МАГАЗИНА</th>
                        <td class="info"><?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format($cena_pr - $sale, 0, '.', ' '); ?> </td>
                        <td class="danger"><?= number_format($data1['SUM(dm)'] + ($cena_pr - $sale) + $data8['SUM(profit)'], 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>ДОП ДОХОДЫ</th>
                        <td class="info"><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
                        <td class="warning">0</td>
                        <td class="danger"><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>ДОХОДЫ</th>
                        <td class="info"><?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format(($cena_pr - $sale) + ($comis + $proc), 0, '.', ' '); ?> </td>
                        <td class="danger"><?= number_format((($cena_pr - $sale) + ($comis + $proc)) + $data1['SUM(dohod)'], 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>РАСХОДЫ</th>
                        <!-- <td class="info"><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td> -->
                        <td class="info"><?= number_format($costs, 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format($ras, 0, '.', ' '); ?></td>
                        <!-- <td class="danger"><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'] + $ras, 0, '.', ' '); ?></td> -->
                        <td class="danger"><?= number_format($costs + $ras, 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>ЧИСТАЯ ПРИБЫЛЬ (-20%)</th>
                        <td class="info"><?= number_format($chistaya, 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format($chistaya1, 0, '.', ' '); ?></td>
                        <td class="danger"><?= number_format($chistaya + $chistaya1, 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>ВСЕ КЛИЕНТЫ</th>
                        <td class="info"><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format($count, 0, '.', ' '); ?></td>
                        <td class="danger"><?= number_format($data1['SUM(allclients)'] + $count, 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>НОВЫЕ КЛИЕНТЫ</th>
                        <td class="info"><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                        <td class="warning">-</td>
                        <td class="danger"><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>ЧИСТАЯ ВЫДАЧА</th>
                        <td class="info"><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                        <td class="warning">-</td>
                        <td class="danger"><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                      </tr>
                      <tr>
                        <th>АУКЦИОНИСТ ТЕХНИКА</th>
                        <td class="info"><?= number_format($data5['auktech'], 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format($tehnica, 0, '.', ' ');; ?></td>
                        <td class="danger"><?= number_format($tehnica + $data5['auktech'], 0, '.', ' ');; ?></td>
                      </tr>
                      <tr>
                        <th>АУКЦИОНИСТ ШУБА</th>
                        <td class="info"><?= number_format($data5['aukshubs'], 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format($shuby, 0, '.', ' ');; ?></td>
                        <td class="danger"><?= number_format($data5['aukshubs'] + $shuby, 0, '.', ' ');; ?></td>
                      </tr>
                      <tr>
                        <th>НАЛ В ЗАЛОГЕ</th>
                        <td class="info"><?= number_format($data5['nalvzaloge'], 0, '.', ' '); ?></td>
                        <td class="warning"><?= number_format($nal, 0, '.', ' '); ?></td>
                        <td class="danger"><?= number_format($data5['nalvzaloge'] + $nal, 0, '.', ' '); ?></td>
                      </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section>
  </div><!-- /.content-wrapper -->
<? include "footer.php";
else :
  header('Location: /');
endif; ?>