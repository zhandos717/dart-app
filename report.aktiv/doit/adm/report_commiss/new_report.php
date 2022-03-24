
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

    if($adress != 'Все'){
                          $result12 = mysqli_query($connect,"SELECT * FROM repotscom WHERE region = '$region' AND adress = '$adress' AND datereport BETWEEN '$data1' AND '$data2' ");
                          $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                          $result22 =$mysqli->query("SELECT SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom WHERE region = '$region' AND adress = '$adress' AND datereport BETWEEN '$data1' AND '$data2'"  );
                          $data22 = mysqli_fetch_array($result22);
                            }
                            if($adress == 'Все'){
                                                  $result12 = mysqli_query($connect,"SELECT * FROM repotscom WHERE region = '$region' AND datereport BETWEEN '$data1' AND '$data2' ");
                                                  $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                  $result22 =$mysqli->query("SELECT SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom WHERE region = '$region'  AND datereport BETWEEN '$data1' AND '$data2'"  );
                                                  $data22 = mysqli_fetch_array($result22);
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
          Товары комисcионного магазина
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
          <!--------------------------------------------------------------------------->
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><b></b></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example" class="tableas table table-hover table-bordered text-center">
                    <thead>
                            <tr>
                              <th colspan="2">Касса на начало дня</th>
                              <th rowspan="2">0,5%</th>
                              <th rowspan="2">1%</th>
                              <th colspan="2">Доход от реализации</th>
                              <th rowspan="2">Расходы</th>
                              <th rowspan="2">Чистая прибыль</th>
                              <th colspan="2">Клиенты</th>
                              <th rowspan="2">Витрина</th>
                              <th rowspan="2">Нал в залоге</th>
                              <th colspan="2">Касса на конец дня</th>
                              <th rowspan="2">Выдача</th>
                              <th rowspan="2">Сумма</th>
                            </tr>
                            <tr>
                              <th>Нал</th>
                              <th>БАНК</th>
                              <th>Нал</th>
                              <th>БАНК</th>
                              <th>ВСЕ</th>
                              <th>НОВЫЕ</th>
                              <th>Нал</th>
                              <th>БАНК</th>
                            </tr>
                            <tr>
                            <?$a = 1;
                              while ($a <= 16) {?>
                                <th><?=$a++;?></th>
                              <?}?>
                            </tr>
                          </thead>
                          <tbody>
                            <?
                      $result12 = mysqli_query($connect,"SELECT region, SUM(summstart), SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom");// GROUP BY region

                      $result = mysqli_query($connect,"SELECT SUM(summa_vydachy), COUNT(*)as count ,SUM(p1),SUM(proc)  FROM tickets WHERE NOT status = 11 AND NOT status = 1 ");
                      $data1 = mysqli_fetch_array($result);

                      $result = mysqli_query($connect,"SELECT SUM(summa_vydachy) FROM tickets ");
                      $data2 = mysqli_fetch_array($result);

                      $result3 = mysqli_query($connect,"SELECT SUM(summa_vydachy) FROM tickets WHERE status = 7 OR status = 10 OR status = 14 OR status = 15");
                      $data3 = mysqli_fetch_array($result3);

                      $result3 = mysqli_query($connect,"SELECT SUM(summa_vydachy) FROM tickets WHERE status = 2 ");
                      $data4 = mysqli_fetch_array($result3);

                      $result3 = mysqli_query($connect,"SELECT SUM(startamount),SUM(cashbox),SUM(salesincome) FROM kassa");
                      $data5 = mysqli_fetch_array($result3);

                      $result3 = mysqli_query($connect,"SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE status = 5 AND salerstatus = 1 ");
                      $data6 = mysqli_fetch_array($result3);

                      $result3 = mysqli_query($connect,"SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE status = 5 AND salerstatus = 2 ");
                      $data7 = mysqli_fetch_array($result3);

                      while ($data = mysqli_fetch_array($result12))
                              {?>
                                <tr>
                                  <td><?=number_format($data5['SUM(startamount)'], 0, '.', ' ');?></td>
                                  <td>?</td>
                                  <td><?=number_format($data1['SUM(p1)'], 0, '.', ' ');?></td>
                                  <td><?=number_format($data1['SUM(proc)'], 0, '.', ' ');?></td>
                                  <td><?=number_format($data6['SUM(cena_pr)']-$data6['SUM(summa_vydachy)'], 0, '.', ' ');?></td>
                                  <td><?=number_format($data7['SUM(cena_pr)']-$data7['SUM(summa_vydachy)'], 0, '.', ' ');?></td>
                                  <td>0</td>
                                  <td><?=number_format(($data7['SUM(cena_pr)']-$data7['SUM(summa_vydachy)'])+$data['SUM(proc)']+$data['SUM(comis)'], 0, '.', ' ');?></td>
                                  <td><?=number_format($data1['count'], 0, '.', ' ');?></td>
                                  <td>-</td>
                                  <td><?=number_format($data3['SUM(summa_vydachy)'], 0, '.', ' ');?></td>
                                  <td><?=number_format($data4['SUM(summa_vydachy)'], 0, '.', ' ');?></td>
                                  <td><?=number_format($data5['SUM(cashbox)'], 0, '.', ' ');?></td>
                                  <td>?</td>
                                  <td><?=number_format($data1['SUM(summa_vydachy)'], 0, '.', ' ');?></td>
                                  <td><?=number_format($data5['SUM(startamount)']+$data['SUM(comis)']+$data['SUM(proc)']+($data6['SUM(cena_pr)']-$data6['SUM(summa_vydachy)'])+$data4['SUM(summa_vydachy)']-$data1['SUM(summa_vydachy)']+$data5['SUM(cashbox)'], 0, '.', ' ');?></td>
                                </tr>
                            <?}?>
                          </tbody>
                          <tr>
                          </tr>
                          <tfoot>
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
