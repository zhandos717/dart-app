<?php
require '../../bd.php';
if ($_SESSION['logged_user']->status != 1) header('Location: ../../index.php');
$active = 'active';
require "header.php";
require "menu.php";
?>
<!-- Content Wrapper. Contains page content -->
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
          <div class="box-header">
            <h3 class="box-title">Выберите период</h3>
            <br>
            <button class="btn btn-primary get_product" value='2'>Товары на складе</button>
            <button class="btn btn-warning get_product" value='14'>Товары в магазине</button>
          </div>
          <div class="box-body">
            <div class="row">
              <form action="./functions/report/all_product.php" id="report" method="POST">
                <div class="col-lg-2 col-sm-4">
                  <div class="form-group">
                    <input type="date" class="form-control" required max="<?= $today; ?>" value="<?= $data1; ?>" name="date1">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2 col-sm-4">
                  <div class="form-group">
                    <input type="date" class="form-control" required max="<?= $today; ?>" value="<?= $data2; ?>" name="date2">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="form-group">
                    <select class="form-control" id="region" name="region">
                      <option><?= $region ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="form-group">
                    <select class="form-control" id="adress" name="adress">
                      <option><?= $adress ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="form-group">
                    <select class="form-control" name="status">
                      <option value="Все">Все</option>
                      <? $result2 = R::findAll('status_zb');
                      foreach ($result2 as $data_zb) { ?>
                        <option value="<?= $data_zb['id']; ?>"><?= $data_zb['name']; ?></option>
                      <? } ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="form-group">
                    <button type="submit" class="btn btn-info">Подтвердить!</button>
                  </div>
                </div>
              </form>
            </div>
            <!--.box-body -->
          </div>
        </div>
        <!--.box -->
      </div>
      <!--.col-md-12 -->
      <!--------------------------------------------------------------------------->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">

            </h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="answer">

            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box box-primary -->
      </div><!-- /.col-md-6 -->
      <!--------------------------------------------------------------------------->
    </div><!-- /.content-wrapper -->
  </section>
</div>
<script src="js/report.js?v=1.1"></script>
<script>
  $('.get_product').click(function() {
    let product = $(this).val();
    $.post('./functions/report/all_product.php', {
      product: product
    }).done(function(data) {
      $('.answer').html(data)
    });
  });
</script>
<?php include "footer.php"; ?>