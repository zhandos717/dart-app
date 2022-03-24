<? //проверка существовании сессии
include("../../bd.php");
  if ($_SESSION['logged_user']->status == 10) :

    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;

    $regionlombard = $_GET['regionlombard'];
    $adresslombard = $_GET['adresslombard'];
    $datapr = $_GET['datapr'];
    $active = 'active';
?>

<? include "header.php"; ?>
<? include "menu.php"; ?>

<script type="text/javascript" src="linkedselect.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Список проданных товаров
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
          <div class="box-header">
            <h3 class="box-title">Проданные товары</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive ">
            <div class="layer">
              <!-- <input type="button" value="Import as Excel" class="btn btn-primary" onclick="saveAsExcel('tableToExcel', 'lollipop.xls')" /><br>
              <br> -->
              <table id="datatable-tabletools" class="table table-bordered table-hover">
                <thead>
                  <tr style="background: #125ebd; color: white;">
                    <th>Номер ЗБ</th>
                    <th>ФИО Коммитента</th>
                    <th>ИИН Коммитента</th>
                    <th>ОЦЕНКА</th>
                    <th>СУММА ВЫДАЧИ</th>
                    <th>0.5%</th>
                    <th>Сумма вознагражд</th>
                    <th>Дата выдачи</th>
                    <th>Дата возврата</th>
                    <th>Сумма продажи</th>
                  </tr>
                </thead>
                <tbody>
                  <?
              $result = mysqli_query($connect, "select *from tickets WHERE status = '5' ORDER BY id DESC LiMIT 10");

              while ($data_zb = mysqli_fetch_array($result)) {

                $code_tovar = $data_zb['nomerzb'];
                $result22 = mysqli_query($connect,"SELECT *FROM salecomision WHERE codetovar = '$code_tovar' ");
                $data_pr = mysqli_fetch_array($result22);
                $date_prod = $data_pr['dataa'];

                                 $stzb = $data_zb['status'];
                                 $result2 = mysqli_query($connect,"SELECT *FROM status_zb WHERE id = '$stzb' ");
                                 $data_st = mysqli_fetch_array($result2);
                                 $statuszb = $data_st['name'];
          ?>
                  <tr>
                    <td><?= $data_zb['nomerzb']; ?></td>
                    <td><?= $data_zb['fio']; ?></td>
                    <td><?= $data_zb['iin']; ?></td>
                    <td><?= number_format($data_zb['ocenka'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data_zb['p1'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data_zb['obshproczasutki'], 0, '.', ' '); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                    <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                  </tr>
                  <? } ?>
                </tbody>
                <tfoot>
                  <tr class="text-center">

                    <?
                  $result2 = mysqli_query($connect, " SELECT SUM(summa_vydachy),SUM(ocenka),SUM(p1),SUM(obshproczasutki) from tickets WHERE status = '5' ");

                  $data2 = mysqli_fetch_array($result2);
                  ?>
                    <th class="text-center" colspan="3">Итого</th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(ocenka)'], 0, '.', ' '); ?></th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(p1)'], 0, '.', ' '); ?></th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(obshproczasutki)'], 0, '.', ' '); ?></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>

              </table>

            </div>

          </div><!-- /.box-body -->


        </div><!-- /.box box-primary -->

      </div><!-- /.col-md-6 -->
      <!--------------------------------------------------------------------------->

      <!--------------------------------------------------------------------------->

    </div><!-- /.content-wrapper -->
  </section>
</div>



<? include "footer.php";
     else :
 
 endif; ?>