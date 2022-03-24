<?php

list($data1, $data2) = !empty($_GET['date1']) ? [$_GET['date1'], $_GET['date2']] : [date('Y-m-01'), date('Y-m-d')];

$result = R::getAll("SELECT region, MIN(summstart), SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome),SUM(summstart),SUM(endsumm) 
FROM repotscom 
WHERE NOT region IS NULL 
AND  datereport BETWEEN '$data1' AND '$data2'  
GROUP BY region ");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Движение денежных средств
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
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Выберите период</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
            </div>
          </div>
          <div class="box-body">
            <form action="a_report.php" method="GET">
              <input type="text" hidden name="id" value="1">
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" value="<?= $data1; ?>" name="date1">
                </div>
                <!-- /input-group -->
              </div>

              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" value="<?= $data2; ?>" name="date2">
                </div>
                <!-- /input-group -->
              </div>

              <div class="input-group input-group-sm">
                <!-- <span class="input-group-btn">     </span> -->
                <button type="submit" class="btn-success btn ">Подтвердить!</button>
              </div>
            </form>
          </div>
          <!--.box-body -->
        </div>
        <!--.box -->
      </div>
      <!--------------------------------------------------------------------------->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title text-center"><b> Отчет комисcионного магазина c <?= date("d.m.Y", strtotime($data1)); ?> по <?= date("d.m.Y", strtotime($data2)); ?> </b></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="">
              <table id="datatable-tabletools" class="tableas table table-hover table-bordered text-center">
                <thead>
                  <tr>
                    <th rowspan="2" class="success">№</th>
                    <th rowspan="2" class="success">Регион</th>
                    <th rowspan="2" class="success">Касса на начало периода</th>
                    <th rowspan="2" class="success">Выдано кредитов</th>
                    <th rowspan="2" class="success">Возвращено кредитов</th>
                    <th rowspan="2" class="success">Пополнение кассы</th>
                    <th rowspan="2" class="success">Изъятие из кассы</th>
                    <th rowspan="2" class="success">Касса на конец периода</th>
                    <th rowspan="2" class="success" style="width:10rem;"> Изъятие товара</th>
                    <th rowspan="2" class="success">Вознаграждение %</th>
                    <th rowspan="2" class="success" style="width:10rem;">% при рассторжение на срок договора</th>
                    <th colspan="2" class="success">Релизация</th>
                    <th rowspan="2" class="success">Кредитный портфель</th>
                  </tr>
                  <tr>
                    <th class="danger">Выручка</th>
                    <th class="danger">Прибыль</th>
                  </tr>

                </thead>
                <tbody style="white-space:nowrap;">
                  <?
                  $i = 1;
                  foreach ($result as $data) {
                    $region = $data['region'];
                    $summstart_region = R::getCell("SELECT SUM(summstart) FROM repotscom WHERE region='$region'   AND datereport = '$data1' ");
                    $endsumm_region = R::getCell("SELECT SUM(endsumm) FROM repotscom WHERE region='$region'   AND datereport = '$data2' ");
                    $p1_ticket = R::getCell("SELECT SUM(p1)  FROM tickets WHERE NOT status IN (1,11) AND region='$region'  AND  dataseg BETWEEN '$data1' AND  '$data2' ");
                    $proc_ticket = R::getCell("SELECT SUM(proc)  FROM tickets WHERE  status = 4 AND region='$region' AND  datavykup BETWEEN '$data1' AND  '$data2' ");
                  ?>
                    <tr>
                      <td><?= $i++; ?>.</td>
                      <td>
                        <a type="button" href="a_report.php?id=3&region=<?= $data['region']; ?>&date1=<?= $data1 ?>&date2=<?= $data2 ?>" class="btn  btn-block bg-olive btn-flat"><b><?= $data['region']; ?></b></a>
                      <td><?= number_format($summstart_region, 0, '.', ' ');
                          $summstart += $summstart_region; ?></td>
                      <td><?= number_format($data['SUM(vydacha)'], 0, '.', ' ');
                          $vydacha += $data['SUM(vydacha)']; ?></td>
                      <td><?= number_format($data['SUM(vozvrat)'], 0, '.', ' ');
                          $vozvrat += $data['SUM(vozvrat)']; ?></td>
                      <td><?= number_format($data['SUM(finhelp)'], 0, '.', ' ');
                          $finhelp += $data['SUM(finhelp)']; ?></td>
                      <td><?= number_format($data['SUM(withdrawal)'], 0, '.', ' ');
                          $withdrawal += $data['SUM(withdrawal)'];  ?></td>
                      <td><?= number_format($endsumm_region, 0, '.', ' ');
                          $endsumm += $endsumm_region;  ?></td>
                      <td>0</td>
                      <td>
                        <? if ($data['SUM(comis)'] == $p1_ticket) {
                          echo number_format($data['SUM(comis)'], 0, '.', ' ');
                        } else {

                          echo 'Сумма в отчете: ' . number_format($data['SUM(comis)'], 0, '.', ' ');
                          echo '<br>';
                          echo 'Сумма в сводке: ' . number_format($p1_ticket, 0, '.', ' ');


                          echo '<br> Есть расхождение на сумму: ' . ($data['SUM(comis)'] - $p1_ticket);
                        };
                        $comis += $data['SUM(comis)']; ?>
                      </td>
                      <td>

                        <? if ($data['SUM(proc)'] == $proc_ticket) {
                          echo number_format($data['SUM(proc)'], 0, '.', ' ');
                        } else {

                          echo 'Сумма в отчете: ' . number_format($data['SUM(proc)'], 0, '.', ' ');
                          echo '<br>';
                          echo 'Сумма в сводке: ' . number_format($proc_ticket, 0, '.', ' ');

                          echo '<br> Есть расхождение на сумму: ' . ($data['SUM(proc)'] - $proc_ticket);
                        };

                        $proc += $proc_ticket; ?>
                      </td>
                      <td><?= number_format($data['SUM(summsale)'], 0, '.', ' ');
                          $summsale += $data['SUM(summsale)']; ?></td>
                      <td><?= number_format($data['SUM(salesincome)'], 0, '.', ' ');
                          $salesincome += $data['SUM(salesincome)']; ?></td>
                      <td>0</td>
                    </tr>
                  <? } ?>
                </tbody>
                <tfoot>
                  <tr style="white-space:nowrap;">
                    <th colspan="2"> Итого:</th>
                    <th><?= number_format($summstart, 0, '.', ' '); ?></th>
                    <th><?= number_format($vydacha, 0, '.', ' '); ?></th>
                    <th><?= number_format($vozvrat, 0, '.', ' '); ?></th>
                    <th><?= number_format($finhelp, 0, '.', ' '); ?></th>
                    <th><?= number_format($withdrawal, 0, '.', ' '); ?></th>
                    <th><?= number_format($endsumm, 0, '.', ' '); ?></th>
                    <th>0</th>
                    <th><?= number_format($comis, 0, '.', ' '); ?></th>
                    <th><?= number_format($proc, 0, '.', ' '); ?></th>
                    <th><?= number_format($summsale, 0, '.', ' '); ?></th>
                    <th><?= number_format($salesincome, 0, '.', ' '); ?></th>
                    <th>0</th>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.table-responsive -->
          </div><!-- /.box-body -->
        </div><!-- /.box box-primary -->

      </div><!-- /.col-md-6 -->
      <!--------------------------------------------------------------------------->
    </div><!-- /.content-wrapper -->
  </section>
</div>