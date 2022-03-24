<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 1) :
  include "header.php";
  include "menu.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Аукционист - <?= $region; ?>/<?= $adress; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная<?= $day; ?></a></li>
        <li><a href="index.php">Регионы</a></li>
        <li class="active">Филиалы</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col (left) -->
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Отчетные формы - АУКЦИОНИСТ</h3>
            </div>
            <div class="box-body">
              <form action="./functions/get_report_salers.php" method="post">
                <!--Товарный отчет -->
                <div class="form-group">

                  <div class="col-md-4">
                    <div class="form-group">
                      <!-- <label for="date1">ОТ:</label> -->
                      <input class="form-control" id="date1" type="date" value="<?= date('Y-m-01'); ?>" name="date1" required="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <!-- <label for="date2">До:</label> -->
                      <input class="form-control" id="date2" type="date" value="<?= date('Y-m-d'); ?>" name="date2" required="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <!-- <label for="date2">До:</label> -->
                      <button class="btn btn-success" type="submit"> Подтвердить </button>
                    </div>
                  </div>
                </div>
                <!-- /.input group -->
              </form>
            </div>
            <!--Товарный отчет  -->
          </div>
          <!-- /.box-body -->
        </div>
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Продажи</h3>
            </div>
            <div class="box-body answer">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr class="info">
                      <th>№</th>
                      <th> Дата реализации</th>
                      <th> №ЗБ</th>
                      <th> ТОВАР</th>
                      <th>Вид оплаты</th>
                      <th>Сумма кредита</th>
                      <th>Сумма реализации</th>
                      <th>Доход от продажи</th>
                      <th>Прибыль (-% банка)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $sql = "data between :date1 AND :date2 AND regionlombard ='$region' AND adresslombard ='$adress' AND statustovar IS NULL";
                    $placeholder = [':date1' => date('Y-m-01'), ':date2' => date('Y-m-d')];
                    $table = R::findAll('sales', $sql, $placeholder);
                    $i = 1;
                    foreach ($table as $data) {
                    ?>
                      <tr>
                        <td style="width:5rem;"><?= $i++; ?>.</td>
                        <td style="width:10rem;"><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                        <td><?= $data['codetovar']; ?></td>
                        <td><?= $data['tovarname']; ?></td>
                        <td><?= $data['vid']; ?></td>
                        <td class="danger"><?= number_format($data['summaprihod'], 0, '.', ' ');
                                            $summaprihod += $data['summaprihod'] ?></td>
                        <td class="warning"><?= number_format($data['summareal'], 0, '.', ' ');
                                            $summareal += $data['summareal']  ?></td>
                        <td class="success"><?= number_format($data['summareal'] - $data['summaprihod'], 0, '.', ' '); ?></td>
                        <td class="success"><?= number_format($data['remainder'] - $data['summaprihod'], 0, '.', ' ');
                                            $remainder += $data['remainder'] - $data['summaprihod'] ?></td>
                      </tr>
                    <? } ?>
                  </tbody>
                  <tfoot>
                    <tr class="bg-olive text-center">
                      <td colspan="5">
                        ИТОГ:
                      </td>

                      <td><?= number_format($summaprihod, 0, '.', ' '); ?></td>
                      <td><?= number_format($summareal, 0, '.', ' '); ?></td>
                      <td><?= number_format($summareal - $summaprihod, 0, '.', ' '); ?></td>
                      <td><?= number_format($remainder, 0, '.', ' '); ?></td>

                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
            <!--Товарный отчет  -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </section>
  </div><!-- /.row -->



  <script src="./js/report.js">

  </script>
<? include "footer.php";
else :
  header('Location: /');
endif; ?>