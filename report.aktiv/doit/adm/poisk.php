<?
include("../../bd.php");
$region = $_GET['region'];
$shop = $_GET['shop'];
$codetovar = $_GET['codetovar'];
$active_mag = 'active';
if ($_SESSION['logged_user']->status == 3) :
?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Поиск товаров</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
                  <div class="box-body">
                    <br />
                    <form method="post" action="result.php">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="введите Код товара" name="codetovar" />
                        <span class="input-group-btn">
                          <input type="submit" class="btn btn-info btn-flat" value="Поиск по коду товара" />
                        </span>
                      </div><!-- /input-group -->
                    </form>
                    <br />
                    <form method="post" action="resultsaler.php">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="сюда фио продавца" name="saler" />
                        <span class="input-group-btn">
                          <input type="submit" class="btn btn-danger" value="Поиск по фио продавца" />
                        </span>
                      </div><!-- /input-group -->
                    </form>
                    <br />
                    <form method="post" action="resulttovar.php">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="введите наименование товара" name="tovarname" />
                        <span class="input-group-btn">
                          <input type="submit" class="btn btn-info btn-flat" value="Поиск по товарам" />
                        </span>
                      </div><!-- /input-group -->
                    </form>
                    <br />
                  </div>
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <? include "footer.php"; 
  else :
header('Location: /');
endif; ?>
