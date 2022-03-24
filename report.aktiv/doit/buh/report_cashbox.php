<? include("../../bd.php");
if ($_SESSION['logged_user']->status == 10) :
  $active_report_com = 'active';
  include "header.php";
  include "menu.php";
  $region = R::findAll('kassa', 'region <> "Тест" GROUP BY region');

?>
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
              <form action="functions/report_kassa.php" id="kassa" method="POST">
                <div class="col-lg-2 col-md-2">
                  <div class="input-group">
                    <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" value="<?= date('Y-m-d'); ?>" name="date1">
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
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control" id="adress" name="adress">
                      <option value="">Выберите город</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-fax"></i>
                    </span>
                    <select class="form-control" id="List5" name="kassa">
                      <option value="Касса 1">Касса 1</option>
                      <option value="Касса 2">Касса 2</option>
                      <option value="Касса 4">Касса 4</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-flat btn-info">Подтвердить!</button>
                  </span>
                </div>
              </form>
            </div>
            <!--.box-body -->
          </div>
          <!--.box -->
        </div>
        <!--.col-md-12 -->
        <div class="answer">


        </div>
      </div> <!-- /.row -->
    </section>
  </div><!-- /.content-wrapper -->

<?
  include "footer.php";
else :
  header('Location: index.php');
endif; ?>