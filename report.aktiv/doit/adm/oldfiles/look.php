<? //проверка существовании сессии
include("../../bd.php");

$id = (int) $_GET["id"];
$id = strip_tags($_GET['id']);
$id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
$id = htmlspecialchars($_GET['id'], ENT_QUOTES);

$data = R::load('reports', $id);
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
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Редактирование / удаление</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="functions/redak.php" method="post">
              <div class="box-body">
                <input name="id" value="<?= $id; ?>" hidden="" />
                <input name="region" value="<?= $region; ?>" hidden="" />
                <input name="adress" value="<?= $adress; ?>" hidden="" />
                <div class="form-group">
                  <label for="data" class="col-sm-2 control-label">Дата отчета</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="data" name="data" value="<?= $data['data']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="reg_date" class="col-sm-2 control-label">Время update</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="reg_date" name="reg_date" value="<?= $data['reg_date']; ?>" />
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
                <div class="form-group">
                  <label for="dop" class="col-sm-2 control-label">Доп доход</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="dop" name="dop" value="<?= $data['dop']; ?>" />
                  </div>
                </div>
                <!--
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Доход</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="dohod" value="<?= $data['dohod']; ?>" />
                      </div>
                    </div>-->

                <div class="form-group">
                  <label for="stabrashod" class="col-sm-2 control-label">Стабильный расход</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="stabrashod" name="stabrashod" value="<?= $data['stabrashod']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="tekrashod" class="col-sm-2 control-label">Текущий расход</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="tekrashod" name="tekrashod" value="<?= $data['tekrashod']; ?>" />

                  </div>
                </div>
                <div class="form-group">
                  <label for="comment" class="col-sm-2 control-label">
                    <font color="red">ПРИМЕЧАНИЕ</font>
                  </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="comment" name="comment" value="<?= $data['comment']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="allclients" class="col-sm-2 control-label">Все клиенты</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="allclients" name="allclients" value="<?= $data['allclients']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="newclients" class="col-sm-2 control-label">Новые клиенты</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="newclients" name="newclients" value="<?= $data['newclients']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Выдача за сут</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="vzs" value="<?= $data['vzs']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="vozvrat" class="col-sm-2 control-label">Возврат</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="vozvrat" name="vozvrat" value="<?= $data['vozvrat']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="nakladnoy" class="col-sm-2 control-label">Накладные</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nakladnoy" name="nakladnoy" value="<?= $data['nakladnoy']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="chv" class="col-sm-2 control-label">Чистая выдача</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="chv" name="chv" value="<?= $data['chv']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="auktech" class="col-sm-2 control-label">Аукционист техника</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="auktech" name="auktech" value="<?= $data['auktech']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="aukshubs" class="col-sm-2 control-label">Аукционист шубы</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="aukshubs" name="aukshubs" value="<?= $data['aukshubs']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="nalvzaloge" class="col-sm-2 control-label">Нал в залоге</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nalvzaloge" name="nalvzaloge" value="<?= $data['nalvzaloge']; ?>" />
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-6">
                    <button type="submit" name="edit" value="true" class="btn btn-success pull-right">СОХРАНИТЬ</button>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" name="delete" value="true" class="btn btn-danger">УДАЛИТЬ</button>
                  </div>
                </div>
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