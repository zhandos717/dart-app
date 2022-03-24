<? //проверка существовании сессии
  $today = date('Y-m-d');
  $region = $_GET['region'];
  if(!empty($_GET['start'])){
                          $data1 = $_GET['start'];
                          $data2 = $_GET['end'];
                        } else {
                          $data1 = $today;
                          $data2 = $today;
                        };
    $result = R::getAll("SELECT region,adress, MIN(summstart),SUM(cash_in_pledge_end), SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome),SUM(summstart),SUM(endsumm) 
    FROM repotscom 
    WHERE region = :region  
    AND datereport 
    BETWEEN '$data1' AND '$data2'  GROUP BY adress",[':region'=>$region]);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Движение денежных средств <?= $region; ?>
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
              <input type="text" hidden value="3" name="id">
              <input type="text" hidden value="<?= $region; ?>" name="region">
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" style="width: 16rem;" value="<?= $data1; ?>" name="start">
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" style="width: 16rem;" value="<?= $data2; ?>" name="end">
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
            <div class="table-responsive">
              <table id="example" class="tableas table table-hover table-bordered text-center">
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
                    $adress = $data['adress'];
                    $result13 = R::getCol("SELECT SUM(summstart) FROM repotscom WHERE adress ='$adress'  AND datereport = '$data1' ");
                    $result14 =  R::getCol("SELECT SUM(endsumm) FROM repotscom WHERE adress ='$adress' AND datereport = '$data2' ");
                    ?>
                  <tr>
                    <td><?= $i++; ?>.</td>
                    <td>
                      <a type="button" href="a_report.php?id=4&adress=<?= $data['adress']; ?>&start=<?= $data1; ?>&end=<?= $data2; ?>" class="btn  btn-block bg-olive btn-flat"><?= $data['adress']; ?></a>
                    <td><?= number_format($result13[0], 0, '.', ' ');
                        $summstart += $result13[0]; ?></td>
                    <td><?= number_format($data['SUM(vydacha)'], 0, '.', ' ');
                        $vydacha += $data['SUM(vydacha)']; ?></td>
                    <td><?= number_format($data['SUM(vozvrat)'], 0, '.', ' ');
                        $vozvrat += $data['SUM(vozvrat)']; ?></td>
                    <td><?= number_format($data['SUM(finhelp)'], 0, '.', ' ');
                        $finhelp += $data['SUM(finhelp)']; ?></td>
                    <td><?= number_format($data['SUM(withdrawal)'], 0, '.', ' ');
                        $withdrawal += $data['SUM(withdrawal)']; ?></td>
                    <td><?= number_format($result14[0], 0, '.', ' ');
                        $endsumm += $result14[0]; ?></td>
                    <td>0</td>
                    <td><?= number_format($data['SUM(comis)'], 0, '.', ' ');
                        $comis += $data['SUM(comis)'];  ?></td>
                    <td><?= number_format($data['SUM(proc)'], 0, '.', ' ');
                        $proc += $data['SUM(proc)'];  ?></td>
                    <td><?= number_format($data['SUM(summsale)'], 0, '.', ' ');
                        $summsale += $data['SUM(summsale)']; ?></td>
                    <td><?= number_format($data['SUM(salesincome)'], 0, '.', ' ');
                        $salesincome += $data['SUM(salesincome)']; ?></td>
                    <td><?= number_format($data['SUM(cash_in_pledge_end)'], 0, '.', ' ');
                        $cash_in_pledge_end += $data['SUM(cash_in_pledge_end)']; ?></td>
                  </tr>
                  <?}?>
                </tbody>
                <tr>
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
                  <th><?= $cash_in_pledge_end; ?></th>
                </tr>
                <tfoot>
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