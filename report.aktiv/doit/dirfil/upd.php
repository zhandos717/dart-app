<? //проверка существовании сессии
include("../../bd.php");

$id = htmlentities($_REQUEST["id"]);
$id = (int) $id;
$data = R::load('reports', $id);
if ($_SESSION['logged_user']->status == 1) :
?>

  <? include "header.php"; ?>
  <? include "menu.php"; ?>
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
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Редактирование / удаление</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="redak.php" method="post">
              <div class="box-body">
                <input name="id" value="<?= $id; ?>" hidden="" />

                <div class="form-group">
                  <label for="data" class="col-sm-2 control-label">Дата отчета</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="data" name="data" value="<?= $data['data']; ?>" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="dl" class="col-sm-2 control-label">Доход ломбард</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="dl" name="dl" value="<?= $data['dl']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="dm" class="col-sm-2 control-label">Доход магазин</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="dm" name="dm" value="<?= $data['dm']; ?>" />
                  </div>
                </div>
                <!-- <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Доход комиссионки</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="dk" value="<?= $data['dk']; ?>" />
                    </div>
                  </div> -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Доп доход</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="dop" value="<?= $data['dop']; ?>" />
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Стабильный расход</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="stabrashod" value="<?= $data['stabrashod']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Текущий расход</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="tekrashod" value="<?= $data['tekrashod']; ?>" />
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Все клиенты</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="allclients" value="<?= $data['allclients']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Новые клиенты</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="newclients" value="<?= $data['newclients']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Выдача за сут</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="vzs" value="<?= $data['vzs']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Возврат</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="vozvrat" value="<?= $data['vozvrat']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Накладные</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="nakladnoy" value="<?= $data['nakladnoy']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Чистая выдача</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="chv" value="<?= $data['chv']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Аукционист техника</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="auktech" value="<?= $data['auktech']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Аукционист шубы</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="aukshubs" value="<?= $data['aukshubs']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Нал в залоге</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="nalvzaloge" value="<?= $data['nalvzaloge']; ?>" />
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <font color="red">ПРИМЕЧАНИЕ</font>
                  </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="comment" value="<?= $data['comment']; ?>" />
                  </div>
                </div> -->

              </div><!-- /.box-body -->
              <div class="box-footer">

                <button type="submit" class="btn btn-info pull-right">СОХРАНИТЬ</button>
              </div><!-- /.box-footer -->
            </form>


          </div><!-- /.box -->


        </div><!-- /.col -->

    </section>

  </div><!-- /.content-wrapper -->
<? include "footer.php";
else :
  header('Location: /');
endif; ?>
