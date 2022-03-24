<!-- Content Wrapper. Contains page content -->
  <?php
  $region = $_SESSION['logged_user']->region;
  $adress = $_POST['adress'];
  $idx = $_POST['idx'];
  $status_sklad = $_POST['status_sklad'];

  if($region == 'Астана'){
    $region = "Нур-султан";
  };


  if($status_sklad == 14) // Передача на ветрины
          {
              $tickets = R::load('tickets',$idx);
              $tickets->status = $status_sklad;
              $tickets->dateshop = date('Y-m-d');
              R::store($tickets);
          }
  if($status_sklad == 10) // Передача в склад
          {
              $tickets = R::load('tickets',$idx);
              $tickets->status = $status_sklad;
              R::store($tickets);
          }
  if(isset($_POST['remont_submit'])) // Передача на ремонт
          {
              $tickets = R::load('tickets',$idx);
              $tickets->status = $status_sklad;
              $tickets->statusremont = 1;
              $tickets->dateremont = date('Y-m-d');
              $tickets->remontmessage = $_POST['remont_message'];
              R::store($tickets);
          };
  unset($status_sklad);


  // Товары на складе
 if($region == 'Все'){
    $result3 = $mysqli->query("SELECT * FROM tickets WHERE status = '10' ");
    $result10 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE  status = '10'");
    $result14 = $mysqli->query("SELECT * FROM tickets WHERE status = '14' ");
    $result114 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE status = '14'");
    $result15 = $mysqli->query("SELECT * FROM tickets WHERE  status = '15' ");
    $result115 = $mysqli->query("SELECT COUNT(status) as count FROM tickets WHERE status = '15' " );
  }
  if($adress == 'Все' AND $region != 'Все'){
    $result3 = $mysqli->query("SELECT * FROM tickets WHERE region = '$region' AND status = '10' ");
    $result10 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE region = '$region' AND  status = '10'");
    $result14 = $mysqli->query("SELECT * FROM tickets WHERE region = '$region' AND status = '14' ");
    $result114 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE region = '$region' AND status = '14'");
    $result15 = $mysqli->query("SELECT * FROM tickets WHERE region = '$region' AND  status = '15' ");
    $result115 = $mysqli->query("SELECT COUNT(status) as count FROM tickets WHERE region = '$region' AND status = '15' " );
  }
if($adress != 'Все' AND $region != 'Все'){
    $result3 = $mysqli->query("SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND status = '10' ");
    $result10 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND status = '10'");
    $result14 = $mysqli->query("SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND status = '14' ");
    $result114 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND status = '14'");
    $result15 = $mysqli->query("SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND status = '15' ");
    $result115 = $mysqli->query("SELECT COUNT(status) as count FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND status = '15' " );
  }
/*
  // Товары на ветрине
  $result14 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(cena_pr) FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND status = '14'");
  // Товары на ремонте

*/
  ?>

     <div class="content-wrapper no-print">
       <!-- Content Header (Page header) -->
       <section class="content-header">
        <h2 class="box-title">Товары на реализации</h2>
         <ol class="breadcrumb">
           <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
           <li><a href="index.php">Регионы</a></li>
           <li class="active">Магазины</li>
         </ol>
      </section>
       <!-- Main content -->
       <section class="content">
         <div class="row">
           <div class="col-md-12">
              <div class="box box-primary">
                  <div class="box-header">

                      <form action="sklad.php" method="POST">
                        <div class="col-lg-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-bank"></i>
                        </span>
                        <select class="form-control"  id="List1" name="region">
                          <option value="<?=$region;?>"><?=$region;?></option>
                        </select>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                        </span>
                        <select class="form-control"  id="List2" name="adress">

                        </select>
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2">
                  <div class="input-group">
                        <button type="submit" class="btn btn-block btn-primary btn-sm"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Подтвердить</font></font></button>
                  </div>
                  <!-- /input-group -->
                </div>

                     </form>

                    <script type="text/javascript" src="linkedselect.js"></script>
                   </div><!-- /.box-header -->
                  <div class="box-body">
                  <script type="text/javascript">
                    // Создаем новый объект связанных списков
                    var syncList1 = new syncList;

                    // Определяем значения подчиненных списков (2 и 3 селектов)
                    syncList1.dataList = {

                    /* Определяем элементы второго списка в зависимости
                    от выбранного значения в первом списке */

                      'Актау':{
                          '11 мкрн дом3':'11 мкрн дом3'
                      },

                      'Актобе':{
                          'Все':'Все',
                          'Абулхаир Хана 84':'Абулхаир Хана 84',
                          'Шернияза 51':'Шернияза 51'
                          },

                      'Алматы':{
                        'Все':'Все',
                        'Акан Сери 11':'Акан Сери 11',
                        'Ауэзова 169':'Ауэзова 169',
                        'Ауэзова 32':'Ауэзова 32',
                        'Гоголя 91':'Гоголя 91',
                        'Минина 24':'Минина 24',
                        'Назарбаева 118':'Назарбаева 118',
                        'Сатпаева 109':'Сатпаева 109',
                        'Толе би 285':'Толе би 285'
                      },

                      'Нур-султан':{
                        'Все':'Все',
                        'Абая 8':'Абая 8',
                        'Абылай хана 6':'Абылай хана 6',
                        'Абылайхана 32/2 (Встреча)':'Абылайхана 32/2 (Встреча)',
                        'Бейбитшилик 47':'Бейбитшилик 47',
                        'Кабанбай батыра, 2':'Кабанбай батыра, 2',
                        'Кажымукана 22':'Кажымукана 22',
                        'Кенесары 65':'Кенесары 65',
                        'Сатпаева 23/1':'Сатпаева 23/1',
                        'Сыганак 18':'Сыганак 18',
                        'Тауелсыздык 45':'Тауелсыздык 45'
                      },


                      'Атырау':{
                          'Сатпаева 32':'Сатпаева 32'
                      },

                      'Караганда':{
                        'Все':'Все',
                        'Абдирова 19':'Абдирова 19',
                        'Майкудук 48':'Майкудук 48',
                        'Шахтеров (Ермекова) 52':'Шахтеров (Ермекова) 52'
                      },

                      'Кокшетау':{
                          'Абая 143':'Абая 143'
                      },


                      'Костанай':{
                          'Абая 173':'Абая 173'
                      },


                      'Павлодар':{
                          'Назарбаева 89':'Назарбаева 89'
                      },

                      'Семей':{
                          'Дулатова 145':'Дулатова 145'
                      },

                          'Талдыкорган':{
                          'Абая 254':'Абая 254'
                      },


                      'Тараз':{
                          'Абая 170':'Абая 170',
                          'Самал 14':'Самал 14'
                      },

                      'Шымкент':{
                        'Все':'Все',
                        'Байтурсынова 20':'Байтурсынова 20',
                        'Иляева 5/4':'Иляева 5/4',
                        'Назарбекова 11 (Нурсат)':'Назарбекова 11 (Нурсат)',
                        'Рыскулова 24/1':'Рыскулова 24/1',
                        'Рыскулова 84а':'Рыскулова 84а',
                        'Север (Терискей 9)':'Север (Терискей 9)',
                        'Уалиханова 192 (11 мкрн)':'Уалиханова 192 (11 мкрн)'
                      }
                    };
                    // Включаем синхронизацию связанных списков
                    syncList1.sync("List1","List2");
                    </script>

                </div><!--.box-body -->
                    </div> <!--.box -->
                  </div> <!--.col-md-12 -->
  <!--------------------------------------------------------------------------->
                <div class="col-md-12">
                  <div class = "box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title pull-left">Товары филиала <?=$adress;?> на складе г. <?= $region;?> &ensp;</h3>
                      <div class="box-tools pull-right">
                        <button class = "btn btn-box-tool" data-widget = "collapse"> <i class = "fa fa-plus"> </i> </button>
                      </div>
                      <div class="input-group pull-left" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control input-sm pull-right" id="search-text" placeholder="Поиск" onkeyup="tableSearch()">
                        <div class="input-group-btn">
                          <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                            <!-- /.search form -->
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered" id="examle1">
                        <thead>
                        <tr class="success">
                          <th style="width: 5rem" class="text-center">№</th>
                          <th style="width: 8rem">№ЗБ</th>
                          <th style="width: 120px"> Дата выхода на реализацию</th>
                          <th style="width: 80px"> Дата поступления</th>
                          <th class="text-center">Описание имущества</th>
                          <th style="width: 10rem">Сумма кредита</th>
                          <th style="width: 10rem">Сумма продажи</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                        <tbody>
                          <?
                          while ($data3 = mysqli_fetch_array($result3)) {
                          ?>
                          <tr>
                          <td class="text-center"> </td>
                          <td> <?=$data3['nomerzb'];?> </td>
                          <td><?= date("d.m.Y", strtotime($data3['dv'])); ?></td>
                          <td><?= date("d.m.Y", strtotime($data3['data_post'])); ?></td>
                          <td>    <?= $data3['category']; ?>, <?= $data3['tovarname']; ?> <?= $data3['hdd']; ?> <?= $data3['sostoyanie_bu']; ?>  <?= $data3['upakovka']; ?> <?= $data3['ekran']; ?> <?= $data3['korpus']; ?>
                           SN: <?= $data3['sn']; ?>, IMEI:<?= $data3['imei']; ?>, <?= $data3['complect']; ?> <?= $data3['opisanie']; ?>
                         </td>
                          <td> <?= number_format($data3['summa_vydachy'], 0, '.', ' ');?> тг. </td>
                          <td>
                             <?= number_format($data3['cena_pr'], 0, '.', ' ');?> тг.
                           </td>
                           <td>
                            <a href="#" class="btn btn-app">
                              <span class="badge bg-green">1</span>
                            <i class="fa fa-barcode"></i> <?= number_format($data3['cena_pr'], 0, '.', ' ');?>
                          </a>
                           </td>
                          <td>
                          <form action="sklad.php" method="POST">
                          <input name="adress" hidden value="<?=$adress;?>">
                          <input name="region" hidden value="<?=$region;?>">
                          <input name="idx" hidden value="<?=$data3['id'];?>">
                          <input name="status_sklad" hidden value="14">
                          <button type="submit" title="Выставить на витрину" class="btn btn-info fa fa-shopping-cart"></button>
                          </form>

                             <!-- <button class="btn btn-sm btn-success btn-flat pull-left glyphicon glyphicon-usd " data-toggle="modal" data-target="#modal-success" > Новая операция </button>-->
                             <button type="submit" title="Передать ремонтнику" class="btn btn-danger fa fa-wrench" data-toggle="modal" data-target="#modal-success"></button>

                          <!----------------------------------------->
                             <div class="modal modal fade" id="modal-success">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header bg-green ">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
 <!--                                    <h4 class="modal-title text-center "> <span class="fa fa-wrench"><b>&nbsp;</b></span></h4> -->

                                    <a class="btn btn-block btn-social bg-olive">
                                      <i class="glyphicon glyphicon-wrench"></i> Описание требуемого ремонта
                                    </a>
                                  </div>
                                  <div class="modal-body">
                                   <!-- Main content -->
                                    <form action="sklad.php" method="POST">
                                    <input name="adress" hidden value="<?=$adress;?>">
                                    <input name="region" hidden value="<?=$region;?>">
                                    <input name="idx" hidden value="<?=$data3['id'];?>">
                                    <input name="status_sklad" hidden value="15">
                                    <div class="input-group">
                                      <input class="form-control" type="text" name="remont_message" placeholder="Введите текст...">

                                      <div class="input-group-btn">
                                        <button type="submit" name="remont_submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                      </div>
                                    </div>
                                  </form>
                                  </div>
                                 <!--  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="glyphicon glyphicon-remove"></i>&nbsp;Закрыть</button>

                                    <button type="button" class="btn btn-info pull-left"> <i class="fa fa-save"></i>&nbsp;Подтвердить</button>

                                  </div> -->
                                </div>
                                <!-- /.modal-content -->

                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <!----------------------------------------->
                            <!-- /.modal -->
                          </td>

                          </tr>
                          <? } ?>
                        </tbody>
                        <tfoot>
                           <tr class="danger">
                                   <?php
                                      $data10 = mysqli_fetch_array($result10);?>
                                  <th colspan="5" class="text-center">Итого </th>


                                  <th><?=number_format($data10['SUM(summa_vydachy)'], 0, '.', ' ');?> тг.</th>
                                  <th><?=number_format($data10['SUM(cena_pr)'], 0, '.', ' ');?> тг.</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                        </tfoot>
                      </table>
                    </div><!-- /.table-responsive -->

                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!-- /.col-md-6 -->
<!--------------------------------------Товар на витрине------------------------------------->
                  <div class="col-md-12">
                    <div class="box box-warning">
                      <div class="box-header">
                        <h3 class="box-title pull-left">Товары филиала <?=$adress;?> на витрине г. <?= $region;?> &ensp;</h3>
                        <div class="input-group" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control input-sm pull-right" id="input" placeholder="Поиск" onkeyup="tableSearchzz()">
                          <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                        <div class="box-tools">

                        </div>
                        <div class="box-tools pull-right">
                          <button class = "btn btn-box-tool" data-widget = "collapse"> <i class = "fa fa-plus"> </i> </button>
                        </div>
                      </div><!-- /.box-header -->
                       <!-- search form -->
                       <div class="box-body no-padding">
                        <!-- search form -->


                        <script>
                          function tableSearchzz() {
                              var phrase = document.getElementById('input');
                              var table = document.getElementById('info-tablee');
                              var regPhrase = new RegExp(phrase.value, 'i');
                              var flag = false;
                              for (var i = 1; i < table.rows.length; i++) {
                                  flag = false;
                                  for (var j = table.rows[i].cells.length - 1; j >= 0; j--) {
                                      flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
                                      if (flag) break;
                                  }
                                  if (flag) {
                                      table.rows[i].style.display = "";
                                  } else {
                                      table.rows[i].style.display = "none";
                                  }

                              }
                          }
                          </script>
                        <!-- /.search form -->
                        <div class="table-responsive">
                            <table class="tableas1 table table-hover" id="info-tablee">
                              <thead>
                              <tr class="success">
                                <th style="width: 5rem" class="text-center">№</th>
                                <th style="width: 5rem">№ЗБ</th>
                                <th>Дата поступления на продажу</th>
                                <th>Дата выставления на витрину</th>
                                <th class="text-center">Описание имущества</th>
                                <th class="warning" style="width: 10rem">Сумма кредита</th>
                                <th class="danger" style="width: 10rem">Сумма продажи</th>
                                <th class="success"></th>
                              </tr>
                            </thead>
                              <tbody>
                                <?

                          while ($data3 = mysqli_fetch_array($result14)) {
                          ?>
                          <tr>
                          <td class="text-center"> </td>
                          <td> <?=$data3['nomerzb'];?> </td>
                          <td><?= date("d.m.Y", strtotime($data3['data_post'])); ?></td>
                          <td><?= date("d.m.Y", strtotime($data3['dateshop'])); ?></td>

                          <td>    <?= $data3['category']; ?>, <?= $data3['tovarname']; ?> <?= $data3['hdd']; ?> <?= $data3['sostoyanie_bu']; ?>  <?= $data3['upakovka']; ?> <?= $data3['ekran']; ?> <?= $data3['korpus']; ?>
                           SN: <?= $data3['sn']; ?>, IMEI:<?= $data3['imei']; ?>, <?= $data3['complect']; ?> <?= $data3['opisanie']; ?>
                         </td>
                          <td class="warning"><?= number_format($data3['summa_vydachy'], 0, '.', ' ');?> </td>
                          <td class="danger"><?= number_format($data3['cena_pr'], 0, '.', ' ');?> </td>
                          <td class="success">
                          <form action="sklad.php" method="POST">
                          <input name="adress" hidden value="<?=$adress;?>">
                          <input name="region" hidden value="<?=$region;?>">
                          <input name="idx" hidden value="<?=$data3['id'];?>">
                          <input name="status_sklad" hidden value="10">
                          <button type="submit"  class="btn btn-danger" title="Вернуть в склад"><i class="fa fa-university"></i></button>
                          </form>
                          </td>
                          </tr>
                          <? } ?>
                              </tbody>
<!--------------------------------------Товар на витрине------------------------------------->
                              <tfoot>
                                <tr >
                                   <?php
                                      $data14 = mysqli_fetch_array($result114);?>
                                  <th colspan="5" class=" danger text-center">Итого </th>


                                  <th class="warning"><?=number_format($data14['SUM(summa_vydachy)'], 0, '.', ' ');?> тг.</th>
                                  <th class="danger"><?=number_format($data14['SUM(cena_pr)'], 0, '.', ' ');?> тг.</th>
                                  <th class="success" ></th>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                            <script>
                          $('.tableas1 tbody tr').each(function(i) {
                          var number = i + 1;
                          $(this).find('td:first').text(number+".");
                          });
                          </script>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div><!-- /.col-md-12 -->
<!--------------------------------------------------------------------------->
                            <div class="col-md-12">
                              <div class = "box box-danger">
                                <div class="box-header with-border">
                                  <h3 class="box-title pull-left">Товары филиала <?=$adress;?> на ремонте г. <?= $region;?> &ensp;</h3>
                                  <div class="box-tools pull-right">
                                    <button class = "btn btn-box-tool" data-widget = "collapse"> <i class = "fa fa-plus"> </i> </button>
                                  </div>
                                  <div class="input-group pull-left" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control input-sm pull-right" id="search-text" placeholder="Поиск" onkeyup="tableSearch()">
                                    <div class="input-group-btn">
                                      <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                  </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                        <script>
                                          function tableSearch() {
                                              var phrase = document.getElementById('search-text');
                                              var table = document.getElementById('info-table');
                                              var regPhrase = new RegExp(phrase.value, 'i');
                                              var flag = false;
                                              for (var i = 1; i < table.rows.length; i++) {
                                                  flag = false;
                                                  for (var j = table.rows[i].cells.length - 1; j >= 0; j--) {
                                                      flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
                                                      if (flag) break;
                                                  }
                                                  if (flag) {
                                                      table.rows[i].style.display = "";
                                                  } else {
                                                      table.rows[i].style.display = "none";
                                                  }

                                              }
                                          }
                                          </script>
                                        <!-- /.search form -->
                                <div class="table-responsive">
                                  <table class="tableas2 table table-hover table-border" id="info-table">
                                    <thead>
                                    <tr class="success">
                                      <th style="width: 5rem" class="text-center">№</th>
                                      <th style="width: 5rem">№ЗБ</th>
                                      <th style="width: 5rem"> Дата поступления</th>
                                      <th style="width: 15rem"> Дата передачи на ремонт</th>
                                      <th class="text-center">Описание имущества</th>
                                      <th style="width: 10rem">Вид ремонта</th>
                                      <th class="warning"> Статус</th>
                                    </tr>
                                  </thead>
                                    <tbody>
                                      <?

                                        while ($data3 = mysqli_fetch_array($result15)) {

                                           $statusremont = $data3['statusremont'];
                                            // $result2 = $mysqli->query("SELECT *FROM status_remont WHERE id = '$stzb' ");
                                            // $data_st = mysqli_fetch_array($result2);
                                            // $statuszb = $data_st['name'];
                                           if($statusremont == 1){
                                            $status = '<span class="label label-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">В очереди</font></font></span>';}
                                            if($statusremont == 2){
                                            $status = '<span class="label label-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">В процессе</font></font></span>';}

                                           if($statusremont == 3){
                                            $status = '<span class="label label-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выполнено</font></font></span>';}

                                             if($statusremont == 4){
                                            $status = '<span class="label label-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Не пригоден для ремонта</font></font></span>';}
                                        ?>
                                        <tr>
                                        <td class="text-center"> </td>
                                        <td> <?=$data3['nomerzb'];?> </td>
                                        <td><?= date("d.m.Y", strtotime($data3['data_post'])); ?></td>
                                        <td><?= date("d.m.Y", strtotime($data3['dateremont'])); ?></td>
                                        <td>    <?= $data3['category']; ?>, <?= $data3['tovarname']; ?> <?= $data3['hdd']; ?> <?= $data3['sostoyanie_bu']; ?>  <?= $data3['upakovka']; ?> <?= $data3['ekran']; ?> <?= $data3['korpus']; ?>
                                         SN: <?= $data3['sn']; ?>, IMEI:<?= $data3['imei']; ?>, <?= $data3['complect']; ?> <?= $data3['opisanie']; ?>
                                       </td>
                                        <td><?=$data3['remontmessage'];?> </td>
                                        <td> <?=$status;?> </td>
                                        </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                      <tr class="danger">
                                        <?php

                                          $data15 = mysqli_fetch_array($result115);
                                          ?>
                                        <th colspan="6" class="text-center">Итого </th>
                                        <th><?=$data15['count'];?> шт.</th>

                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                                  <script>
                                  $('.tableas2 tbody tr').each(function(i) {
                                  var number = i + 1;
                                  $(this).find('td:first').text(number+".");
                                  });
                                  </script>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                            </div><!-- /.col-md-12 -->

<!--------------------------------------------------------------------------->


          </div><!-- /.content-wrapper -->
     </section>
</div>
