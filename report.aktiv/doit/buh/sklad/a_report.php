
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
                  <table id="example" class="tableas table table-hover table-bordered text-center" >
                    <thead>
                      <?$result12 = mysqli_query($connect,"SELECT region, SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom GROUP BY region ");
                      $data12 = mysqli_fetch_array($result12)

                      ?>
                        <tr>
                          <th rowspan="3" class="success" >Город</th>
                          <th rowspan="3" class="success">Пополнение</th>
                          <th rowspan="3" class="success">Инкасcация</th>
                          <th colspan="5" class="active">Выдача: <?=$data12['SUM(vydacha)'];?> - <span class="text-warning"><?=$data12['SUM(vozvrat)']+($data12['SUM(summsale)']-$data12['SUM(salesincome)']);?></span> = <span class="text-info"><?=$data12['SUM(vydacha)']-($data12['SUM(vozvrat)']+($data12['SUM(summsale)']-$data12['SUM(salesincome)']));?></span> </th>
                          <th rowspan="3" class="success">Прибыль</th>
                          <th rowspan="3" class="success">Наличность в кассе</th>
                          <th rowspan="3" class="success">Рассхождение</th>
                        </tr>
                        <tr class="success">
                          <th colspan="2" class="success">Выдан</th>
                          <th rowspan=" 2" class="warning">Возврат</th>
                          <th colspan="2">Продаж</th>
                        </tr>
                        <tr class="info">
                          <th>В комиссионке</th>
                          <th>На продаже</th>
                          <th class="warning">Через кассу</th>
                          <th>Через банк</th>
                        </tr>
                    </thead>
                          <tbody>
                            <?
                            $result12 = mysqli_query($connect,"SELECT region, SUM(finhelp),SUM(comis),SUM(proc),SUM(vydacha),SUM(vozvrat),SUM(summsale),SUM(withdrawal),SUM(salesincome) FROM repotscom GROUP BY region ");
                            $i = 1;
                              while ($data12 = mysqli_fetch_array($result12)) {
                                $result22 = mysqli_query($connect,"SELECT SUM(cashbox) FROM kassa GROUP BY region ");
                                $data22 = mysqli_fetch_array($result22);
                                $result33 = mysqli_query($connect,"SELECT SUM(summa_vydachy) FROM tickets WHERE status = 2");
                                $data33 = mysqli_fetch_array($result33);
                                $result30 = mysqli_query($connect,"SELECT SUM(summa_vydachy) FROM tickets WHERE (status = 7 OR status = 10 OR status = 14 OR status = 15)");
                                $data30 = mysqli_fetch_array($result30);
                                $result31 = mysqli_query($connect,"SELECT SUM(summa_vydachy) FROM tickets WHERE status = 5");
                                $data31 = mysqli_fetch_array($result31);
                                ?>
                                <tr>
                                  <th><?= $data12['region']; ?></th>
                                  <td><?= number_format($data12['SUM(finhelp)'], 0, '.', ' '); ?></td>
                                  <td><?= number_format($data12['SUM(withdrawal)'], 0, '.', ' ');?></td>
                                  <td><?= number_format($data33['SUM(summa_vydachy)'], 0, '.', ' ');?></td>
                                  <td><?= number_format($data30['SUM(summa_vydachy)'], 0, '.', ' ');?></td>
                                  <td><?= number_format($data12['SUM(vozvrat)'], 0, '.', ' ');?></td>
                                  <td><?= number_format($data12['SUM(summsale)']-$data12['SUM(salesincome)'], 0, '.', ' ');?></td>
                                  <td> <?= number_format($data31['SUM(summa_vydachy)']-$data12['SUM(summsale)'], 0, '.', ' ');?></td>
                                  <td><?= number_format($data12['SUM(comis)']+$data12['SUM(proc)']+$data12['SUM(salesincome)'], 0, '.', ' ');?></td>
                                  <td><?= number_format($data22['SUM(cashbox)'], 0, '.', ' ');?></td>
                                  <td><?= number_format($data12['SUM(finhelp)']-$data12['SUM(withdrawal)']- ($data30['SUM(summa_vydachy)']+$data33['SUM(summa_vydachy)']+$data31['SUM(summa_vydachy)']+$data12['SUM(vozvrat)'])+$data12['SUM(vozvrat)']+$data12['SUM(summsale)']+$data12['SUM(comis)']+$data12['SUM(proc)'], 0, '.', ' '); ?></td>
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
