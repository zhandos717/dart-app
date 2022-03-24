<? //проверка существовании сессии
include("../../bd.php");



if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 10) :

    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;

    $regionlombard = $_GET['regionlombard'];
    $adresslombard = $_GET['adresslombard'];
    $datapr = $_GET['datapr'];
    $active = 'active';
    $data1 = $_POST['date1'];
    $data2 = $_POST['date2'];

      $today = date('Y-m-d');

              if($data1 AND $data2){
                                    $data1 = $_POST['date1'];
                                    $data2 = $_POST['date2'];
                                  } else {
                                    $data1 = $today;
                                    $data2 = $today;
                                  };
  $result = mysqli_query($connect, "SELECT *from tickets WHERE (status = '10' OR status = '14' OR status = '15') AND dataseg BETWEEN '$data1' AND '$data2' ORDER BY id DESC ");
?>

    <?include "header.php"; ?>
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
               <div class="box-header with-border">
                   <h3 class="box-title">Выберите период</h3>

                   <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                   </div>
                 </div>
                 <div class="box-body">
                   <div class="row">
                   <form action="inmag.php" method="POST">
                     <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <input type="date" class="form-control" style="width: 16rem;" value="<?=$data1;?>" name="date1">
                        </div>
                        <!-- /input-group -->
                     </div>

                      <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <input type="date" class="form-control" style="width: 16rem;" value="<?=$data2;?>" name="date2">
                        </div>
                        <!-- /input-group -->
                     </div>
                     <div class="input-group input-group-sm">
                         <span class="input-group-btn">
                           <button type="submit" class="btn btn-info btn-flat"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Подтвердить!</font></font></button>
                         </span>
                     </div>
                   </form>
               </div><!-- /.row -->
            </div><!--.box-body -->
            </div> <!--.box -->
            </div> <!--.col-md-12 -->
<!-- /****************************************************************************************** -->
          <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">
                    Товары в магазине
                  <?if($result){?> <a href="report_print.php?date1=<?=$data1;?>&date2=<?=$data2;?>" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Распечатать</font></font></a> <?};?>
                  </h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive ">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="danger">
                        <th>Номер ЗБ</th>
                        <th>ФИО Коммитента</th>
                        <th>ИИН Коммитента</th>
                        <th>ОЦЕНКА</th>
                        <th>СУММА ВЫДАЧИ</th>
                        <th>0.5%</th>
                        <th>Сумма вознагражд</th>
                        <th>Дата выдачи</th>
                        <th>Дата возврата</th>
                        </tr>
                    </thead>
                    <tbody>
                          <?


                              while ($data_zb = mysqli_fetch_array($result)) {
                                                 $stzb = $data_zb['status'];
                                                 $result2 = mysqli_query($connect,"SELECT *FROM status_zb WHERE id = '$stzb' ");
                                                 $data_st = mysqli_fetch_array($result2);
                                                 $statuszb = $data_st['name'];
                          ?>
                                <tr>
                                                  <td>
                                                    <form class="" action="view_ticket.php" method="POST">
                                                      <input type="text" name="id"  hidden value="<?= $data_zb['id'];?>">
                                                      <input type="text" name="url"  hidden value="inmag.php">
                                                      <button type="submit" name="button" class="btn btn-info" > <?= $data_zb['nomerzb']; ?></button>
                                                    </form>
                                                  </td>
                                                  <td><?= $data_zb['fio']; ?></td>
                                                  <td><?= $data_zb['iin']; ?></td>
                                                  <td><?= number_format($data_zb['ocenka'], 0, '.', ' '); ?></td>
                                                  <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                                                  <td><?= number_format($data_zb['p1'], 0, '.', ' '); ?></td>
                                                  <td><?= number_format($data_zb['obshproczasutki'], 0, '.', ' '); ?></td>
                                                  <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                                                  <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>

                                </tr>
                                <? } ?>
                    </tbody>
                    <tfoot>
                        <tr class="info">

                            <?
            $result2 = mysqli_query($connect, " SELECT SUM(summa_vydachy),SUM(ocenka),SUM(p1),SUM(obshproczasutki) from tickets WHERE (status = '10' OR status = '14' OR status = '15')  AND dataseg BETWEEN '$data1' AND '$data2' ");

            $data2 = mysqli_fetch_array($result2);
            ?>
                            <th colspan="3" class="text-center">Итого</th>
                            <th><?= number_format($data2['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
                            <th><?= number_format($data2['SUM(ocenka)'], 0, '.', ' '); ?></th>
                            <th><?= number_format($data2['SUM(p1)'], 0, '.', ' '); ?></th>
                            <th><?= number_format($data2['SUM(obshproczasutki)'], 0, '.', ' '); ?></th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

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
