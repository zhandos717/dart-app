<? //проверка существовании сессии
include("../../bd.php");

  if ($_SESSION['logged_user']->status == 2) :
      $active = 'active';
    include "header.php"; 
    include "menu.php";
    //проверка существовании сессии
          $today = date('Y-m-d');
          $region = $_SESSION['logged_user']->region;
          $adress = $_SESSION['logged_user']->adress;

          $kassa = $_POST['kassa'];
          $data1 = $_POST['date1'];
          $data2 = $_POST['date2'];
          $status = $_POST['status'];
          if($region == 'Астана'){
            $region = "Нур-султан";
          };

           if($adress == 'Тауелсыздык 45/1'){
                           $adress = 'Тауелсыздык 45';
                         };


  if($_POST['date1'] AND $_POST['date2']){
                                      $data1 = $_POST['date1'];
                                      $data2 = $_POST['date2'];
                                    } else {
                                      $data1 = '2020-08-19';
                                      $data2 = $today;
                                    };
    if($adress == 'Все'){
                          $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND status = '$status'   AND dataseg BETWEEN '$data1' AND '$data2' ");
                          $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                          $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'AND status = '$status'   AND dataseg BETWEEN '$data1' AND '$data2' ");
                          $data22 = mysqli_fetch_array($result12);
                        }
    if($status ==  $adress){
                          $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region'  AND dataseg BETWEEN '$data1' AND '$data2'");
                          $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                          $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'  AND dataseg BETWEEN '$data1' AND '$data2'");
                          $data22 = mysqli_fetch_array($result12);
                            }
                            if($adress != $status){
                                                      $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND status = '$status' AND  (dataseg BETWEEN '$data1' AND '$data2')");
                                                                                  $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                                                  $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region' AND status = '$status'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                                                                  $data22 = mysqli_fetch_array($result12);
                                                                                  }
    if($status AND ($adress != 'Все') AND ($status == 'Все')){
                                  $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress'  AND  (dataseg BETWEEN '$data1' AND '$data2')");
                                    $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                    $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'AND adressfil = '$adress'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                    $data22 = mysqli_fetch_array($result12);
                                  };

                                  if($status AND ($adress != 'Все') AND ($status != 'Все')){
                                                                $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND status = '$status' AND adressfil = '$adress'  AND  (dataseg BETWEEN '$data1' AND '$data2')");
                                                                  $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                                  $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region' AND status = '$status' AND adressfil = '$adress'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                                                  $data22 = mysqli_fetch_array($result12);
                                                                };

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
            <form action="alltovar.php" method="POST">
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
                  <select class="form-control" id="List1" name="region">
                    <option value="<?= $region; ?>"><?= $region; ?></option>
                  </select>
                </div>
              </div>
              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </span>
                  <select class="form-control" id="List2" name="adress">
                    <option value="<?= $adress; ?>"><?= $adress; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-tag"></i>
                  </span>
                  <select class="form-control" name="status">
                    <option value="Все">Все</option>
                    <? $result2 = mysqli_query($connect,"SELECT *FROM status_zb ");
                                                 while ($data_zb = mysqli_fetch_array($result2)){?>
                    <option value="<?= $data_zb['id']; ?>"><?= $data_zb['name']; ?></option>
                    <?}?>
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
            <h3 class="box-title"><b> <?= $comment; ?></b></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table  class="tableas table table-hover table-bordered">
                <thead>
                  <tr class="success">
                    <th>№</th>
                    <th style="width:5vh;">№ЗБ</th>
                    <th>Клиент</th>
                    <th>Телефон</th>
                    <th style="width:45vh;">Залог</th>
                    <th>Сумма выдачи</th>
                    <th style="width:8vh;">Цена</th>
                    <th>Дата выдачи</th>
                    <th>Дата выкупа</th>
                    <th>Дата возврата</th>
                    <th>Кто принял</th>
                    <th>Статус</th>
                    <!-- <th>Действие</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?
                    $i = 1;
                    while ($data_zb = mysqli_fetch_array($result)) {
                    $stzb = $data_zb['status'];
                    $result2 = mysqli_query($connect,"SELECT *FROM status_zb WHERE id = '$stzb' ");
                    $data_st = mysqli_fetch_array($result2);
                    $statuszb = $data_st['name'];
                    ?>
                  <tr>
                    <td><?= $i++; ?>.</td>
                    <td><?= $data_zb['nomerzb']; ?></td>
                    <td><?= $data_zb['fio']; ?></td>
                    <td><?= $data_zb['phones']; ?></td>
                    <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                      SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                    </td>
                    <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                    <td>
                      <?if($data_zb['dataatime']){?> <?= date("d.m.Y H:i:s", strtotime($data_zb['dataatime'])); ?>
                      <?}?>
                    </td>
                    <td>
                      <?if($data_zb['dv']){?> <?= date("d.m.Y", strtotime($data_zb['dv'])); ?>
                      <?}?>
                    </td>
                    <td><?= $data_zb['eo']; ?></td>
                    <td><?= $statuszb; ?></td>
                  </tr>
                  <? } ?>
                </tbody>
                <tfoot>
                  <tr class="danger">
                    <th colspan="3" class="text-center">Итого:</th>
                    <th colspan="3" class="text-center">Сумма выдачи: <?= number_format($data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                    <th colspan="3" class="text-center">Сумма продажи: <?= number_format($data22['SUM(cena_pr)'], 0, '.', ' '); ?> тг.</th>
                    <th colspan="3" class="text-center">Доход: <?= number_format($data22['SUM(cena_pr)'] - $data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
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

</script>
<? include "app/footer.php"; 
else : 

endif; ?>
