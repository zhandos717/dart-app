<? //проверка существовании сессии
          $today = date('Y-m-d');
          $region = $_POST['region'];
          $adress = $_POST['adress'];
          $kassa = $_POST['kassa'];
          $data1 = $_POST['date1'];
          $data2 = $_POST['date2'];
          $status = $_POST['status'];

          $exel_post  = R::load(postexel,1);
          $exel_post->region = $region;
          $exel_post->adress = $adress;
          $exel_post->kassa = $kassa;
          $exel_post->date1 = $data1;
          $exel_post->date2 = $data2;
          $exel_post->status = $status;
          R::store($exel_post);




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
                   <form action="prtovary.php" method="POST">
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

                                       <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-tag"></i>
                                               </span>
                                               <select class="form-control" name="status">
                                                <option value="Все">Все</option>
                                                 <? $result2 = mysqli_query($connect,"SELECT *FROM status_zb ");
                                                 while ($data_zb = mysqli_fetch_array($result2)){?>
                                                <option value="<?=$data_zb['id'];?>"><?=$data_zb['name'];?></option>
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
                      </div><!--.box-body -->
                   </div> <!--.box -->
                 </div> <!--.col-md-12 -->
          <!--------------------------------------------------------------------------->
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <a href="commis/print_report.php" target="_blank" title="Выгрузка в эксель" class="btn btn-success"><i class="fa fa-file-excel-o"></i></a>  <h3 class="box-title"><b>  <?= $comment;?></b></h3>
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
                        <input hidden type="text" name="regionlombard" value="<?=$regionlombard;?>">
                        <input hidden type="text" name="adresslombard" value="<?=$adresslombard;?>">
                        <input hidden type="text" name="datapr" value="<?=$datapr;?>">
                        <input hidden type="text" name="nomerzb" value="<?=$nomerzb;?>">
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
                          <!--  <td><input type="submit" name="gogo" class="btn btn-success" value="Принять"></td> -->
                      </form>
                    </tr>
                    <? } ?>
                    </tbody>
                    <tfoot>
                        <tr class="danger">
                            <th colspan="3" class="text-center">Итого:</th>
                            <th colspan="3" class="text-center">Сумма выдачи: <?= number_format($data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                            <th colspan="3" class="text-center">Сумма продажи: <?= number_format($data22['SUM(cena_pr)'], 0, '.', ' '); ?>  тг.</th>
                            <th colspan="2" class="text-center">Доход: <?= number_format($data22['SUM(cena_pr)']-$data22['SUM(summa_vydachy)'], 0, '.', ' '); ?>  тг.</th>
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
