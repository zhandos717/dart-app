<?php
include("../../bd.php");
if ($status == 3) :
  include "header.php";
  include "menu.php";
  $s = $_GET["s"];
  $month = $_GET["month"];

  if($month =='1'){
    $data_begin = '2022-01-01'; //Дата начало
    $data_end   = '2022-01-31'; //Дата конец
    $namemonth = 'ЯНВАРЬ';
  }

  if($month =='2'){
    $data_begin = '2022-02-01'; //Дата начало
    $data_end   = '2022-02-28'; //Дата конец
    $namemonth = 'ФЕВРАЛЬ';
  }
/*
  $data_begin = '2022-02-01'; //Дата начало
  $data_end   = '2022-02-28'; //Дата конец
  */
?>
  <script type="text/javascript" src="linkedselect.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Расходы за <?=$namemonth;?> 2022 год
      </h1>
    </section>
    <!-- Main content -->
    <section class="content" id="app">
      <!-- v-cloak -->
      <!-- <a href="filtrRashod.php" class="btn btn-block btn-primary">Фильтр по расходам</a> -->


      <div class="col-md-6">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li><a href="#branches" data-toggle="tab">Расходы по филиально</a></li>
            <li><a href="#regions" data-toggle="tab">Расходы по городам</a></li>
            <li class="active"><a href="#country" data-toggle="tab">За Казахстан</a></li>
            <li class="pull-left header"><i class="fa fa-th"></i> Расходы </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="country">
              <form action="rashody/rashodpokz.php" method="post">
                <div class="form-group">
                  <input class="form-control" type="date" name="datarashoda" required="required">
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" name="summarpokz" required="required">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Укажите примечение..." name="comments" required="required">
                </div>
                <input class="btn btn-danger btn-block" type="submit" name="rashodkz" value="Подтверить расход на весь КЗ">
              </form>
            </div>
            <div class="tab-pane" id="regions">
              <form action="rashody/rashodpogorodu.php" method="post">
                <div class="form-group">
                  <input class="form-control" type="date" name="datarashoda" required="required">
                </div>
                <div class="form-group">
                  <select class="form-control" data-placeholder="Регион" name="region" style="width: 100%;">
                    <option>Выберите регион(город)</option>
                    <?
                    $result = mysqli_query($connect, "SELECT region FROM diruser GROUP BY region");
                    while ($data = mysqli_fetch_array($result)) { ?>
                      <option value="<?= $data['region'] ?>"><?= $data['region'] ?></option>
                    <? } ?>
                  </select>
                </div><!-- /.form group -->
                <div class="form-group">
                  <input class="form-control" placeholder="Расход на весь город" type="number" name="summag" required="required">
                </div><!-- /.tab-pane -->
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Укажите примечение..." name="comments" required="required">
                </div>
                <input class="btn btn-warning btn-block" type="submit" name="rashodreg" value="Подтверить расход за город">
              </form>
            </div>

            <div class="tab-pane" id="branches">
              <form action="rashody/rashodpofill.php" method="post">
                <div class="form-group">
                  <input class="form-control" type="date" name="datarashoda" required="required">
                </div>
                <div class="form-group">
                  <select class="form-control" id="List1" name="region" style="width: 100%;">
                    <option>Выберите регион(город)</option>
                    <?
                    $result2 = mysqli_query($connect, "SELECT region FROM diruser GROUP BY region");
                    while ($data2 = mysqli_fetch_array($result2)) { ?>
                      <option value="<?= $data2['region'] ?>"><?= $data2['region'] ?></option>
                    <? } ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" id="List2" name="adress" style="width: 100%;">
                  </select>
                </div>

                <script type="text/javascript">
                  var syncList1 = new syncList;

                  syncList1.dataList = {


                    'Актау': {

                      <?
                      $result11 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Актау' AND status='1'");
                      while ($data11 = mysqli_fetch_array($result11)) { ?> '<?= $data11['adress']; ?>': '<?= $data11['adress']; ?>',
                      <? } ?>
                    },

                    'Актобе': {

                      <?
                      $result12 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Актобе' AND status='1'");
                      while ($data12 = mysqli_fetch_array($result12)) { ?> '<?= $data12['adress']; ?>': '<?= $data12['adress']; ?>',
                      <? } ?>
                    },

                    'Алматы': {

                      <?
                      $result13 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Алматы' AND status='1'");
                      while ($data13 = mysqli_fetch_array($result13)) { ?> '<?= $data13['adress']; ?>': '<?= $data13['adress']; ?>',
                      <? } ?>
                    },

                    'Атырау': {

                      <?
                      $result14 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Атырау' AND status='1'");
                      while ($data14 = mysqli_fetch_array($result14)) { ?> '<?= $data14['adress']; ?>': '<?= $data14['adress']; ?>',
                      <? } ?>
                    },

                    'Караганда': {

                      <?
                      $result15 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Караганда' AND status='1'");
                      while ($data15 = mysqli_fetch_array($result15)) { ?> '<?= $data15['adress']; ?>': '<?= $data15['adress']; ?>',
                      <? } ?>
                    },

                    'Кокшетау': {

                      <?
                      $result16 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Кокшетау' AND status='1'");
                      while ($data16 = mysqli_fetch_array($result16)) { ?> '<?= $data16['adress']; ?>': '<?= $data16['adress']; ?>',
                      <? } ?>
                    },


                    'Костанай': {

                      <?
                      $result17 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Костанай' AND status='1'");
                      while ($data17 = mysqli_fetch_array($result17)) { ?> '<?= $data17['adress']; ?>': '<?= $data17['adress']; ?>',
                      <? } ?>
                    },

                    'Кызылорда': {

                      <?
                      $result18 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Кызылорда' AND status='1'");
                      while ($data18 = mysqli_fetch_array($result18)) { ?> '<?= $data18['adress']; ?>': '<?= $data18['adress']; ?>',
                      <? } ?>
                    },


                    'Нур-Султан': {

                      <?
                      $result19 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Нур-Султан' AND status='1'");
                      while ($data19 = mysqli_fetch_array($result19)) { ?> '<?= $data19['adress']; ?>': '<?= $data19['adress']; ?>',
                      <? } ?>
                    },

                    'Павлодар': {

                      <?
                      $result20 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Павлодар' AND status='1'");
                      while ($data20 = mysqli_fetch_array($result20)) { ?> '<?= $data20['adress']; ?>': '<?= $data20['adress']; ?>',
                      <? } ?>
                    },

                    'Петропавловск': {

                      <?
                      $result21 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Петропавловск' AND status='1'");
                      while ($data21 = mysqli_fetch_array($result21)) { ?> '<?= $data21['adress']; ?>': '<?= $data21['adress']; ?>',
                      <? } ?>
                    },


                    'Семей': {

                      <?
                      $result22 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Семей' AND status='1'");
                      while ($data22 = mysqli_fetch_array($result22)) { ?> '<?= $data22['adress']; ?>': '<?= $data22['adress']; ?>',
                      <? } ?>
                    },

                    'Талдыкорган': {

                      <?
                      $result23 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Талдыкорган' AND status='1'");
                      while ($data23 = mysqli_fetch_array($result23)) { ?> '<?= $data23['adress']; ?>': '<?= $data23['adress']; ?>',
                      <? } ?>
                    },

                    'Тараз': {

                      <?
                      $result24 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Тараз' AND status='1'");
                      while ($data24 = mysqli_fetch_array($result24)) { ?> '<?= $data24['adress']; ?>': '<?= $data24['adress']; ?>',
                      <? } ?>
                    },


                    'Темиртау': {

                      <?
                      $result25 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Темиртау' AND status='1'");
                      while ($data25 = mysqli_fetch_array($result25)) { ?> '<?= $data25['adress']; ?>': '<?= $data25['adress']; ?>',
                      <? } ?>
                    },


                    'Туркестан': {

                      <?
                      $result26 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Туркестан' AND status='1'");
                      while ($data26 = mysqli_fetch_array($result26)) { ?> '<?= $data26['adress']; ?>': '<?= $data26['adress']; ?>',
                      <? } ?>
                    },

                    'Уральск': {

                      <?
                      $result27 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Уральск' AND status='1'");
                      while ($data27 = mysqli_fetch_array($result27)) { ?> '<?= $data27['adress']; ?>': '<?= $data27['adress']; ?>',
                      <? } ?>
                    },


                    'Шымкент': {

                      <?
                      $result28 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Шымкент' AND status='1'");
                      while ($data28 = mysqli_fetch_array($result28)) { ?> '<?= $data28['adress']; ?>': '<?= $data28['adress']; ?>',
                      <? } ?>
                    },

                  };

                  // Включаем синхронизацию связанных списков
                  syncList1.sync("List1", "List2", "List3");
                </script>

                <div class="form-group">
                  <input class="form-control" placeholder="Расход на выбранный филиал" type="number" name="summaf" required="required">
                </div><!-- /.tab-pane -->
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Укажите примечение..." name="comments" required="required">
                </div>
                <!-- <button class="btn btn-warning btn-block">Подтверить расход</button> -->
                <input class="btn btn-warning btn-block" type="submit" name="rashodfill" value="Подтверить расход для филиала">
              </form>
            </div>

          </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
      </div><!-- /.col -->

      <div class="col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Фильтрация по расходам</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">

            </div><!-- /.box-body -->
            <div class="box-footer">
              <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
              <a href="filtrRashod.php" class="btn btn-info pull-right">Фильтр по расходам</a>
              <a href="fordelRashod.php?month=<?=$month;?>" class="btn btn-danger">Для удаление</a>
              <!-- <button type="submit" class="btn btn-info pull-right">Sign in</button> -->
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->
      </div>


      <!-- /.row -->
      <!-- END CUSTOM TABS -->
      <? if ($s == 'succes') { ?>
        <div class="row">
          <div class="col-md-6">
            <div class="box-body">
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4> <i class="icon fa fa-check"></i> Внимание!</h4>
                Расход успешно добавлен в базу данных. НЕ ЗАБУДЬТЕ НАЖАТЬ НА КРЕСТИК СЛЕВА СВЕРХУ
              </div>
            </div>
          </div>
        </div>
      <? } ?>

      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Расходы филиалов</h3>
            </div>
            <div class="box-body">
              <table id="datatable-tabletools" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Регион</th>
                    <!-- <th>Филиал</th> -->
                    <th>Расход Филиала</th>
                    <th>Дата расхода</th>
                    <th>Примечение</th>
                  </tr>
                </thead>
                <tbody>
                  <? $result = mysqli_query($connect, "SELECT region, comments, datarashoda, SUM(summarf)  AS summarf FROM rashodfillial WHERE datarashoda BETWEEN '$data_begin' AND '$data_end'  GROUP BY comments ");
                  while ($data = mysqli_fetch_array($result)) { ?>
                    <tr>
                      <td><?= $data['region']; ?></td>
                      <!-- <td><?= $data['adress']; ?></td> -->
                      <td><?= number_format(round($data['summarf'], 2), 0, '.', ' '); ?>
                      </td>
                      <td><?= date("d.m.Y", strtotime($data['datarashoda'])); ?></td>
                      <td><?= $data['comments']; ?></td>
                    </tr>
                  <? } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>

<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>
