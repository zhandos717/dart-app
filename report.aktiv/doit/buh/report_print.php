<? //проверка существовании сессии
include("../../bd.php");



if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 10) :

    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;

    $regionlombard = $_GET['regionlombard'];
    $adresslombard = $_GET['adresslombard'];

    $data1 = $_GET['date1'];
    $data2 = $_GET['date2'];

      $today = date('Y-m-d');

              if($data1 AND $data2){
                                    $data1 = $_GET['date1'];
                                    $data2 = $_GET['date2'];
                                  } else {
                                    $data1 = $today;
                                    $data2 = $today;
                                  };
  $result = mysqli_query($connect, "SELECT *from tickets WHERE (status = '10' OR status = '14' OR status = '15') AND dataseg BETWEEN '$data1' AND '$data2' ORDER BY id DESC ");
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                                              <?= $data_zb['nomerzb']; ?>

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
