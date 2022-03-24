 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Отчет <?= date('d.m.Y'); ?>
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
       <div class="col-xs-12">
         <div class="box">
           <!-- <div class="box-header">
             <h3 class="box-title"></h3>
           </div> -->
           <div class="box-body">
             <div class="table-responsive">
               <table class="table table-bordered table-hover" style="white-space:nowrap;">
                 <thead>
                   <tr style="background: #398ebd; color: white;">
                     <th rowspan="2">РЕГИОНЫ</th>
                     <th colspan="4" class="text-center">Доход</th>
                     <!-- <th rowspan="2">ДОХОДЫ</th> -->
                     <th rowspan="2">РАСХОДЫ</th>
                     <!--    <th>СТАБ.РАСХОДЫ</th>
                      <th>ТЕК.РАСХОДЫ</th>
                      <th>ПРИБЫЛЬ</th>  -->
                     <th colspan="3" class="text-center">ЧИСТАЯ ПРИБЫЛЬ </th>
                     <th colspan="2" class="text-center">КЛИЕНТЫ</th>
                     <th rowspan="2">ЧИСТАЯ <br> ВЫДАЧА</th>
                     <th colspan="2" class="text-center">АУКЦИОНИСТ</th>
                     <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                   </tr>
                   <tr style="background: #398ebd; color: white;">
                     <th>ЛОМБАРДА</th> 
                     <th>МАГАЗИНА</th>
                     <!-- <th>ДОХОД КОМИССИОНКИ</th> -->
                     <th>ДОП</th>
                     <th>ИТОГ</th>
                     <th>ЛОМБАРДА (-20%)</th>
                     <th>КОМИССИОНКА</th>
                     <th>ИТОГ</th>
                     <th>ВСЕ </th>
                     <th>НОВЫЕ</th>
                     <th>ТЕХНИКА</th>
                     <th>ШУБА</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?
                  if($_SESSION['logged_user']->root == '3'):

                  $result = mysqli_query($connect, " SELECT id, region,adress, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                      FROM reports WHERE region = '$region'  GROUP BY adress  ");
                  else:
                    $result = mysqli_query($connect, " SELECT id, region,adress, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                        FROM reports WHERE region = '$region'  GROUP BY adress  ");
                  endif;
                    $ss = 0;
                    $ss2 = 0;
                    $ss3 = 0;
                    while ($data1 = mysqli_fetch_array($result)) {
                      $region =  $data1['region'];
                      $adress=  $data1['adress'];
                      if($adress == 'Тауелсыздык 45/1'){
                        $adress1 = 'Тауелсыздык 45';
                      }else {
                        $adress1 = $adress;
                      }
                    ?>
                   <tr>
                     <td><a href="#" class="btn btn-block bg-olive"> <?= $data1['adress']; ?></a></td>
                     <td>
                       <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
                     </td>
                     <td>
                       <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
                     </td>
                     <!-- <td>
                        <?= number_format($data1['SUM(dk)'], 0, '.', ' '); ?>
                      </td> -->
                     <td>
                       <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                     </td>
                     <td class="info">
                       <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                     </td>
                     <!--  <td><?= number_format($data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                      <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td> -->
                     <?
                        $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                        $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                        ?>
                     <!--  <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->
                     <td><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                     <td style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                     <?
                       $region1 = $region;
                       if($region1 == 'Астана'){$region1= 'Нур-султан';};
                       $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-02-01' AND '2021-02-28' ");
                       $data89 = mysqli_fetch_array($result12);

                       $result19 =$mysqli->query("SELECT SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND status = '4' AND datavykup BETWEEN '2021-02-01' AND '2021-02-28' ");
                       $data19 = mysqli_fetch_array($result19);

                       $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress1' AND status = '5' AND datesale BETWEEN '2021-02-01' AND '2021-02-28'  ");
                       $data81 = mysqli_fetch_array($result81);


                  //     $result812 = mysqli_query($connect, " SELECT SUM(summa) FROM plancomission  WHERE region = '$region1' AND vid = '2'  ");
                    //   $data451 = mysqli_fetch_array($result812);

                       $chistaya1 = $data89['SUM(p1)']+$data19['SUM(proc)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)'])+$data81['SUM(profit)']-$data451['SUM(summa)'];                                                  // чистая прибыль  = за минусом 20 процентов
                        ?>

                     <th class="danger"><?= number_format($chistaya1, 0, '.', ' '); ?></th>
                     <th class="success"><?= number_format($chistaya1 + $chistaya, 0, '.', ' '); ?></th>
                     <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                     <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                     <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                     <?
                        $result4 = mysqli_query($connect, "SELECT *FROM reports WHERE adress='$adress' GROUP BY adress ");

                        $s = 0;
                        $s2 = 0;
                        $s3 = 0;

                        while ($data4 = mysqli_fetch_array($result4)) {
                          $filial =  $data4['adress'];
                          $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports WHERE segdata=(SELECT MAX(segdata) FROM reports WHERE region = '$region' AND adress = '$filial' ) ");
                          $data5 = mysqli_fetch_array($result5);

                          $s += $data5['auktech'];
                          $s2 += $data5['aukshubs'];
                          $s3 += $data5['nalvzaloge'];
                        }
                        $ss += $s;
                        $ss2 += $s2;
                        $ss3 += $s3;
                        ?>
                     <td style="background: #00a759; color: black;"><?= number_format($s, 0, '.', ' ');; ?></td>
                     <td style="background: #f39d0a; color: black;"><?= number_format($s2, 0, '.', ' ');; ?></td>
                     <td style="background: #de4936; color: black;"><?= number_format($s3, 0, '.', ' ');; ?></td>
                   </tr>
                   <? } ?>
                 </tbody>
                 <tfoot>
                   <?
                   if($_SESSION['logged_user']->root == '3'):

                   $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                       FROM reports WHERE region='$region'  ");
                   else:
                     $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                         FROM reports WHERE region='$region'   ");
                   endif;

                    $data2 = mysqli_fetch_array($result2);
                    ?>
                   <tr style="background: #d3d7df; color: black;">
                     <th>Итого (СУММА)</th>
                     <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                     <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                     <!-- <th><?= number_format($data2['SUM(dk)'], 0, '.', ' '); ?></th> -->
                     <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                     <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                     <!--    <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th> -->
                     <?
                      $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
                      $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                      ?>

                     <!--   <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->
                     <th><?= number_format($data2['SUM(stabrashod)'] + $data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
                     <th style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></th>
                     <?
                     $region1 = $region;

                     if($region1 == 'Астана'){$region1= 'Нур-султан';};

                     $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1)  FROM tickets WHERE region='$region1' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-02-01' AND '2021-02-28' ");
                     $data89 = mysqli_fetch_array($result12);

                     $result19 =$mysqli->query("SELECT  SUM(proc)  FROM tickets WHERE region='$region1' AND status = '4'  AND datavykup BETWEEN '2021-02-01' AND '2021-02-28' ");
                     $data29  = mysqli_fetch_array($result19);


                     $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region='$region1' AND status = '5' AND datesale BETWEEN '2021-02-01' AND '2021-02-28'  ");
                     $data81 = mysqli_fetch_array($result81);

                  //   $result812 = mysqli_query($connect, " SELECT SUM(summa) FROM plancomission  WHERE vid = '2'  ");
                  //   $data451 = mysqli_fetch_array($result812);

                  //   $chistaya1 = $data89['SUM(p1)']+$data29['SUM(proc)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)'])+$data81['SUM(profit)']-$data451['SUM(summa)'];                                                  // чистая прибыль  = за минусом 20 процентов

                     $chistaya1 = $data29['SUM(proc)']+$data89['SUM(p1)']+$data81['SUM(profit)']-$data451['SUM(summa)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)']);

                      ?>
 
                     <th class="danger"><?= number_format($chistaya1, 0, '.', ' '); ?></th>
                     <th class="success"><?= number_format($chistaya1 + $chistaya, 0, '.', ' '); ?></th>
                     <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                     <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                     <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
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

     <div class="row">
       <div class="col-xs-12">
         <div class="box">

           <div class="box-body">
             <div class="table-responsive">
               <table class="table table-bordered table-hover" style="white-space:nowrap;">
                 <thead>
                   <tr style="background: #398ebd; color: white;">
                     <th>РЕГИОНЫ</th>
                     <th>ДОХОД <br> КОМИССИОНКИ</th>
                     <th>ДОХОД <br> МАГАЗИНА</th>
                     <th>ДОП <br> ДОХОДЫ</th>
                     <th>ДОХОДЫ</th>
                     <th>РАСХОДЫ</th>
                     <!--<th>СТАБ.РАСХОДЫ</th>
                      <th>ТЕК.РАСХОДЫ</th>
                      <th>ПРИБЫЛЬ</th>  -->
                     <th>ЧИСТАЯ <br> ПРИБЫЛЬ</th>
                     <th>ВСЕ <br> КЛИЕНТЫ</th>
                     <th>НОВЫЕ <br> КЛИЕНТЫ</th>
                     <th>АУКЦИОНИСТ <br> ТЕХНИКА</th>
                     <th>АУКЦИОНИСТ <br> ШУБА</th>
                     <th>НАЛ В <br> ЗАЛОГЕ</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?


                    if($_SESSION['logged_user']->root == '3'):

                    $result = mysqli_query($connect, " SELECT SUM(p1), region,adressfil FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-02-01' AND '2021-02-28' AND region = '$region1'  GROUP BY adressfil  ");

                    else:
                      $result = mysqli_query($connect, " SELECT SUM(p1),SUM(proc), region,adressfil FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-02-01' AND '2021-02-28' AND region = '$region1' GROUP BY adressfil  ");
                    endif;

                    while ($data1 = mysqli_fetch_array($result)) {
                      $adress = $data1['adressfil'];
                      $region = $data1['region'];

                      $result19 = mysqli_query($connect, " SELECT SUM(proc) FROM tickets WHERE status = '4' AND adressfil = '$adress' AND datavykup BETWEEN '2021-02-01' AND '2021-02-28'  ");
                      $data19 = mysqli_fetch_array($result19);

                      $result12 =$mysqli->query("SELECT COUNT(*) as count ,SUM(summa_vydachy)  FROM tickets WHERE adressfil = '$adress' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '2021-02-01' AND '2021-02-28' ");
                      $data89 = mysqli_fetch_array($result12);

                      $result12 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы' ");
                      $data12 = mysqli_fetch_array($result12);

                      $result13 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  status = '4' AND dataseg BETWEEN '2021-02-01' AND '2021-02-28' ");
                      $data13 = mysqli_fetch_array($result13);

                      $result122 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы'  ");
                      $data122 = mysqli_fetch_array($result122);

                      $result5 = mysqli_query($connect, " SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress'  AND status = '2' AND dataseg BETWEEN '2021-02-01' AND '2021-02-28'  ");
                      $data5 = mysqli_fetch_array($result5);

                      $result8 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress' AND status = '5' AND datesale BETWEEN '2021-02-01' AND '2021-02-28'  ");
                      $data8 = mysqli_fetch_array($result8);

                    //  $result812 = mysqli_query($connect, " SELECT SUM(summa) FROM plancomission  WHERE region = '$region' AND vid = '2'  ");
                    //  $data451 = mysqli_fetch_array($result812);

                    ?>
                   <tr>
                     <td><b><?= $data1['adressfil']; ?></b> </td>
                     <td>
                       <?= number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' '); ?>
                     </td>
                     <td>
                       <?= number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' '); ?>
                     </td>
                     <td>
                       0
                     </td>
                     <td>
                       <?= number_format($data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']), 0, '.', ' '); ?>
                     </td>
                     <?
                        $chistaya = $data1['SUM(p1)']+$data19['SUM(proc)']+($data8['SUM(cena_pr)']-$data8['SUM(summa_vydachy)'])+$data8['SUM(profit)']-$data451['SUM(summa)'];                                                  // чистая прибыль  = за минусом 20 процентов
                        ?>
                     <!--  <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->

                     <!-- <td><?= number_format($data8['SUM(profit)'], 0, '.', ' '); ?></td> -->
                     <!-- <td><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td> -->
                     <td><?= number_format($data451['SUM(summa)'], 0, '.', ' '); ?></td>
                     <th style="background: #00c2f0; color: black;"><?= number_format($chistaya, 0, '.', ' '); ?></th>
                     <td><?= number_format($data89['count'], 0, '.', ' '); ?></td>
                     <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>

                     <td style="background: #00a759; color: black;"><?= number_format($data12['SUM(summa_vydachy)'], 0, '.', ' ');; ?></td>
                     <td style="background: #f39d0a; color: black;"><?= number_format($data122['SUM(summa_vydachy)'], 0, '.', ' ');; ?></td>
                     <td style="background: #de4936; color: black;"><?= number_format($data5['SUM(summa_vydachy)'], 0, '.', ' '); ?></td>
                   </tr>
                   <?}?>
                 </tbody>
                 <tfoot>

                   <tr style="background: #d3d7df; color: black;">
                     <th>Итого (СУММА)</th>
                     <?
                     $result12 =$mysqli->query("SELECT SUM(p1), SUM(summa_vydachy),SUM(cena_pr),COUNT(*) as count FROM tickets WHERE  NOT  status = 11 AND NOT  status = 1 AND region = '$region' AND dataseg BETWEEN '2021-02-01' AND '2021-02-28'  ");
                     $data2 = mysqli_fetch_array($result12);

                     $result19 =$mysqli->query("SELECT SUM(proc)  FROM tickets WHERE status = 4 AND region = '$region' AND datavykup BETWEEN '2021-02-01' AND '2021-02-28'  ");
                     $data19 = mysqli_fetch_array($result19);

                      $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(cena_pr),SUM(profit)  FROM tickets WHERE  status = '5'  AND datesale BETWEEN '2021-02-01' AND '2021-02-28' AND region = '$region'  ");
                      $data33 = mysqli_fetch_array($result12);
                      $result12 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE   (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы' AND region = '$region'  ");
                      $data12 = mysqli_fetch_array($result12);
                      $result122 =$mysqli->query("SELECT SUM(summa_vydachy) FROM tickets WHERE  (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы' AND region = '$region'  ");
                      $data122 = mysqli_fetch_array($result122);
                      $result8 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets  WHERE status = '2' AND region = '$region'  ");
                      $data8 = mysqli_fetch_array($result8);
                     ?>
                     <th><?= number_format($data2['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' '); ?></th>

                     <th><?= number_format(($data33['SUM(cena_pr)'] - $data33['SUM(summa_vydachy)']) + $data33['SUM(profit)'], 0, '.', ' '); ?></th>

                     <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                     <th><?= number_format(($data2['SUM(p1)'] + $data19['SUM(proc)']) + ($data33['SUM(cena_pr)'] - $data33['SUM(summa_vydachy)']) + $data33['SUM(profit)'], 0, '.', ' '); ?></th>
                     <?
                      $chistaya = ($data2['SUM(p1)']+$data19['SUM(proc)'])+($data33['SUM(cena_pr)']-$data33['SUM(summa_vydachy)'])+$data33['SUM(profit)']-$data451['SUM(summa)']; // чистая прибыль?>

                     <!-- <th><?= number_format($data2['SUM(stabrashod)'] + $data2['SUM(tekrashod)'], 0, '.', ' '); ?></th> -->


                     <td><?= number_format($data451['SUM(summa)'], 0, '.', ' '); ?></td>



                     <th style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></th>
                     <th><?= number_format($data2['count'], 0, '.', ' '); ?></th>
                     <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                     <th style="background: #00a759; color: black;"><?= number_format($data12['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
                     <th style="background: #f39d0a; color: black;"><?= number_format($data122['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
                     <th style="background: #de4936; color: black;"><?= number_format($data8['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
                   </tr>
                 </tfoot>
               </table>
             </div>
           </div><!-- /.box-body -->
           <div class="box-footer clearfix">
             <ul class="pagination pagination-sm no-margin pull-right">
               <li>
                 <!--  -->
               </li>
             </ul>
           </div>
         </div><!-- /.box -->
       </div><!-- /.col -->
     </div><!-- /.row -->
 </div><!-- /.content-wrapper -->