<?
include("../../bd.php");
if ($_SESSION['logged_user']->status == 1) :
  include "header.php";
  include "menu.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $region; ?> / <?= $adress; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регион - <?= $region; ?></a></li>
        <li class="active"><?= $adress; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Форма отчета директора филиала</h3>
            </div><!-- /.box-header -->

            <form action="./functions/add_report.php " method="POST">
              <div class="box-body">
                <div class="row ">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="data">Дата отчета:</label>
                      <input class="form-control" id="data" type="date" name="data" min="2022-02-01" max="2022-02-28" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="dl">Доход ломбард:</label>
                      <input class="form-control" id="dl" type="number" name="dl" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="dm">Доход магазин:</label>
                      <input class="form-control" id="dm" type="number" name="dm" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="dop">Доп доход (возврат изьятого):</label>
                      <input class="form-control" id="dop" type="number" name="dop" required="">
                    </div>
                  </div>
                  <!-- <div class="col-md-12 text-center">
                  <h3 class="text-danger">Доход считается автоматический Доход = Доход ломбард + Доход магазин + Доп доход </h3>
                  <br>
                </div> -->
                  <!-- <div class="col-md-6">
                    <div class="form-group">
                      <label for="stabrashod">Стабильный расход:</label>
                      <input class="form-control" id="stabrashod" type="number" name="stabrashod" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tekrashod" class="control-label">Текущий расход:</label>
                      <input class="form-control" id="tekrashod" type="number" name="tekrashod" required="">
                    </div>
                  </div> -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="allclients" class="control-label">Клиенты за сегодня:</label>
                      <input class="form-control" id="allclients" type="number" name="allclients" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="newclients" class=" control-label">Новые клиенты за сегодня:</label>
                      <input class="form-control" id="newclients" type="number" name="newclients" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="vzs" class=" control-label">Выдача за сутки:</label>
                      <input class="form-control" id="vzs" type="number" name="vzs" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="vozvrat" class=" control-label">Возврат:</label>
                      <input class="form-control" id="vozvrat" type="number" name="vozvrat" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nakladnoy" class=" control-label">Накладная:</label>
                      <input class="form-control" id="nakladnoy" type="number" name="nakladnoy" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="auktech" class=" control-label">Аукционист техники:</label>
                      <input class="form-control" id="auktech" type="number" name="auktech" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="aukshubs" class=" control-label">Аукционист шуб:</label>
                      <input class="form-control" id="aukshubs" type="number" name="aukshubs" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nalvzaloge" class=" control-label">Нал в залоге:</label>
                      <input class="form-control" id="nalvzaloge" type="number" name="nalvzaloge" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="comment" class=" control-label">
                        ПРИМЕЧАНИЕ
                      </label>
                      <input type="text" class="form-control" id="comment" name="comment" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="dohod" class=" control-label">
                        Доход:
                      </label>
                      <input type="text" class="form-control" disabled id="dohod" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="chv" class=" control-label">
                        Чистая выдача:
                      </label>
                      <input type="text" class="form-control" disabled id="chv" />
                    </div>
                  </div>
                </div>

              </div>
              <div class="box-footer">
                <button name="do_signup" type="submit" class="btn btn-danger pull-right">Заполнить</button>
              </div><!-- /.box-footer -->
            </form>
          </div>

        </div>
      </div>
    </section>
  </div>

  <script>
    $(document).ready(
      $('input').keyup(function() {
        let dl = +$('#dl').val()
        let dm = +$('#dm').val()
        let dop = +$('#dop').val()
        let vzs = +$('#vzs').val()
        let vozvrat = +$('#vozvrat').val()
        let nakladnoy = +$('#nakladnoy').val()

        $('#dohod').val(dop + dm + dl)
        $('#chv').val(vzs - vozvrat - nakladnoy)

      })
    );
  </script>

<? include "footer.php";
else :
  header('Location: /');
endif; ?>