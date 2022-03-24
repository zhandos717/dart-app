<?
$region = $_SESSION['logged_user']->region;
$shop = $_SESSION['logged_user']->adress;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <b><?= $_SESSION['logged_user']->fio; ?></b> | <em>Куратор по региону - <?= $region; ?></em>

    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная1</a></li>
      <li><a href="index.php">Регион - <?= $region; ?></a></li>
      <li class="active"><?= $_SESSION['logged_user']->adress; ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Ежедневная Форма отчета по сводке за сутки</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" action="xqrtgmjskdgftrhs.php" method="POST" enctype="multipart/form-data">

            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Регионы:</label>
                <div class="col-sm-10">
                  <?if($_SESSION['logged_user']->root == '3'):?>

                  <select class="form-control"  id="List1" name="region">

                   <option value="<?=$region;?>"><?=$region;?></option>
                   <option value="Кокшетау">Кокшетау</option>
                   <option value="Костанай">Костанай</option>
                   <option value="Павлодар">Павлодар</option>
                  </select>
                  <?else:?>
                  <select class="form-control"  id="List1" name="region">
                   <option value="<?=$region;?>"><?=$region;?></option>
                  </select>
                  <?endif;?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Филиалы:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="List2" name="adress">
                  </select>
                </div>
              </div>






              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ДАТА ОТЧЕТА:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="inputEmail3" type="date" name="data" required="" >
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Код товара:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="inputPassword3" type="text" name="codetovar" required="">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Сумма переоценки:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="inputPassword3" type="number" name="pereoceka">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Коментарии по дефектам:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="inputPassword3" type="text" name="comment">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Сличительная ведомость:</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" name="picture">
                </div>
              </div>





            </div><!-- /.box-body -->
            <div class="box-footer">

              <button name="do_signup" type="submit" class="btn btn-info pull-right">Отправить отчет</button>
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->


      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->




</div><!-- /.content-wrapper -->
