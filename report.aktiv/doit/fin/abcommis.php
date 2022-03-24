<? //проверка существовании сессии
include("../../bd.php");

$t = $_GET['t'];

if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  $active1 = 'active';
  if ($_SESSION['logged_user']->status == 11) :
?>

    <? include "header.php"; ?>
    <? include "app/menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->



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
                              $result12 = mysqli_query($connect,"SELECT * FROM repotscom WHERE region = '$region' AND adress = '$adress' AND datereport BETWEEN '$data1' AND '$data2'");
                              $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                              $result22 =$mysqli->query("SELECT SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom WHERE region = '$region' AND adress = '$adress' AND datereport BETWEEN '$data1' AND '$data2'"  );
                              $data22 = mysqli_fetch_array($result22);
                                }
                                if($adress == 'Все'){
                                                      $result12 = mysqli_query($connect,"SELECT * FROM repotscom WHERE region = '$region' AND datereport BETWEEN '$data1' AND '$data2' ");
                                                      $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                      $result22 =$mysqli->query("SELECT SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom WHERE region = '$region' AND datereport BETWEEN '$data1' AND '$data2'"  );
                                                      $data22 = mysqli_fetch_array($result22);
                                                    }
        // if($adress != $status){
        //                               $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND status = '$status' AND  (dataseg BETWEEN '$data1' AND '$data2')");
        //                                 $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));
        //
        //                                 $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region' AND status = '$status'  AND dataseg BETWEEN '$data1' AND '$data2'");
        //                                 $data22 = mysqli_fetch_array($result12);
        //                                 }
        // if($status AND ($adress != 'Все') AND ($status == 'Все')){
        //                               $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress'  AND  (dataseg BETWEEN '$data1' AND '$data2')");
        //                                 $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));
        //
        //                                 $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'  AND dataseg BETWEEN '$data1' AND '$data2'");
        //                                 $data22 = mysqli_fetch_array($result12);
        //                               };
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
              <li><a href="index.php">Регионы</a></li>
              <li class="active">Филиалы</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
             <span class="info-box-icon bg-aqua"><i class="fa fa-cart-arrow-down"></i></span>

             <div class="info-box-content">
               <?php
               $result108=$mysqli->query("SELECT COUNT(dataseg) as count FROM tickets WHERE (status = '10' OR  status = '14' OR status = '15')" );
               $data108 = mysqli_fetch_array($result108);?>

               <span class="info-box-text">Товаров в магазине</span>
               <span class="info-box-number"><?=$data108['count'];?></span>
             </div>
             <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
             <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-folder-close"></i></span>

             <div class="info-box-content">
               <?php
               $result102 =$mysqli->query("SELECT COUNT(dataseg) as count FROM tickets WHERE status = '2'" );
               $data102 = mysqli_fetch_array($result102);?>
               <span class="info-box-text">Товаров в залоге</span>
               <span class="info-box-number"><?=$data102['count'];?></span>
             </div>
             <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
         </div>
         <!-- /.col -->

         <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
             <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

             <div class="info-box-content">
               <?php
               $result112 =$mysqli->query("SELECT COUNT(dataseg) as count FROM tickets WHERE status = '5'" );
               $data112 = mysqli_fetch_array($result112);?>
               <span class="info-box-text">Проданных товаров</span>
               <span class="info-box-number"><?=$data112['count'];?></span>
             </div>
             <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
           <div class="info-box">
             <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
             <?php
                           $datss = date('y-m-d');
                           $result122 =$mysqli->query("SELECT COUNT(dataseg) as count FROM tickets" );
                             $data122 = mysqli_fetch_array($result122);
                             ?>
             <div class="info-box-content">
               <span class="info-box-text">Количество клиентов</span>
               <span class="info-box-number"><?=$data122['count'];?></span>
             </div>
             <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->

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
                       <form action="abcommis.php" method="POST">
                         <div class="col-lg-2 col-md-2 col-sm-2">
                           <div class="input-group">
                                  <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?=$today;?>" value="<?=$data1;?>" name="date1">
                            </div>
                            <!-- /input-group -->
                         </div>

                          <div class="col-lg-2 col-md-2 col-sm-2">
                           <div class="input-group">
                                  <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?=$today;?>" value="<?=$data2;?>" name="date2">
                            </div>
                            <!-- /input-group -->
                         </div>
                                           <div class="col-lg-2 col-md-4">
                                             <div class="input-group">
                                                   <span class="input-group-addon">
                                                   <i class="fa fa-bank"></i>
                                                   </span>
                                                   <select class="form-control"  id="List1" name="region">
                                                     <option value="Нур-султан">Нур-султан</option>>
                                                     <option value="Актау">Актау</option>
                                                     <option value="Актобе">Актобе</option>
                                                     <option value="Алматы">Алматы</option>
                                                     <option value="Атырау">Атырау</option>
                                                     <option value="Караганда">Караганда</option>
                                                     <option value="Кокшетау">Кокшетау</option>
                                                     <option value="Костанай">Костанай</option>
                                                     <option value="Павлодар">Павлодар</option>
                                                     <option value="Семей">Семей</option>
                                                     <option value="Талдыкорган">Талдыкорган</option>
                                                     <option value="Тараз">Тараз</option>
                                                     <option value="Шымкент">Шымкент</option>
                                                   </select>
                                             </div>
                                           </div>
                                           <div class="col-lg-2 col-md-4">
                                             <div class="input-group">
                                                   <span class="input-group-addon">
                                                   <i class="fa fa-building"></i>
                                                   </span>
                                                   <select class="form-control"  id="List2" name="adress">

                                                    <option value="<?=$adress;?>"><?=$adress;?></option>

                                                   </select>
                                             </div>
                                           </div>

                                           <!-- <div class="col-lg-2 col-md-4">
                                             <div class="input-group">
                                                   <span class="input-group-addon">
                                                   <i class="fa fa-building"></i>
                                                   </span>
                                                   <select class="form-control" name="status">
                                                    <option value="Все">Все</option>
                                                     <? $result2 = mysqli_query($connect,"SELECT *FROM status_zb ");
                                                     while ($data_zb = mysqli_fetch_array($result2)){?>
                                                    <option value="<?=$data_zb['id'];?>"><?=$data_zb['name'];?></option>
                                                    <?}?>
                                                   </select>
                                             </div>
                                           </div> -->
                                           <div class="input-group input-group-sm">
                                               <span class="input-group-btn">
                                                 <button type="submit" class="btn btn-info btn-sm">Подтвердить!</button>
                                               </span>
                                         </div>
                                         </form>
                          </div><!--.box-body -->
                       </div> <!--.box -->
                     </div> <!--.col-md-12 -->
              <!--------------------------------------------------------------------------->
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title"><b><?= $comment;?></b></h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table id="example1" class="tableas table table-hover table-bordered">
                        <thead>
                            <tr class="success">
                              <th>№П/П</th>
                              <th>Город</th>
                              <th>Адресс</th>
                              <th>Дата</th>
                              <th>Пополнение</th>
                              <th>Изъятие</th>
                              <th>Выдача</th>
                              <th>0,5 %</th>
                              <th>Возврат</th>
                              <th>1 %</th>
                              <th>Продано на</th>
                              <th>Прибыль</th>
                              <th>На конец дня</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?
                          $i = 1;
                            while ($data12 = mysqli_fetch_array($result12)) {  ?>
                              <tr>
                                <td class="success"><?=$i++;?>.</td>
                                <td><?=$data12['region'];?></td>
                                <td><?=$data12['adress'];?></td>
                                <td><?= date("d.m.Y", strtotime($data12['datereport'])); ?></td>

                                <?if($data12['finhelp'] > 0){ echo '<td class="info">'.number_format($data12['finhelp'], 0, '.', ' ') .'</td>';}
                                else{ echo '<td>'. number_format($data12['finhelp'], 0, '.', ' ').'</td>';}?>

                                <?if($data12['withdrawal'] > 0){ echo '<td class="danger">'.number_format($data12['withdrawal'], 0, '.', ' ') .'</td>';}
                                else{ echo '<td>'. number_format($data12['withdrawal'], 0, '.', ' ').'</td>';}?>


                                <td><?=number_format($data12['vydacha'], 0, '.', ' ');?></td>
                                <?
                                $comis = round($data12['vydacha']*0.005);
                                $comis1 = round($data12['comis']-$comis);
                                if($comis != $data12['comis']){
                                if($comis1 > 0){?>
                                  <td class="warning"><?echo $data12['comis'].'-'.$comis.'='.$comis1?></td>
                                <?}
                                  if($comis1 < 0){?>
                                  <td class="danger"> <?echo $data12['comis'].'-'.$comis.'='.$comis1?></td>
                                  <?}?>
                                  <?}else {?>
                                    <td><?=number_format($data12['comis'], 0, '.', ' ');?></td>
                                  <?}?>
                                <td><?=number_format($data12['vozvrat'], 0, '.', ' ');?></td>
                                <td><?=number_format($data12['proc'], 0, '.', ' ');?></td>

                                <?if($data12['summsale'] > 0){ echo '<td class="success">'.number_format($data12['summsale'], 0, '.', ' ') .'</td>';}
                                else{ echo '<td>'. number_format($data12['summsale'], 0, '.', ' ').'</td>';}?>

                                <td><?=number_format($data12['salesincome']+$data12['comis']+$data12['proc'], 0, '.', ' ');?></td>
                                <td><?=number_format($data12['endsumm'], 0, '.', ' ');?></td>
                              </tr>
                            <?}?>
                        </tbody>
                        <tfoot>

                          <th colspan="4" class="text-center"> Итого: </th>
                        <th> <?=$data22['SUM(finhelp)'];?></th>
                        <th> <?=$data22['SUM(withdrawal)'];?></th>
                        <th> <?=$data22['SUM(vydacha)'];?></th>
                        <th> <?=$data22['SUM(comis)'];?></th>
                        <th> <?=$data22['SUM(vozvrat)'];?></th>
                        <th> <?=$data22['SUM(proc)'];?></th>
                        <th> <?=$data22['SUM(summsale)'];?></th>
                        <th> <?=$data22['SUM(salesincome)']+$data22['SUM(proc)']+$data22['SUM(comis)'];?></th>
                        <th><?=$data22['SUM(finhelp)']-$data22['SUM(withdrawal)']-$data22['SUM(vydacha)']+($data22['SUM(comis)']+$data22['SUM(vozvrat)']+$data22['SUM(proc)']+$data22['SUM(summsale)']);?>  </th>

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
          // Создаем новый объект связанных списков
          var syncList1 = new syncList;
          // Определяем значения подчиненных списков (2 и 3 селектов)
          syncList1.dataList = {
            /* Определяем элементы второго списка в зависимости
            от выбранного значения в первом списке */
            'Актау': {
              '11 мкрн дом3': '11 мкрн дом3'
            },

            'Актобе': {
              'Все': 'Все',
              'Абулхаир Хана 84': 'Абулхаир Хана 84',
              'Шернияза 51': 'Шернияза 51'
            },

            'Алматы': {
              'Все': 'Все',
              'Акан Сери 11': 'Акан Сери 11',
              'Ауэзова 169': 'Ауэзова 169',
              'Ауэзова 32': 'Ауэзова 32',
              'Гоголя 91': 'Гоголя 91',
              'Минина 24': 'Минина 24',
              'Назарбаева 118': 'Назарбаева 118',
              'Сатпаева 109': 'Сатпаева 109',
              'Толе би 285': 'Толе би 285'
            },

            'Нур-султан': {
              'Все': 'Все',
              'Кенесары 65': 'Кенесары 65',
              'Абая 8': 'Абая 8',
              'Абылай хана 6': 'Абылай хана 6',
              'Абылайхана 32/2 (Встреча)': 'Абылайхана 32/2 (Встреча)',
              'Бейбитшилик 47': 'Бейбитшилик 47',
              'Кабанбай батыра, 2': 'Кабанбай батыра, 2',
              'Кажымукана 22': 'Кажымукана 22',
              'Сатпаева 23/1': 'Сатпаева 23/1',
              'Сыганак 18': 'Сыганак 18',
              'Тауелсыздык 45': 'Тауелсыздык 45',
              'Комиссионный магазин': 'Комиссионный магазин',
            },


            'Атырау': {
              'Сатпаева 32': 'Сатпаева 32'
            },

            'Караганда': {
              'Все': 'Все',
              'Абдирова 19': 'Абдирова 19',
              'Майкудук 48': 'Майкудук 48',
              'Шахтеров (Ермекова) 52': 'Шахтеров (Ермекова) 52'
            },

            'Кокшетау': {
              'Абая 143': 'Абая 143'
            },


            'Костанай': {
              'Абая 173': 'Абая 173'
            },


            'Павлодар': {
              'Назарбаева 89': 'Назарбаева 89'
            },

            'Семей': {
              'Дулатова 145': 'Дулатова 145'
            },


            'Талдыкорган': {
              'Абая 254': 'Абая 254'
            },

            'Уральск': {
              'Курмангазы 165': 'Курмангазы 165'
            },


            'Тараз': {
              'Все': 'Все',
              'Абая 170': 'Абая 170',
              'Самал 14': 'Самал 14'
            },

            'Шымкент': {
              'Все': 'Все',
              'Байтурсынова 20': 'Байтурсынова 20',
              'Иляева 5/4': 'Иляева 5/4',
              'Назарбекова 11 (Нурсат)': 'Назарбекова 11 (Нурсат)',
              'Рыскулова 24/1': 'Рыскулова 24/1',
              'Рыскулова 84а': 'Рыскулова 84а',
              'Север (Терискей 9)': 'Север (Терискей 9)',
              'Уалиханова 192 (11 мкрн)': 'Уалиханова 192 (11 мкрн)'
            }

          };

          // Включаем синхронизацию связанных списков
          syncList1.sync("List1", "List2");
        </script>



              <? include "footer.php"; ?>

          <?php endif; ?>
          <? else :

            echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
          ?>

            чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

          <?php endif; ?>
