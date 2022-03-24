<?include("../../../bd.php");

$id = (int) $_POST["id"];
$id = strip_tags($_POST['id']);
$id = htmlentities($_POST['id'], ENT_QUOTES, "UTF-8");
$id = htmlspecialchars($_POST['id'], ENT_QUOTES);

if($_POST['table']){
$data = R::load($_POST['table'],$id);
}else {
 $data = R::load('sales12',$id);
};

$region = $data['region'];
$adress = $data['adress'];
if ($_SESSION['logged_user']->status == 3) :
  include "header.php";
  include "menu.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $data['region']; ?>/<?= $data['adress']; ?>
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
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Редактирование / удаление</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" action="functions/redak_sales12.php" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Дата отчета</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="inputEmail3" name="data" value="<?= $data['data']; ?>" />
                </div>
              </div>
              <input type="text" name="table" hidden value="<?= $_POST['table'] ?>">
              <input type="text" hidden name="back" value="detali012021">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Код товара</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="codetovar" value="<?= $data['codetovar']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Наименование товара</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="tovarname" value="<?= $data['tovarname']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Приходная сумма товара:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="summaprihod" value="<?= $data['summaprihod']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Сумма кредита</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="summakredit" value="<?= $data['summakredit']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Предоплата</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="predoplata" value="<?= $data['predoplata']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Сумма реализации (с вычетом %)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="summareal" value="<?= $data['summareal']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Прибыль</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="pribl" value="<?= $data['pribl']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Вид</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="vid" value="<?= $data['vid']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Продавец (ФИО)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="saler" value="<?= $data['saler']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ФИО покупател</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="pokupatel" value="<?= $data['pokupatel']; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Сумма прихода товара за день</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="summazaden" value="<?= $data['summazaden']; ?>" />
                </div>
              </div>

            </div><!-- /.box-body -->
            <div class="box-footer">

              <button type="submit" name="go_update" value="<?= $id; ?>" class="btn btn-info pull-right">СОХРАНИТЬ</button>
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->
        <a href="functions/deletesales12.php?id=<?= $id; ?>&region=<?= $data['region']; ?>&adress=<?= $data['adress']; ?>&data=<?= $data['data']; ?>"><button class="btn btn-danger">УДАЛИТЬ</button></a>


      </div><!-- /.col -->

  </section>

</div><!-- /.content-wrapper -->
<? include "footer.php";
else :
  header('Location: /');
endif; ?>