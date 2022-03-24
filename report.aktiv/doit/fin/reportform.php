<? //проверка существовании сессии
include("../../bd.php");

if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 11) :

    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;

?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчетные формы директора <b><?= $_SESSION['logged_user']->fio; ?></b> филилала - <b><?= $adress; ?> (<?= $region; ?>)</b>

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

          <!-- /.col (left) -->
          <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Отчетные формы</h3>
              </div>
              <div class="box-body">


                <!--Сведения по выданным/возвращенным кредитам-->
                <div class="form-group">
                  <p><b></b></p>
                  <label>&ensp; Сведения по выданным/возвращенным кредитам и реализованным залогам за период</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <form action="spvvk.php" method="post">

                      <b></i><input type="date" class="form-control" style="width: 16rem;" name="date1">
                        <input type="date" class="form-control" style="width: 16rem;" name="date2"></b>

                      <span> &nbsp;<input type="submit" name="gogo" class="btn btn-success" value="Сформировать"></span>
                    </form>
                  </div>
                  <!-- /.input group -->
                </div>
                <!--Сведения по выданным/возвращенным кредитам -->

                <!--Баланс денежных средств-->
                <div class="form-group">
                  <p><b></b></p>
                  <label>&ensp; Баланс денежных средств за период</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <form action="balans.php" method="post">

                      <b></i><input type="date" class="form-control" style="width: 16rem;" name="date1">
                        <input type="date" class="form-control" style="width: 16rem;" name="date2"></b>

                      <span> &nbsp;<input type="submit" name="gogo" class="btn btn-success" value="Сформировать"></span>
                    </form>
                  </div>
                  <!-- /.input group -->
                </div>
                <!--Баланс денежных средств -->

                <!--отчет по доходам в разрезе сотрудников-->
                <div class="form-group">
                  <p><b></b></p>
                  <label>&ensp; Статистический отчет по доходам в разрезе сотрудников за период</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <form action="statreport.php" method="post">

                      <b></i><input type="date" class="form-control" style="width: 16rem;" name="date1">
                        <input type="date" class="form-control" style="width: 16rem;" name="date2"></b>

                      <span> &nbsp;<input type="submit" name="gogo" class="btn btn-success" value="Сформировать"></span>
                    </form>
                  </div>
                  <!-- /.input group -->
                </div>
                <!--отчет по доходам в разрезе сотрудников -->

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.box -->
          </div>

          <div class="col-md-6">

            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Отчетные формы</h3>
              </div>
              <div class="box-body">

                <!--по изъятым товарам-->
                <div class="form-group">
                  <p><b></b></p>
                  <label>&ensp; Сведения об операциях по изъятым товарам за период</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <form action="izyat.php" method="post">

                      <b></i><input type="date" class="form-control" style="width: 16rem;" name="date1">
                        <input type="date" class="form-control" style="width: 16rem;" name="date2"></b>

                      <span> &nbsp;<input type="submit" name="gogo" class="btn btn-success" value="Сформировать"></span>
                    </form>
                  </div>
                  <!-- /.input group -->
                </div>
                <!--по изъятым товарам -->

                <!--Журнал операции-->
                <div class="form-group">
                  <p><b></b></p>
                  <label>&ensp; Журнал операции по залоговым билетам за период</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <form action="oper.php" method="post">

                      <b></i><input type="date" class="form-control" style="width: 16rem;" name="date1">
                        <input type="date" class="form-control" style="width: 16rem;" name="date2"></b>

                      <span> &nbsp;<input type="submit" name="gogo" class="btn btn-success" value="Сформировать"></span>
                    </form>
                  </div>
                  <!-- /.input group -->
                </div>
                <!--Журнал операции -->

                <!--nalvzaloge -->
                <div class="form-group">
                  <p><b></b></p>
                  <label>&ensp;Остатки залогового имущества на</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <form action="nalvzaloge.php" method="post">
                      <b><input type="date" class="form-control pull-left" style="width: 16rem;" name="date1"></b>
                      <span>&nbsp; <input type="submit" name="gogo" class="btn btn-success" value="Сформировать"></span>
                    </form>
                  </div>
                  <!-- /.input group -->
                </div>
                <!--nalvzaloge -->

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

        </div><!-- /.row -->
      </section>
    </div>

    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :

  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
