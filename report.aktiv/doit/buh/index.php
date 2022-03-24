<? //проверка существовании сессии
include("../../bd.php");

if ($_SESSION['logged_user']->status == 10) :
  include "header.php";
  include "menu.php";

  $today = date('Y-m-d');
  $region = $_POST['region'];
  $adress = $_POST['adress'];
  $kassa = $_POST['kassa'];
  $status_sklad = $_POST['status_sklad'];
  $data1 = $_POST['date1'];
  $data2 = $_POST['date2'];


  if ($data1 and $data2) {
    $data1 = $_POST['date1'];
    $data2 = $_POST['date2'];
  } else {
    $data1 = $today;
    $data2 = $today;
  };

  $result3 = $mysqli->query("SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg BETWEEN '$data1' AND '$data2'");
  $region = R::findAll('kassa', 'region <> "Тест" GROUP BY region')
?>

  <div class="content-wrapper no-print">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2 class="box-title">Кассовые операции филиала <?= $adress; ?> города <?= $region; ?> </h2>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Кассовые операции</a></li>
        <li class="active">филиала <?= $adress; ?> города <?= $region; ?></li>
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
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="index.php" method="POST">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group">
                      <input type="date" class="form-control" style="width: 16rem;" value="<?= $data1; ?>" name="date1">
                    </div>
                    <!-- /input-group -->
                  </div>

                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group">
                      <input type="date" class="form-control" style="width: 16rem;" value="<?= $data2; ?>" name="date2">
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
                        <option value="<?= $adress; ?>"><?= $adress; ?></option>>

                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-fax"></i>
                      </span>
                      <select class="form-control" name="kassa">
                        <option value="Касса 1">Касса 1</option>
                        <option value="Касса 2">Касса 2</option>
                        <option value="Касса 3">Касса 3</option>
                        <option value="Касса 4">Касса 4</option>
                        <option value="Касса 5">Касса 5</option>
                      </select>
                    </div>
                  </div>
                  <div class="input-group input-group-sm">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Подтвердить!</button>
                    </span>
                  </div>
                </form>
              </div><!-- /.row -->
            </div>
            <!--.box-body -->
          </div>
          <!--.box -->
        </div>
        <!--.col-md-12 -->


        <!--------------------------------------------------------------------------->
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title pull-left"> <?= $kassa; ?> за период с <?= date("d.m.Y", strtotime($data1)); ?> по <?= date("d.m.Y", strtotime($data2)); ?> &ensp;</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-plus"> </i> </button>
              </div>
            </div><!-- /.box-header -->

            <div class="box-body">
              <div class="table-responsive">
                <table class="tableas table table-hover table-bordered" id="example1">
                  <thead>
                    <tr class="success">
                      <th class="text-center">№</th>
                      <th class="text-center" style="width:8rem;">Номер документа</th>
                      <th class="text-center"> От кого получено или кому выдано </th>
                      <th class="text-center"> Номер креспондирующего счета</th>
                      <th class="text-center">Приход (KZT)</th>
                      <th class="text-center">расход (KZT)</th>
                      <th class="text-center">Статус</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $i = 1;
                    while ($data3 = mysqli_fetch_array($result3)) {
                      $stzb = $data3['status'];
                      $result2 = mysqli_query($connect, "SELECT *FROM status_zb WHERE id = '$stzb' ");
                      $data_st = mysqli_fetch_array($result2);
                      $statuszb = $data_st['name']; ?>
                      <tr>
                        <td class="text-center"><?= $i++; ?> </td>
                        <td class="text-center">
                          <form class="" action="view_ticket.php" method="POST">
                            <input type="number" name="id" hidden value="<?= $data3['id']; ?>">
                            <input type="text" name="url" hidden value="index.php">
                            <input type="text" name="date1" hidden value="<?= $data1; ?>">
                            <input type="text" name="date2" hidden value="<?= $data2; ?>">
                            <input type="text" name="region" hidden value="<?= $region; ?>">
                            <input type="text" name="adress" hidden value="<?= $adress; ?>">
                            <input type="text" name="kassa" hidden value="<?= $kassa; ?>">
                            <button type="submit" class="btn btn-info" name="button"> <?= $data3['nomerzb']; ?></button>
                          </form>
                        </td>
                        <td><?= $data3['fio']; ?></td>
                        <td></td>
                        <td class="text-center"> <?= number_format($data3['p1'], 0, '.', ' '); ?> тг. </td>
                        <td class="text-center"> <?= number_format($data3['summa_vydachy'], 0, '.', ' '); ?> тг. </td>
                        <td><?= $statuszb; ?> </td>
                      </tr>
                    <? } ?>
                  </tbody>
                  <tfoot>
                    <tr class="danger">
                      <?php $result10 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(p1) FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND dataseg BETWEEN '$data1' AND '$data2'");
                      $data10 = mysqli_fetch_array($result10); ?>
                      <th colspan="4" class="text-center">Итого </th>
                      <th class="text-center"><?= number_format($data10['SUM(p1)'], 0, '.', ' '); ?> тг.</th>
                      <th class="text-center"><?= number_format($data10['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
      </div><!-- /.content-wrapper -->
    </section>
  </div>
<? include "footer.php";
else :
  header('Location: /');
endif; ?>