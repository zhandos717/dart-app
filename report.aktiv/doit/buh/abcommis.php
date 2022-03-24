<?
include("../../bd.php");

$active_report_com = 'active';
if ($_SESSION['logged_user']->status == 10) :

  include "header.php";
  include "menu.php";

  $today = date('Y-m-d');
  $region = $_POST['region'];
  $adress = $_POST['adress'];
  $kassa = $_POST['kassa'];
  $data1 = $_POST['date1'];
  $data2 = $_POST['date2'];
  $status = $_POST['status'];
  if ($_POST['date1'] and $_POST['date2']) {
    $data1 = $_POST['date1'];
    $data2 = $_POST['date2'];
  } else {
    $data1 = $today;
    $data2 = $today;
  };

  if ($adress != 'Все') {
    $result12 = mysqli_query($connect, "SELECT * FROM repotscom WHERE region = '$region' AND adress = '$adress' AND datereport BETWEEN '$data1' AND '$data2'");
    $comment = $region . ' / ' . $adress . ' за период с ' . date("d.m.Y", strtotime($data1)) . ' по ' . date("d.m.Y", strtotime($data2));

    $result22 = $mysqli->query("SELECT SUM(summstart),SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom WHERE region = '$region' AND adress = '$adress' AND datereport BETWEEN '$data1' AND '$data2'");
    $data22 = mysqli_fetch_array($result22);
  }
  if ($adress == 'Все') {
    $result12 = mysqli_query($connect, "SELECT * FROM repotscom WHERE region = '$region' AND datereport BETWEEN '$data1' AND '$data2' ");
    $comment = $region . ' / ' . $adress . ' за период с ' . date("d.m.Y", strtotime($data1)) . ' по ' . date("d.m.Y", strtotime($data2));

    $result22 = $mysqli->query("SELECT SUM(summstart),SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom WHERE region = '$region' AND datereport BETWEEN '$data1' AND '$data2'");
    $data22 = mysqli_fetch_array($result22);
  }

  $region = R::findAll('kassa', 'region <> "Тест" GROUP BY region');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Товары коммисионного магазина
      </h1>

      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регионы</a></li>
        <li class="active">Филиалы</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <? if ($_SESSION['message']) : ?>

        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4> <i class="icon fa fa-check"></i> Alert!</h4>
              Success alert preview. This alert is dismissable.
            </div>
          </div>
        </div>
      <? unset($_SESSION['message']);
      endif; ?>

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
              <form action="abcommis.php" method="POST">
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group">
                    <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?= $today; ?>" value="<?= $data1; ?>" name="date1">
                  </div>
                  <!-- /input-group -->
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group">
                    <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?= $today; ?>" value="<?= $data2; ?>" name="date2">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-bank"></i>
                    </span>
                    <select class="form-control" id="get_region" name="region">
                      <option value="">Выберите город</option>
                      <? foreach ($region as $reg) { ?>
                        <option><?= $reg['region'] ?></option>
                      <? } ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control" id="adress" name="adress">
                      <option value="">Выберите город</option>
                    </select>
                  </div>
                </div>

                <div class="input-group input-group-sm">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-sm">Подтвердить!</button>
                  </span>
                </div>
              </form>
            </div>
            <!--.box-body -->
          </div>
          <!--.box -->
        </div>
        <!--.col-md-12 -->
        <!--------------------------------------------------------------------------->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b><?= $comment; ?></b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="tableas table table-hover table-bordered">
                  <thead>
                    <tr class="success">
                      <th>№П/П</th>
                      <th>Город</th>
                      <th>Адресс</th>
                      <th>Дата</th>
                      <th>Сумма на начало дня</th>
                      <th>Пополнение</th>
                      <th>Изъятие</th>
                      <th>Выдача</th>
                      <th>0,5 %</th>
                      <th>Возврат</th>
                      <th>1 %</th>
                      <th>Продано на</th>
                      <th>Прибыль</th>
                      <th>На конец дня</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $i = 1;
                    while ($data12 = mysqli_fetch_array($result12)) {  ?>
                      <tr>
                        <td class="success"><?= $i++; ?>.</td>
                        <td><?= $data12['region']; ?></td>
                        <td><?= $data12['adress']; ?></td>
                        <td><?= date("d.m.Y", strtotime($data12['datereport'])); ?></td>
                        <td><?= number_format($data12['summstart'], 0, '.', ' '); ?></td>
                        <? if ($data12['finhelp'] > 0) {
                          echo '<td class="info">' . number_format($data12['finhelp'], 0, '.', ' ') . '</td>';
                        } else {
                          echo '<td>' . number_format($data12['finhelp'], 0, '.', ' ') . '</td>';
                        } ?>

                        <? if ($data12['withdrawal'] > 0) {
                          echo '<td class="danger">' . number_format($data12['withdrawal'], 0, '.', ' ') . '</td>';
                        } else {
                          echo '<td>' . number_format($data12['withdrawal'], 0, '.', ' ') . '</td>';
                        } ?>


                        <td><?= number_format($data12['vydacha'], 0, '.', ' '); ?></td>
                        <?
                        $comis = round($data12['vydacha'] * 0.005);
                        $comis1 = round($data12['comis'] - $comis);
                        if ($comis != $data12['comis']) {
                          if ($comis1 > 0) { ?>
                            <td class="warning"><? echo $data12['comis'] . '-' . $comis . '=' . $comis1 ?></td>
                          <? }
                          if ($comis1 < 0) { ?>
                            <td class="danger"> <? echo $data12['comis'] . '-' . $comis . '=' . $comis1 ?></td>
                          <? } ?>
                        <? } else { ?>
                          <td><?= number_format($data12['comis'], 0, '.', ' '); ?></td>
                        <? } ?>
                        <td><?= number_format($data12['vozvrat'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data12['proc'], 0, '.', ' '); ?></td>
                        <? if ($data12['summsale'] > 0) {
                          echo '<td class="success">' . number_format($data12['summsale'], 0, '.', ' ') . '</td>';
                        } else {
                          echo '<td>' . number_format($data12['summsale'], 0, '.', ' ') . '</td>';
                        } ?>
                        <td><?= number_format($data12['salesincome'] + $data12['comis'] + $data12['proc'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data12['endsumm'], 0, '.', ' '); ?></td>
                      </tr>
                    <? } ?>
                  </tbody>
                  <tfoot>

                    <th colspan="4" class="text-center"> Итого: </th>
                    <th><?= number_format($data12['summstart'], 0, '.', ' '); ?> </th>
                    <th> <?= $data22['SUM(finhelp)']; ?></th>
                    <th> <?= $data22['SUM(withdrawal)']; ?></th>
                    <th> <?= $data22['SUM(vydacha)']; ?></th>
                    <th> <?= $data22['SUM(comis)']; ?></th>
                    <th> <?= $data22['SUM(vozvrat)']; ?></th>
                    <th> <?= $data22['SUM(proc)']; ?></th>
                    <th> <?= $data22['SUM(summsale)']; ?></th>
                    <th> <?= $data22['SUM(salesincome)'] + $data22['SUM(proc)'] + $data22['SUM(comis)']; ?></th>
                    <th><?= number_format($data12['endsumm'], 0, '.', ' '); ?> </th>
                    <th></th>
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
<? include "footer.php";
else :
  header('Location: /');
endif; ?>