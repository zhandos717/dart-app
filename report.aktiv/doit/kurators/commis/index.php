<? //проверка существовании сессии
          $today = date('Y-m-d');
          $region = $_POST['region'];
          $adress = $_POST['adress'];
          $kassa = $_POST['kassa'];
          $data1 = $_POST['date1'];
          $data2 = $_POST['date2'];
          $status = $_POST['status'];
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

                                    $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                    $data22 = mysqli_fetch_array($result12);
                                  };
$region = $_SESSION['logged_user']->region;

  if($region == 'Астана'){
    $region = 'Нур-султан';
  }


                                  ?>



<script type="text/javascript" src="linkedselect.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Товары коммисионного магазина
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li><a href="index.php">Регион: </a></li>
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
            <form action="commis.php" method="POST">
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
                    <i class="fa fa-building"></i>
                  </span>
                  <?if($_SESSION['logged_user']->root == '3'):?>

                  <select class="form-control" id="List11" name="region">

                    <option value="<?= $region; ?>"><?= $region; ?></option>
                    <option value="Кокшетау">Кокшетау</option>
                    <option value="Костанай">Костанай</option>
                    <option value="Павлодар">Павлодар</option>
                  </select>
                  <?else:?>
                  <select class="form-control" id="List1" name="region">
                    <option value="<?= $region; ?>"><?= $region; ?></option>
                  </select>
                  <?endif;?>
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
                    <i class="fa fa-building"></i>
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
            <h3 class="box-title"><b><?= $comment; ?></b></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="tableas table table-hover table-bordered">
                <thead>
                  <tr class="success">
                    <th>№ЗБ</th>
                    <th>Клиент</th>
                    <th>Телефон</th>
                    <th style="width:45vh;">Залог</th>
                    <th>Сумма выдачи</th>
                    <th style="width:10vh;">Цена</th>
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
                    while ($data_zb = mysqli_fetch_array($result)) {
                    $stzb = $data_zb['status'];
                    $result2 = mysqli_query($connect,"SELECT *FROM status_zb WHERE id = '$stzb' ");
                    $data_st = mysqli_fetch_array($result2);
                    $statuszb = $data_st['name'];
                    ?>
                  <tr>
                    <form action="updstcomzb.php" method="t">
                      <input hidden type="text" name="regionlombard" value="<?= $regionlombard; ?>">
                      <input hidden type="text" name="adresslombard" value="<?= $adresslombard; ?>">
                      <input hidden type="text" name="datapr" value="<?= $datapr; ?>">
                      <input hidden type="text" name="nomerzb" value="<?= $nomerzb; ?>">
                      <td style="white-space:nowrap;"><?= $data_zb['nomerzb']; ?></td>
                      <td><?= $data_zb['fio']; ?></td>
                      <td><?= $data_zb['phones']; ?></td>
                      <td><?= $data_zb['category']; ?>,<?= $data_zb['opisanie']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?>, <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?>
                        SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                      </td>
                      <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                      <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                      <td><?= date("d.m.Y", strtotime($data_zb['datavykup'])); ?></td>
                      <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                      <td><?= $data_zb['eo']; ?></td>
                      <td><?= $statuszb; ?></td>
                      <!--  <td><input type="submit" name="gogo" class="btn btn-success" value="Принять"></td> -->
                    </form>
                  </tr>
                  <? } ?>
                </tbody>
                <tfoot>
                  <tr class="danger">
                    <th colspan="3" class="text-center">Итого:</th>
                    <th colspan="3" class="text-center">Сумма выдачи: <?= number_format($data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                    <th colspan="3" class="text-center">Сумма продажи: <?= number_format($data22['SUM(cena_pr)'], 0, '.', ' '); ?> тг.</th>
                    <th colspan="2" class="text-center">Доход: <?= number_format($data22['SUM(cena_pr)'] - $data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
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


<script type="text/javascript">
  var syncList3 = new syncList;
  // Определяем значения подчиненных списков (2 и 3 селектов)
  syncList3.dataList = {
    /* Определяем элементы второго списка в зависимости
    от выбранного значения в первом списке */

    <?php $result8 = mysqli_query($connect, " SELECT region FROM kassa GROUP BY region ");
    while ($data8 = mysqli_fetch_array($result8)) {
      $region = $data8["region"];
    ?> '<?= $region ?>': {
        <?php $result9 = mysqli_query($connect, " SELECT filial FROM kassa WHERE region ='$region' GROUP BY filial ");
        while ($data9 = mysqli_fetch_array($result9)) { ?> '<?= $data9["filial"] ?>': '<?= $data9["filial"] ?>',
        <?php } ?>
      },
    <?php } ?>

    <?php $result8 = mysqli_query($connect, " SELECT filial FROM kassa GROUP BY filial ");
    while ($data8 = mysqli_fetch_array($result8)) {
      $filial = $data8["filial"];
    ?> '<?= $filial ?>': {
        <?php $result9 = mysqli_query($connect, " SELECT kassa FROM kassa WHERE filial ='$filial' GROUP BY kassa ");
        while ($data9 = mysqli_fetch_array($result9)) { ?> '<?= $data9["kassa"] ?>': '<?= $data9["kassa"] ?>',
        <?php } ?>
      },
    <?php } ?>
  };
  // Включаем синхронизацию связанных списков
  syncList3.sync("List11", "List22");
</script>