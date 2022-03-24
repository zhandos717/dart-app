
<? //проверка существовании сессии
          $today = date('Y-m-d');
          $region = $_GET['region'];
          $adress = $_GET['adress'];
          $kassa = $_POST['kassa'];
          $data1 = $_POST['date1'];
          $data2 = $_POST['date2'];
          $status = $_POST['status'];
  if($_POST['date1'] AND $_POST['date2']){
                                      $data1 = $_POST['date1'];
                                      $data2 = $_POST['date2'];
                                    } else {
                                      $data1 = $today;
                                      $data2 = $today;
                                    };


    $result12 = mysqli_query($connect,"SELECT kassa,adress ,MIN(summstart), SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome),SUM(summstart),SUM(endsumm) FROM repotscom WHERE adress = '$adress' AND datereport BETWEEN '$data1' AND '$data2'  GROUP BY kassa ");

?>
    <script type="text/javascript" src="linkedselect.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Движение денежных средств по кассам
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
                   <form action="a_report.php?id=4&adress=<?=$adress;?>" method="POST">
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
                                       <!-- <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-bank"></i>
                                               </span>
                                               <select class="form-control"  id="List1" name="region">
                                                 <option value="Все">Все</option>
                                                 <option value="Нур-султан">Нур-султан</option>
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
                                       </div> -->
                                       <div class="input-group input-group-sm">
                                           <!-- <span class="input-group-btn">     </span> -->
                                             <button type="submit" class="btn-success btn ">Подтвердить!</button>
                                     </div>
                                     </form>
                      </div><!--.box-body -->
                   </div> <!--.box -->
                 </div>
          <!--------------------------------------------------------------------------->
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title text-center"><b> Отчет комисcионного магазина c <?= date("d.m.Y", strtotime($data1)); ?> по  <?= date("d.m.Y", strtotime($data2)); ?>  </b></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example" class="tableas table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                          <th rowspan="2" class="success">№</th>
                          <th rowspan="2" class="success">Филиал</th>
                          <th rowspan="2" class="success">Касса</th>
                          <th rowspan="2" class="success">Касса на начало периода</th>
                          <th rowspan="2" class="success">Выдано кредитов</th>
                          <th rowspan="2" class="success">Возвращено кредитов</th>
                          <th rowspan="2" class="success">Пополнение кассы</th>
                          <th rowspan="2" class="success">Изъятие из кассы</th>
                          <th rowspan="2" class="success">Касса на конец периода</th>
                          <th rowspan="2" class="success" style="width:10rem;"> Изъятие товара</th>
                          <th rowspan="2" class="success">Вознаграждение %</th>
                          <th rowspan="2" class="success" style="width:10rem;">% при рассторжение на срок договора</th>
                          <th colspan="2" class="success">Релизация</th>
                          <th rowspan="2" class="success">Кредитный портфель</th>
                        </tr>
                        <tr>
                          <th class="danger">Выручка</th>
                          <th class="danger">Прибыль</th>
                        </tr>

                    </thead>
                          <tbody style="white-space:nowrap;">
                            <?
                            $i = 1;
                            while ($data12 = mysqli_fetch_array($result12)) {
                              $kassa =$data12['kassa'];

                              $result13 = mysqli_query($connect,"SELECT SUM(summstart) FROM repotscom WHERE adress ='$adress'  AND datereport = '$data1' AND kassa = '$kassa' ");
                              $data13 = mysqli_fetch_array($result13);

                              $result14 = mysqli_query($connect,"SELECT SUM(endsumm) FROM repotscom WHERE adress ='$adress' AND datereport = '$data2' AND kassa = '$kassa' ");
                              $data14 = mysqli_fetch_array($result14);

                            ?>
                            <tr>

                            <td><?=$i++;?>.</td>
                            <td>
                            <a type="button" href="a_report.php?id=4&adress=<?=$data12['adress'];?>" class="btn  btn-block bg-olive btn-flat"><b><?=$data12['adress'];?></b></a>
                            </td>
                            <td>
                            <a type="button" href="#" class="btn  btn-block bg-olive btn-flat"><b><?=$data12['kassa'];?></b></a>
                            </td>
                            <td><?= number_format($data13['SUM(summstart)'], 0, '.', ' '); ?></td>

                            <td><?= number_format($data12['SUM(vydacha)'], 0, '.', ' ');?></td>

                            <td><?= number_format($data12['SUM(vozvrat)'], 0, '.', ' ');?></td>

                            <td><?= number_format($data12['SUM(finhelp)'], 0, '.', ' '); ?></td>

                            <td><?= number_format($data12['SUM(withdrawal)'], 0, '.', ' ');?></td>

                            <td><?= number_format($data14['SUM(endsumm)'], 0, '.', ' '); ?></td>

                            <td>0</td>

                            <td><?= number_format($data12['SUM(comis)'], 0, '.', ' '); ?></td>

                            <td><?=number_format($data12['SUM(proc)'], 0, '.', ' ');?></td>

                            <td><?=number_format($data12['SUM(summsale)'], 0, '.', ' ');?></td>

                            <td><?=number_format($data12['SUM(salesincome)'], 0, '.', ' ');?></td>

                            <td>0</td>
                              </tr>
                            <?}?>
                          </tbody>
                          <?

                          $result12 = mysqli_query($connect,"SELECT adress, SUM(summstart), SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome),SUM(summstart),SUM(endsumm) FROM repotscom WHERE datereport BETWEEN '$data1' AND '$data2' AND adress ='$adress' AND kassa = '$kassa'  ");
                          $data12 = mysqli_fetch_array($result12);

                          $result16 = mysqli_query($connect,"SELECT SUM(summstart) FROM repotscom WHERE datereport ='$data1'  AND adress ='$adress' ");
                          $data16 = mysqli_fetch_array($result16);

                          $result15 = mysqli_query($connect,"SELECT adress, SUM(endsumm) FROM repotscom WHERE datereport ='$data2'  AND adress ='$adress' ");
                          $data15 = mysqli_fetch_array($result15);
                          ?>

                          <tr style="white-space:nowrap;">
                            <th colspan="3" > Итого:</th>
                            <th><?= number_format($data16['SUM(summstart)'], 0, '.', ' '); ?></th> <!---->

                            <th><?= number_format($data12['SUM(vydacha)'], 0, '.', ' ');?></th>
                            <th><?= number_format($data12['SUM(vozvrat)'], 0, '.', ' ');?></th>

                            <th><?= number_format($data12['SUM(finhelp)'], 0, '.', ' '); ?></th>

                            <th><?= number_format($data12['SUM(withdrawal)'], 0, '.', ' ');?></th>
                            <th><?= number_format($data15['SUM(endsumm)'], 0, '.', ' '); ?></th>       <!---->
                            <th>0</th>
                            <th><?= number_format($data12['SUM(comis)'], 0, '.', ' '); ?></th>

                            <th><?=number_format($data12['SUM(proc)'], 0, '.', ' ');?></th>

                            <th><?=number_format($data12['SUM(summsale)'], 0, '.', ' ');?></th>
                            <th><?=number_format($data12['SUM(salesincome)'], 0, '.', ' ');?></th>
                            <th>0</th
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
    </div><!--.col-md-12 -->

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
