<? //проверка существовании сессии
include("../../../bd.php");

$id = (int) $_GET["id"];
$id = strip_tags($_GET['id']);
$id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
$id = htmlspecialchars($_GET['id'], ENT_QUOTES);

$result = mysqli_query($connect, " SELECT *from reports032020 WHERE id = '$id'");

$data = mysqli_fetch_array($result);


if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
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
              <form class="form-horizontal" action="functions/redak03.php" method="post">
                <div class="box-body">
                  <input name="id" value="<?= $id; ?>" hidden="" />
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Дата отчета</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="inputEmail3" name="data" value="<?= $data['data']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Время update</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="reg_date" value="<?= $data['reg_date']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Доход</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="dohod" value="<?= $data['dohod']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Стабильный расход</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="stabrashod" value="<?= $data['stabrashod']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Текущий расход</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="tekrashod" value="<?= $data['tekrashod']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Все клиенты</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="allclients" value="<?= $data['allclients']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Новые клиенты</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="newclients" value="<?= $data['newclients']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Выдача за сут</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="vzs" value="<?= $data['vzs']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Возврат</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="vozvrat" value="<?= $data['vozvrat']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Накладные</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="nakladnoy" value="<?= $data['nakladnoy']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Чистая выдача</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="chv" value="<?= $data['chv']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Аукционист техника</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="auktech" value="<?= $data['auktech']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Аукционист шубы</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="aukshubs" value="<?= $data['aukshubs']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Нал в залоге</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="nalvzaloge" value="<?= $data['nalvzaloge']; ?>" />
                    </div>
                  </div>

                </div><!-- /.box-body -->
                <div class="box-footer">

                  <button type="submit" class="btn btn-info pull-right">СОХРАНИТЬ</button>
                </div><!-- /.box-footer -->
              </form>

              <a href="functions/deleted03.php?id=<?= $id; ?>"><button class="btn btn-default">УДАЛИТЬ</button></a>
            </div><!-- /.box -->


          </div><!-- /.col -->

      </section>

    </div><!-- /.content-wrapper -->



    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>