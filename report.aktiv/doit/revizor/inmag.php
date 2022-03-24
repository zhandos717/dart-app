<? //проверка существовании сессии
include("../../bd.php");



if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 13) :

    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;

    $regionlombard = $_GET['regionlombard'];
    $adresslombard = $_GET['adresslombard'];
    $datapr = $_GET['datapr'];
?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>

    <script type="text/javascript" src="linkedselect.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Все принятые товары в магазине
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
                <h3 class="box-title">Товары в магазине</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                  <div class="layer">
                      <table id="example1" class="table table-bordered table-hover">
                          <thead>
                              <tr style="background: #398ebd; color: white;">
                              <th>Номер ЗБ</th>
                              <th>Клиент</th>
                              <th>Контакты</th>
                              <th style="width:40vh;">Залог</th>
                              <th>Дата выдачи</th>
                              <th>Сумма кредита</th>
                              <th>Сумма продажи</th>
                              <th>Филиал</th>
                              <th>Кто принял</th>
                              </tr>
                          </thead>
                          <tbody>
                            <? $result = mysqli_query($connect, "SELECT *FROM tickets WHERE (status = '10' OR status = '14'OR status = '15') ORDER BY id DESC ");
                                  while ($data_zb = mysqli_fetch_array($result)) {
                                 $stzb = $data_zb['status'];
                                 $result2 = mysqli_query($connect,"SELECT *FROM status_zb WHERE id = '$stzb' ");
                                 $data_st = mysqli_fetch_array($result2);
                                 $statuszb = $data_st['name'];?>
                                <tr>
                                  <td><?= $data_zb['nomerzb']; ?></td>
                                  <td><?= $data_zb['fio']; ?></td>
                                  <td><?= $data_zb['phones']; ?></td>
                                  <td><?= $data_zb['category']; ?>, <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?>, <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                                  SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                                   </td>
                                  <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                                  <td class="warning"><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                                  <td class="success"><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                                  <td><?= $data_zb['region']; ?>/<?= $data_zb['adressfil']; ?></td>
                                  <td><?= $data_zb['eo']; ?></td>
                                </tr>
                          <? } ?>

                          </tbody>

                          <tfoot>
                              <tr class="info"><?
                  $result2 = mysqli_query($connect, " SELECT SUM(summa_vydachy),SUM(cena_pr) from tickets WHERE  (status = '10' OR status = '14'OR status = '15') ");
                  $data2 = mysqli_fetch_array($result2);
                  ?>
                                  <th colspan="2" class="text-center">Итого</th>
                                  <th colspan="2" class="text-center"><?= number_format($data2['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
                                  <th colspan="2" class="text-center"><?= number_format($data2['SUM(cena_pr)'], 0, '.', ' '); ?></th>
                                  <th colspan="3" class="text-center"><?= number_format($data2['SUM(cena_pr)']-$data2['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>

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

    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
