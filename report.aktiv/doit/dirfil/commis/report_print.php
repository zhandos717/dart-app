<?//проверка существовании сессии
include ("../../../bd.php");
if ( isset ($_SESSION['logged_user']) ) :   //если сущесттвует пользователь
 if ($_SESSION['logged_user']->status ==1):


  $exel_post  = R::load(postexel,4);
  $region = $exel_post['region'];
  $adress = $exel_post['adress'];
  $kassa = $exel_post['kassa'];
  $data1 = $exel_post['date1'];
  $data2 = $exel_post['date2'];
  $status = $exel_post['status'];
  R::store($exel_post);
  if($exel_post['date1'] AND $exel_post['date2']){
                              $data1 = $exel_post['date1'];
                              $data2 = $exel_post['date2'];
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
                                                    $comment = $region.' / '.$adress.' за период сыыы '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

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

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Комиссионный магазин</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">



  </head>
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> ТОВАРИЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "ONE BILLION SALES"
              <small class="pull-right">Дата: <?=date('d.m.Y');?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <!--<div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong>Admin, Inc.</strong><br>
              795 Folsom Ave, Suite 600<br>
              San Francisco, CA 94107<br>
              Phone: (804) 123-5432<br>
              Email: info@almasaeedstudio.com
            </address>
          </div><!-- /.col --
          <div class="col-sm-4 invoice-col">
            To
            <address>
              <strong>John Doe</strong><br>
              795 Folsom Ave, Suite 600<br>
              San Francisco, CA 94107<br>
              Phone: (555) 539-1037<br>
              Email: john.doe@example.com
            </address>
          </div><!-- /.col --
          <div class="col-sm-4 invoice-col">
            <b>Invoice #007612</b><br>
            <br>
            <b>Order ID:</b> 4F3S8J<br>
            <b>Payment Due:</b> 2/22/2014<br>
            <b>Account:</b> 968-34567
          </div><!-- /.col --
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="example" class="table table-bordered table-striped">
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
              <tr>    <td><?=$i++;?>.</td>
                      <td><?= $data_zb['nomerzb']; ?></td>
                      <td><?= $data_zb['fio']; ?></td>
                      <td><?= $data_zb['phones']; ?></td>
                      <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                      SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                       </td>
                      <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                      <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                      <td><?= date("d.m.Y", strtotime($data_zb['datavykup'])); ?></td>
                      <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                      <td><?= $data_zb['eo']; ?></td>
                      <td><?= $statuszb; ?></td>
              </tr>
              <? } ?>
              </tbody>
              <tfoot>
                  <tr class="danger">
                      <th colspan="3" class="text-center">Итого:</th>
                      <th colspan="3" class="text-center">Сумма выдачи: <?= number_format($data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                      <th colspan="3" class="text-center">Сумма продажи: <?= number_format($data22['SUM(cena_pr)'], 0, '.', ' '); ?>  тг.</th>
                      <th colspan="3" class="text-center">Доход: <?= number_format($data22['SUM(cena_pr)']-$data22['SUM(summa_vydachy)'], 0, '.', ' '); ?>  тг.</th>
                  </tr>
              </tfoot>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->


      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
  </body>
</html>
<?php endif; ?>

<? else :
echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
