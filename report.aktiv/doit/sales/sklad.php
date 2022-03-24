<? //проверка существовании сессии
include("../../bd.php");
  if ($_SESSION['logged_user']->status == 5) :
  $active = 'active';
  include "header.php";
  include "menu.php";
  include_once 'functions/notification.php';
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
      <? if (!empty($res)) { ?>
        <!-- если товары есть показываем их  -->
        <div class="row">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h4>У вас
                  <?= $res['count']; ?> ед. товара находятся более 10 дней на реализации
                </h4>
                <h3>На общую сумму <?= number_format($res['SUM(cena_pr)'], 0, '.', ' '); ?> тг</h3>
              </div>
              <div class="icon">
                <i class="fa fa-warning"></i>
              </div>
              <a href="a_report.php?id=7" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      <? } ?>
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
                    <? $reg = R::getCol('SELECT region FROM kassa WHERE status = 1 GROUP BY region');
                    ?>
                    <select class="form-control" id="get_region" name="region">
                    <? foreach($reg as $r){?>
                      <option <?= $r==$region ? 'selected' : ''; ?> ><?= $r?></option>
                    <?}?>
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
                    <select class="form-control" id="adress" name="adress">
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
  <script>
    $(function() {
      $('#get_region').change(function() {
        var region = $(this).val();
        console.log(region);
        $('#adress').load('../function/get_adress.php', {
          region: region
        });
      });
    });
  </script>
<? include "footer.php";
else :
  header('Location: index.php');
endif;
?>