<?php
include("../../bd.php");
if ($status == 3) :
  include "header.php";
  include "menu.php";
  $dataf = $_POST;
      if (isset($dataf['filtr'])) {

        $den1 = $dataf['den1'];
        $den2 = $dataf['den2'];
        $region1 = $dataf['region1'];
        $adress1 = $dataf['adress1'];



        if (!empty($den1) AND !empty($den2) ){

          $resultq = mysqli_query($connect, "SELECT * FROM rashodfillial
            WHERE
            -- region = '$region1' AND
            -- adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'
             ");
        }


        if (!empty($den1) AND !empty($den2) AND !empty($region1) ){

          $resultq = mysqli_query($connect, "SELECT * FROM rashodfillial
            WHERE region = '$region1' AND
            -- adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'
             ");
        }

        if (!empty($den1) AND !empty($den2) AND !empty($region1) AND !empty($adress1)){

          $resultq = mysqli_query($connect, "SELECT * FROM rashodfillial
            WHERE region = '$region1' AND
            adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'
             ");
        }


  }
  ?>
<script type="text/javascript" src="linkedselect.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Расходы
      </h1>
    </section>
    <!-- Main content -->
    <section class="content" id="app">
      <!-- v-cloak -->
<!-- <a href="filtrRashod.php" class="btn btn-block btn-primary">Фильтр по расходам</a> -->


      <div class="col-md-6">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <!-- <li  class="active"><a href="#branches" data-toggle="tab">Расходы по филиально</a></li> -->
            <!-- <li><a href="#regions" data-toggle="tab">Расходы по городам</a></li>
            <li><a href="#country" data-toggle="tab">За Казахстан</a></li> -->
            <li class="pull-left header"><i class="fa fa-th"></i> Фильтрация по расходам  </li>
          </ul>
          <div class="tab-content">

            <div class="tab-pane active" id="branches">
              <form action="" method="post">
                <div class="form-group">
                  <div class="row">
                    <!-- <div class="col-xs-3">
                      <input type="date" class="form-control" placeholder=".col-xs-3">
                    </div> -->
                    <div class="col-xs-6">
                      <input type="date" class="form-control" name="den1" placeholder=".col-xs-6" required="required">
                    </div>
                    <div class="col-xs-6">
                      <input type="date" class="form-control" name="den2" placeholder=".col-xs-6" required="required">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <select class="form-control"  id="List1" name="region1" style="width: 100%;">
                    <!-- <option value="">Выберите регион(город)</option> -->
                    <option value="">ПО ВСЕМУ КЗ</option>
                    <?
                    $result2 = mysqli_query($connect, "SELECT region FROM rashodfillial GROUP BY region");
                          while ( $data2 = mysqli_fetch_array($result2))
                              {?>
                                <option value="<?=$data2['region']?>"><?=$data2['region']?></option>
                            <?}?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control"   id="List2" name="adress1" style="width: 100%;">
                  </select>
                </div>

                <script type="text/javascript">
                 var syncList1 = new syncList;

                 syncList1.dataList = {


                  'Актау':{

                    <?
                    $result11 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Актау'  ");
                    while($data11 = mysqli_fetch_array($result11))
                         {?>
                             '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data11['adress'];?>':'<?=$data11['adress'];?>',
                       <?}?>
                  },

                  'Актобе':{

                    <?
                    $result12 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Актобе'  ");
                    while($data12 = mysqli_fetch_array($result12))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data12['adress'];?>':'<?=$data12['adress'];?>',
                       <?}?>
                  },

                  'Алматы':{

                    <?
                    $result13 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Алматы'  ");
                    while($data13 = mysqli_fetch_array($result13))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data13['adress'];?>':'<?=$data13['adress'];?>',
                       <?}?>
                  },

                  'Атырау':{

                    <?
                    $result14 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Атырау'  ");
                    while($data14 = mysqli_fetch_array($result14))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data14['adress'];?>':'<?=$data14['adress'];?>',
                       <?}?>
                  },

                  'Караганда':{

                    <?
                    $result15 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Караганда'  ");
                    while($data15 = mysqli_fetch_array($result15))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data15['adress'];?>':'<?=$data15['adress'];?>',
                       <?}?>
                  },

                  'Кокшетау':{

                    <?
                    $result16 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Кокшетау'  ");
                    while($data16 = mysqli_fetch_array($result16))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data16['adress'];?>':'<?=$data16['adress'];?>',
                       <?}?>
                  },


                  'Костанай':{

                    <?
                    $result17 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Костанай'  ");
                    while($data17 = mysqli_fetch_array($result17))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data17['adress'];?>':'<?=$data17['adress'];?>',
                       <?}?>
                  },

                  'Кызылорда':{

                    <?
                    $result18 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Кызылорда'  ");
                    while($data18 = mysqli_fetch_array($result18))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data18['adress'];?>':'<?=$data18['adress'];?>',
                       <?}?>
                  },


                  'Нур-Султан':{

                    <?
                    $result19 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Нур-Султан'  ");
                    while($data19 = mysqli_fetch_array($result19))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data19['adress'];?>':'<?=$data19['adress'];?>',
                       <?}?>
                  },

                  'Павлодар':{

                    <?
                    $result20 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Павлодар'  ");
                    while($data20 = mysqli_fetch_array($result20))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data20['adress'];?>':'<?=$data20['adress'];?>',
                       <?}?>
                  },

                  'Петропавловск':{

                    <?
                    $result21 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Петропавловск'  ");
                    while($data21 = mysqli_fetch_array($result21))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data21['adress'];?>':'<?=$data21['adress'];?>',
                       <?}?>
                  },


                  'Семей':{

                    <?
                    $result22 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Семей'  ");
                    while($data22 = mysqli_fetch_array($result22))
                         {?>

                             '<?=$data22['adress'];?>':'<?=$data22['adress'];?>',
                       <?}?>
                  },

                  'Талдыкорган':{

                    <?
                    $result23 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Талдыкорган'  ");
                    while($data23 = mysqli_fetch_array($result23))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data23['adress'];?>':'<?=$data23['adress'];?>',
                       <?}?>
                  },

                  'Тараз':{

                    <?
                    $result24 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Тараз'  ");
                    while($data24 = mysqli_fetch_array($result24))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data24['adress'];?>':'<?=$data24['adress'];?>',
                       <?}?>
                  },


                  'Темиртау':{

                    <?
                    $result25 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Темиртау'  ");
                    while($data25 = mysqli_fetch_array($result25))
                         {?>
                             '<?=$data25['adress'];?>':'<?=$data25['adress'];?>',
                       <?}?>
                  },


                  'Туркестан':{

                    <?
                    $result26 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Туркестан'  ");
                    while($data26 = mysqli_fetch_array($result26))
                         {?>
                             '<?=$data26['adress'];?>':'<?=$data26['adress'];?>',
                       <?}?>
                  },

                  'Уральск':{

                    <?
                    $result27 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Уральск'  ");
                    while($data27 = mysqli_fetch_array($result27))
                         {?>
                             '<?=$data27['adress'];?>':'<?=$data27['adress'];?>',
                       <?}?>
                  },


                  'Шымкент':{

                    <?
                    $result28 = mysqli_query($connect, "SELECT adress FROM rashodfillial WHERE region = 'Шымкент'  ");
                    while($data28 = mysqli_fetch_array($result28))
                         {?>
                           '':'ВСЕ ФИЛИАЛЫ',
                             '<?=$data28['adress'];?>':'<?=$data28['adress'];?>',
                       <?}?>
                  },

                };

                  // Включаем синхронизацию связанных списков
                  syncList1.sync("List1","List2","List3");
                </script>


                <!-- <button class="btn btn-warning btn-block">Подтверить расход</button> -->
                <input class="btn btn-warning btn-block" type="submit" name="filtr" value="Искать...">
              </form>
            </div>

          </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
      </div><!-- /.col -->





    </section>

<!-- filtrRashod.php -->

    <!-- Main content -->
            <section class="content">
              <div class="row">
                <div class="col-xs-12">

                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Расходы филиалов</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Регион</th>
                            <th>Филиал</th>
                            <th>Расход Филиала</th>
                            <th>Дата расхода</th>
                            <th>Примечение</th>
                            <th>Действия</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?
                                while ( $dataq = mysqli_fetch_array($resultq)) {?>
                          <tr>
                            <td><?=$dataq['region'];?></td>
                            <td><?=$dataq['adress'];?></td>
                            <td><?= number_format(round($dataq['summarf'], 2), 0, '.', ' '); ?>
                            </td>
                            <td><?=date("d.m.Y", strtotime($dataq['datarashoda']));?></td>
                            <td><?=$dataq['comments'];?></td>
                            <td>
                              <form class="" action="reRashod2.php" method="post">
                                <input type="text" hidden="hidden" name="id" value="<?=$dataq['id'];?>">
                                <input type="submit" class="btn btn-block btn-primary btn-sm" name="rerashod" value="Изменить">
                              </form>
                            </td>
                          </tr>
                          <?}?>
                        </tbody>
                        <!-- <tfoot>
                          <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Platform(s)</th>
                          </tr>
                        </tfoot> -->
                      </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </section><!-- /.content -->

  </div>

<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>
