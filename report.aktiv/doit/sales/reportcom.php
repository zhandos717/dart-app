<? //проверка существовании сессии
include("../../bd.php");

  if ($_SESSION['logged_user']->status == 5) :
    $active = 'active';
    include "header.php"; 
    include "menu.php"; ?>
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
          </div><!-- /.box-header -->
          <div class="box-body">
            <form action="functions/report/report_sklad.php" method="POST" id='report'>
              <div class="col-lg-3">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </span>
                  <select class="form-control" id="List1" name="region">
                    <option value="<?= $region; ?>"><?= $region; ?></option>
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
                  <select class="form-control" id="List2" name="adress">
                  </select>
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-2">
                <div class="input-group">
                  <button type="submit" class="btn btn-block btn-primary btn-sm">
                    Подтвердить
                  </button>
                </div>
                <!-- /input-group -->
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

    </div>
  </section>
</div><!-- /.content-wrapper -->
<? include "footer.php";
else :
header('Location: index.php');
endif;
?>