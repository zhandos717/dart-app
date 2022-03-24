
<? //проверка существовании сессии
          $today = date('Y-m-d');
          $region = $_GET['region'];
          $adress = $_GET['adress'];
          $kassa = $_POST['kassa'];
          $data1 = $_POST['date1'];
          $data2 = $_POST['date2'];
          $status = $_POST['status'];



          $region = $_GET['region'];

          $result122 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress'  AND(status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы' ");
          $data122 = mysqli_fetch_array($result122);

          $result5 = mysqli_query($connect, " SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы'  ");
          $data5 = mysqli_fetch_array($result5);

          $ss2 = $data122['SUM(summa_vydachy)'];

          $ss = $data5['SUM(summa_vydachy)'];

          $result12 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND status = 2 ");
          $data12 = mysqli_fetch_array($result12);

          $ss3 = $data12['SUM(summa_vydachy)'];

          ?>



           <!-- Content Wrapper. Contains page content -->
           <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
               <h1>
                 Отчет за Сентябрь 2020
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
                 <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-aqua">
                     <div class="inner">
                       <h3><?= number_format($chistaya, 0, '.', ' '); ?> тг</h3>
                       <p>ЧИСТАЯ ПРИБЫЛЬ</p>
                     </div>
                     <div class="icon">
                       <i class="ion ion-bag"></i>
                     </div>
                     <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div><!-- ./col -->
                 <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-green">
                     <div class="inner">
                       <h3><?= number_format($ss, 0, '.', ' ');; ?> тг</h3>
                       <p>АУКЦИОНИСТ ТЕХНИКА</p>
                     </div>
                     <div class="icon">
                       <i class="ion ion-stats-bars"></i>
                     </div>
                     <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div><!-- ./col -->
                 <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-yellow">
                     <div class="inner">
                       <h3><?= number_format($ss2, 0, '.', ' ');; ?> тг</h3>
                       <p>АУКЦИОНИСТ ШУБА</p>
                     </div>
                     <div class="icon">
                       <i class="ion ion-person-add"></i>
                     </div>
                     <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div><!-- ./col -->
                 <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-red">
                     <div class="inner">
                       <h3><?= number_format($ss3, 0, '.', ' ');; ?> тг</h3>
                       <p>НАЛИЧНЫЕ В ЗАЛОГЕ</p>
                     </div>
                     <div class="icon">
                       <i class="ion ion-pie-graph"></i>
                     </div>
                     <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div><!-- ./col -->
               </div><!-- /.row -->



               <div class="row">
                 <div class="col-xs-12">
                   <div class="box">

                     <div class="box-body">
                       <div class="table-responsive" >
                         <table class="table table-bordered table-hover" style="white-space:nowrap;">
                           <thead>
                             <tr style="background: #398ebd; color: white;">
                               <th>РЕГИОНЫ</th>
                                <th>ДОХОД <br> КОМИССИОНКИ</th>
                                <th>ДОХОД <br> МАГАЗИНА</th>
                                <th>ДОП  <br> ДОХОДЫ</th>
                               <th>ДОХОДЫ</th>
                               <th>РАСХОДЫ</th>
                               <!--<th>СТАБ.РАСХОДЫ</th>
                                <th>ТЕК.РАСХОДЫ</th>
                                <th>ПРИБЫЛЬ</th>  -->
                               <th>ЧИСТАЯ  <br> ПРИБЫЛЬ (-20%)</th>
                               <th>ВСЕ <br> КЛИЕНТЫ</th>
                               <th>НОВЫЕ <br> КЛИЕНТЫ</th>
                               <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                               <th>АУКЦИОНИСТ <br> ШУБА</th>
                               <th>НАЛ В <br> ЗАЛОГЕ</th>
                             </tr>
                           </thead>
                           <tbody>
                             <?
                              $result = mysqli_query($connect, " SELECT SUM(p1),SUM(proc), region,adressfil,kassa FROM tickets WHERE adressfil = '$adress' AND NOT region IS NULL  GROUP BY kassa  ");

                              while ($data1 = mysqli_fetch_array($result)) {
                                $kassa = $data1['kassa'];

                                $adress = $data1['adressfil'];

                                $result12 =$mysqli->query("SELECT COUNT(*) as count ,SUM(summa_vydachy)  FROM tickets WHERE kassa = '$kassa' AND NOT  status = 11 ");
                                $data89 = mysqli_fetch_array($result12);

                                $result12 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  status = 2 ");
                                $data12 = mysqli_fetch_array($result12);

                                $result13 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  status = 4 ");
                                $data13 = mysqli_fetch_array($result13);

                                $result122 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы' ");
                                $data122 = mysqli_fetch_array($result122);

                                $result5 = mysqli_query($connect, " SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress'  AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы'  ");
                                $data5 = mysqli_fetch_array($result5);


                                $result8 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets  WHERE adressfil = '$adress'  AND status = '5' ");
                                $data8 = mysqli_fetch_array($result8);

                              ?>
                               <tr>
                                 <td><a type="button" href="#" class="btn  btn-block bg-olive btn-flat"><b><?=$kassa;?></b></a></td>
                                   <td>
                                  <?= number_format($data1['SUM(p1)']+$data1['SUM(proc)'] , 0, '.', ' '); ?>
                                </td>
                                <td>
                                  <?= number_format($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)'], 0, '.', ' '); ?>
                                </td>
                                <td>
                                  <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                                </td>
                                 <td>
                                   <?= number_format($data1['SUM(p1)']+$data1['SUM(proc)']+($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)']), 0, '.', ' '); ?>
                                 </td>
                                 <?
                                  $pr = $data1['SUM(p1)']+$data1['SUM(proc)']+($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)']);
                                  $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                                  ?>
                                 <!--  <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->
                                 <td><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                                 <td style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                                 <td><?= number_format($data89['count'], 0, '.', ' '); ?></td>
                                 <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>

                                 <td style="background: #00a759; color: black;"><?= number_format($data5['SUM(summa_vydachy)'], 0, '.', ' ');; ?></td>
                                 <td style="background: #f39d0a; color: black;"><?= number_format($data122['SUM(summa_vydachy)'], 0, '.', ' ');; ?></td>
                                 <td style="background: #de4936; color: black;"><?= number_format($data12['SUM(summa_vydachy)'], 0, '.', ' ');; ?></td>
                               </tr>
                             <?}?>
                           </tbody>
                           <tfoot>

                             <tr style="background: #d3d7df; color: black;">
                               <th>Итого (СУММА)</th>
                               <?
                               $result12 =$mysqli->query("SELECT SUM(p1),SUM(proc),SUM(summa_vydachy),SUM(cena_pr),COUNT(*) as count FROM tickets WHERE region = '$region' AND NOT  status = 11 AND NOT  status = 1 ");
                               $data2 = mysqli_fetch_array($result12);

                               $result12 =$mysqli->query("SELECT SUM(p1),SUM(proc),SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region' AND  status = 5 ");
                               $data3 = mysqli_fetch_array($result12);
                               ?>


                                <th><?= number_format($data2['SUM(p1)']+$data2['SUM(proc)'], 0, '.', ' '); ?></th>
                                <th><?= number_format($data3['SUM(cena_pr)']-$data3['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
                               <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                               <th><?= number_format(($data2['SUM(p1)']+$data2['SUM(proc)'])+($data3['SUM(cena_pr)']-$data3['SUM(summa_vydachy)']), 0, '.', ' '); ?></th>
                               <?
                                $pr = ($data2['SUM(p1)']+$data2['SUM(proc)'])+($data3['SUM(cena_pr)']-$data3['SUM(summa_vydachy)']);
                                $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                                ?>

                               <th><?= number_format($data2['SUM(stabrashod)'] + $data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
                               <th style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></th>
                               <th><?= number_format($data2['count'], 0, '.', ' '); ?></th>
                               <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                               <th style="background: #00a759; color: black;"><?= number_format($ss, 0, '.', ' '); ?></th>
                               <th style="background: #f39d0a; color: black;"><?= number_format($ss2, 0, '.', ' '); ?></th>
                               <th style="background: #de4936; color: black;"><?= number_format($ss3, 0, '.', ' '); ?></th>

                             </tr>

                           </tfoot>


                         </table>
                       </div>

                     </div><!-- /.box-body -->
                     <div class="box-footer clearfix">
                       <ul class="pagination pagination-sm no-margin pull-right">
                         <li>


                         </li>
                       </ul>
                     </div>
                   </div><!-- /.box -->


                 </div><!-- /.col -->

               </div><!-- /.row -->






             </section><!-- /.content -->




           </div><!-- /.content-wrapper -->
