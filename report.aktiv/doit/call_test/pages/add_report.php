<?
  $edit = R::load('callreports',$_POST['idx']);
?>
<?if($_SESSION['logged_user']->root == 1):?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Добавление отчета </h1>
    <!-- <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol> -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <form action="functions/add_report.php" method="post">
        <div class="col-md-12">
          <!-- Input addon -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Форма отчета по звонкам:</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon bg-red">Время суток</span>
                    <select class="form-control" name="days">
                      <?if($edit['days'] == '1'):?>
                      <option value="1">День</option>
                      <?elseif ($edit['days'] == '2'):?>
                      <option value="2">Ночь</option>
                      <?endif;?>
                      <option value="1">День</option>
                      <option value="2">Ночь</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon bg-orange">Дата</span>
                    <input type="date" class="form-control" value="<?= @$edit['datereport']; ?>" required name="datereport">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Рахат</span>
                    <input type="number" class="form-control" name="operator1" placeholder="Введите количество" value="<?= @$edit['operator1']; ?>">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Алемгуль</span>
                    <input type="number" class="form-control" name="operator2" placeholder="Введите количество" value="<?= @$edit['operator2']; ?>">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Ринат</span>
                    <input type="number" class="form-control" name="operator3" placeholder="Введите количество" value="<?= @$edit['operator3']; ?>">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Айсулу</span>
                    <input type="number" class="form-control" name="operator4" placeholder="Введите количество" value="<?= @$edit['operator4']; ?>">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Назар</span>
                    <input type="number" class="form-control" name="operator5" placeholder="Введите количество" value="<?= @$edit['operator5']; ?>">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Назира</span>
                    <input type="number" class="form-control" name="operator6" placeholder="Введите количество" value="<?= @$edit['operator6']; ?>">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Санжар</span>
                    <input type="number" class="form-control" name="operator7" placeholder="Введите количество" value="<?= @$edit['operator7']; ?>">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon ">Алина</span>
                    <input type="number" class="form-control" name="operator8" placeholder="Введите количество" value="<?= @$edit['operator8']; ?>">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon bg-blue">Филиалы</span>
                    <input type="number" class="form-control" name="filial" placeholder="Введите количество" value="<?= @$edit['filial']; ?>">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12  col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon bg-olive">Магазин</span>
                    <input type="number" class="form-control" name="shop" placeholder="Введите количество" value="<?= @$edit['shop']; ?>">
                  </div>
                </div>
              </div>
            </div><!-- /.col-md-6 -->
            <div class="box-footer">
              <input type="number" value="<?= $edit['id']; ?>" name="idx" hidden>
              <button type="submit" name="go_update" class="btn bg-olive btn-block">Сохранить</button>
            </div>
          </div><!-- /.row -->
          <!-- /.col -->
        </div>
      </form>
  </section>
</div><!-- /.content-wrapper -->
<?endif;?>