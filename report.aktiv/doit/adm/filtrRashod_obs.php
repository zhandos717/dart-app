<?php
include("../../bd.php");
if ($status != 3) header('Location: /');

  include "header.php";
  include "menu.php";
  $dataf = $_POST;
  if (isset($dataf['filtr'])) {

    $den1 = $dataf['den1'];
    $den2 = $dataf['den2'];
    $region1 = $dataf['region1'];
    $adress1 = $dataf['adress1'];


    if (!empty($den1) and !empty($den2)) {
      $resultq = mysqli_query($connect, "SELECT * FROM rashodfillialobs
            WHERE
            -- region = '$region1' AND
            -- adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'
             ");
    }
    if (!empty($den1) and !empty($den2) and !empty($region1)) {
      $resultq = mysqli_query($connect, "SELECT * FROM rashodfillialobs
            WHERE region = '$region1' AND
            -- adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'");
    }

    if (!empty($den1) and !empty($den2) and !empty($region1) and !empty($adress1)) {
      $resultq = mysqli_query($connect, "SELECT * FROM rashodfillialobs
            WHERE region = '$region1' AND
            adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2' ");
    }
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Расходы ОБС
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
            <li class="pull-left header"><i class="fa fa-th"></i> Фильтрация по расходам </li>
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
                  <select class="form-control" id="get_region" name="region1" style="width: 100%;">
                    <!-- <option value="">Выберите регион(город)</option> -->
                    <option value="">ПО ВСЕМУ КЗ</option>
                    <?
                    $result2 = mysqli_query($connect, "SELECT region FROM rashodfillialobs GROUP BY region");
                    while ($data2 = mysqli_fetch_array($result2)) { ?>
                      <option value="<?= $data2['region'] ?>"><?= $data2['region'] ?></option>
                    <? } ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" id="adress" name="adress1" style="width: 100%;">
                  </select>
                </div>
                <!-- <button class="btn btn-warning btn-block">Подтверить расход</button> -->
                <input class="btn btn-warning btn-block" type="submit" name="filtr" value="Искать...">
              </form>
            </div>
          </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
      </div><!-- /.col -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Расходы филиалов</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="datatable-tabletools" class="table table-bordered table-striped">
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
                  while ($dataq = mysqli_fetch_array($resultq)) { ?>
                    <tr>
                      <td><?= $dataq['region']; ?></td>
                      <td><?= $dataq['adress']; ?></td>
                      <td><?= number_format(round($dataq['summarf'], 2), 0, '.', ' '); ?>
                      </td>
                      <td><?= date("d.m.Y", strtotime($dataq['datarashoda'])); ?></td>
                      <td><?= $dataq['comments']; ?></td>
                      <td>
                        <form class="" action="reRashod2_obs.php" method="post">
                          <input type="text" hidden="hidden" name="id" value="<?= $dataq['id']; ?>">
                          <input type="submit" class="btn btn-block btn-primary btn-sm" name="rerashod" value="Изменить">
                        </form>
                      </td>
                    </tr>
                  <? } ?>
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

<?php include "footer.php"; ?>
