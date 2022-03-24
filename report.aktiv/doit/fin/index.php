<?
include("../../bd.php");
if ($_SESSION['logged_user']->status == 11) :
  include "header.php";
  include "menu.php"; ?>

  <script type="text/javascript" src="linkedselect.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Все проданные товары
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
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-tag"></i> Реализованный товары</h3>
            </div>
            <div class="box-body">
              <form action="functions/report_sales.php" method="POST">
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group">
                    <input type="date" class="form-control" value="<?= date('Y-m-01') ?>" name="date1">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                  <div class="input-group">
                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date2">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-bank"></i>
                    </span>
                    <select class="form-control" id="get_region" name="region">
                      <? if ($region) { ?>
                        <option value="<?= $region; ?>"><?= $region; ?></option>
                      <? }; ?>
                      <option value="Нур-султан">Нур-султан</option>
                      <option value="Актау">Актау</option>
                      <option value="Актобе">Актобе</option>
                      <option value="Алматы">Алматы</option>
                      <option value="Атырау">Атырау</option>
                      <option value="Караганда">Караганда</option>
                      <option value="Кокшетау">Кокшетау</option>
                      <option value="Костанай">Костанай</option>
                      <option value="Павлодар">Павлодар</option>
                      <option value="Семей">Семей</option>
                      <option value="Талдыкорган">Талдыкорган</option>
                      <option value="Тараз">Тараз</option>
                      <option value="Шымкент">Шымкент</option>
                      <option value="Уральск">Уральск</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-fax"></i>
                    </span>
                    <select class="form-control" name="kassa">
                      <? if ($kassa) { ?>
                        <option value="<?= $kassa; ?>"> <?= $kassa; ?> </option>
                      <? }; ?>
                      <option value="Касса 1"> Касса 1 </option>
                      <option value="Касса 2"> Касса 2 </option>
                      <option value="Касса 3"> Касса 3 </option>
                      <option value="Касса 4"> Касса 4 </option>
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
        </div>
      </div>
      <div class="answer">

      </div>
    </section>
  </div>
<?
  include "footer.php";
else :
  header('Location: ../../index.php');
endif; ?>