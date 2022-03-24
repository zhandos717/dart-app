<?
include("../../bd.php");

if ($_SESSION['logged_user']->status == 10) :
  $active = 'active';
  include "header.php";
  include "menu.php";
  $region = R::findAll('kassa', 'region <> "Тест" GROUP BY region');

?>
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
              <form action="./functions/report/all_product.php" id="kassa" method="POST">
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group">
                    <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" name="date1">
                  </div>
                  <!-- /input-group -->
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group">
                    <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" name="date2">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-bank"></i>
                    </span>
                    <select class="form-control" id="get_region" name="region">
                      <option value="">Выберите город</option>
                      <? foreach ($region as $reg) { ?>
                        <option><?= $reg['region'] ?></option>
                      <? } ?>
                      <option value="Все">Все</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control" id="adress" name="adress">
                      <option value="<?= $adress; ?>"><?= $adress; ?></option>
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
                      <? $result2 = mysqli_query($connect, "SELECT *FROM status_zb ");
                      while ($data_zb = mysqli_fetch_array($result2)) { ?>
                        <option value="<?= $data_zb['id']; ?>"><?= $data_zb['name']; ?></option>
                      <? } ?>
                    </select>
                  </div>
                </div>
                <div class="input-group input-group-sm">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-sm">Подтвердить!</button>
                  </span>
                </div>
              </form>
            </div>
            <!--.box-body -->
          </div>
          <!--.box -->
        </div>
        <!--.col-md-12 -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="answer"></div>
            </div><!-- /.table-responsive -->
          </div><!-- /.box-body -->
        </div><!-- /.box box-primary -->
      </div><!-- /.col-md-6 -->
      <!--------------------------------------------------------------------------->
    </section>

  </div>


<? include "footer.php";
else :
  header('Location: /');
endif; ?>