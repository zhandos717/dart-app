 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <h1>
             Результаты поиска:
         </h1>
         <br />
         <ol class="breadcrumb">
             <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная <?= $string; ?></a></li>
         </ol>
     </section>
     <!--###################################################-->
     <section class="content">
         <div class="row">
             <div class="col-xs-12">
                 <div class="box">
                     <div class="box-body">
                         <div class="table-responsive"> 
                             <table class="table table-bordered">
                                 <tr class="danger">
                                     <th>Код товара</th>
                                     <th>Клиент</th>
                                     <th>Номер</th>
                                     <th>Описание</th>
                                     <th>Сумма выдачи</th>
                                     <th>Сумма продажи</th>
                                     <th>Дата выдачи</th>
                                     <th>Дата окончание срока</th>
                                     <th>Дата поступления в магазин </th>
                                     <th>Комиссионер</th>
                                     <th>Статус</th>
                                     <th>Примечение</th>
                                 </tr>
                                 <? $result = R::findAll('tickets', 'status = 12'); //mysqli_query($connect, "SELECT * FROM tickets WHERE  ");
                                    foreach ($result as $data_zb) {
                                        $statuszb = R::load('status_zb', $data_zb['status']);
                                        $withdrawal = R::findOne('withdrawal', 'nomerzb=?', [$data_zb['status']]);
                                    ?>
                                     <tr>
                                         <td><?= $data_zb['nomerzb']; ?></td>
                                         <td><?= $data_zb['fio']; ?></td>
                                         <td><?= $data_zb['phones']; ?></td>
                                         <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                                             SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                                         </td>
                                         <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                                         <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                                         <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                                         <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                                         <td>
                                             <? if ($data_zb['dateshop']) {
                                                    echo date("d.m.Y", strtotime($data_zb['dateshop']));
                                                } else {
                                                    echo '--';
                                                } ?>
                                         </td>
                                         <td><?= $data_zb['eo']; ?></td>
                                         <td><?= $statuszb['name']; ?></td>
                                         <td><?= $withdrawal['message']; ?></td>
                                     </tr>
                                 <? } ?>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section><!-- /.content -->
 </div><!-- /.content-wrapper -->