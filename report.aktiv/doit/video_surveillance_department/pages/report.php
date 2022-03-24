<?
include __DIR__. '/../../layouts/header.php';
include __DIR__ . '/../../layouts/menu/video_surveillance.php';

$data1 = date('Y-m-d');
$regions = R::getCol('SELECT region FROM kassa WHERE status = 1 GROUP BY region');
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
          <div class="box-header with-border">
            <h3 class="box-title">Выберите период</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
            </div>
          </div>
          <div class="box-body">
            <form action="./functions/report/all_product.php" id="report" method="POST">
              <div class="row">
                <div class="col-md-12">
                  <div class="input-group input-group-sm">
                    <input type="text" required name="search" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-success btn-flat" type="submit">Поиск!</button>
                    </span>
                  </div><!-- /input-group -->
                </div>
              </div>
            </form>
          </div>
          <!--.box-body -->
        </div>
        <!--.box -->
      </div>
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
            <form action="./functions/report/all_product.php" id="report" method="POST">
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" required max="<?= $today; ?>" value="<?= $data1; ?>" name="date1">
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" required max="<?= $today; ?>" value="<?= $data1; ?>" name="date2">
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </span>
                  <select class="form-control" id="region" name="region">
                    <option value="Все">Все</option>
                    <? foreach ($regions as $reg) { ?>
                      <option><?= $reg ?></option>
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
                    <option value="">Выберите данные</option>
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
                    <? $result2 = R::findAll('status_zb');
                    foreach ($result2 as $data_zb) { ?>
                      <option value="<?= $data_zb['id']; ?>"><?= $data_zb['name']; ?></option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <div class="input-group input-group-sm">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info">Подтвердить!</button>
                </span>
              </div>
            </form>
          </div>
          <!--.box-body -->
        </div>
        <!--.box -->
      </div>
      <!--.col-md-12 -->
      <!--------------------------------------------------------------------------->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"> </h3>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Данные клиента</h4>
      </div>
      <div class="modal-body">
        <p>Подождите идет загрузка&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script>
  $(function() {
    $('#region').change(function() {
      var region = $(this).val();
      console.log(region);
      $('#adress').load('functions/get_adress.php', {
        region_com: region
      });
    });
    $('form').submit(function(e) {
      var $form = $(this);
      $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize()
      }).done(function(data) {
        $('.answer').html(data);
      }).fail(function() {
        alert('Ошибка');
      });
      //отмена действия по умолчанию для кнопки submit
      e.preventDefault();
    });
  });
</script>
<? include __DIR__. '/../../layouts/footer.php'; ?>