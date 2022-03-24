<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 10) :
  include "header.php";
  include "menu.php";
  $region = R::findAll('kassa', 'region <> "Тест" GROUP BY region');
?>
  <!-- Content Wrapper. Contains page content -->
  <script src="linkedselect.js" charset="utf-8"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Финансовые передвижения
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регионы</a></li>
        <li class="active">Филиалы</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <? if ($_SESSION['message']) { ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4> <i class="icon fa fa-check"></i> Успех!</h4>
              <?= $_SESSION['message']; ?>
            </div>
          </div>
        </div>
      <? } elseif ($_SESSION['error']) { ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4> <i class="icon fa fa-times-circle"></i> Ошибка!</h4>
              <?= $_SESSION['error']; ?>
            </div>
          </div>
        </div>
      <? };
      unset($_SESSION['message'], $_SESSION['error']); ?>
      <?php if ($_POST['operation'] == 1) { ?>
        <div class="row">
          <form action="functions/cashTransactions.php" method="POST">
            <div class="col-xs-12">
              <div class="box box-success">
                <!-- collapsed-box -->
                <div class="box-header with-border">
                  <h3 class="box-title"> <i class="fa fa-bank"></i> Операция с банком </h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa  fa-arrow-circle-right"></i>
                        </span>
                        <select class="form-control" required name="kassaoperation">
                          <option value="">Операция по кассе</option>
                          <option value="0">Внесение</option>
                          <option value="1">Изъятие</option>
                        </select>
                      </div>
                      <!-- /input-group -->
                    </div>
                    <div class="col-lg-3 col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-bank"></i>
                        </span>
                        <select class="form-control" id="get_region" name="region">
                          <option value="">Выберите город</option>
                          <? foreach ($region as $reg) { ?>
                            <option><?= $reg['region'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class="col-lg-3 col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-building"></i>
                        </span>
                        <select class="form-control" id="adress" name="adress"></select>
                      </div>
                      <!-- /input-group -->
                    </div>
                    <div class="col-lg-3 col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-fax"></i>
                        </span>
                        <select class="form-control" id="List6" name="kassa">
                          <option value="Касса 1">Касса 1</option>
                          <option value="Касса 2">Касса 2</option>
                          <option value="Касса 3">Касса 3</option>
                          <option value="Касса 4">Касса 4</option>
                          <option value="Касса 5">Касса 5</option>
                        </select>
                      </div>
                      <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-6 -->
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-usd"></i>
                        </span>
                        <input class="form-control" type="number" required name="summa" placeholder="Сумма опрерации">
                      </div>
                      <!-- /input-group -->
                    </div>
                    <div class="col-lg-2 col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa  fa-ellipsis-h"></i>
                        </span>
                        <select class="form-control" required name="Chet">
                          <option value=""> КР. Счет </option>
                          <option value="1255"> 1255 </option>
                          <option value="1251"> 1251 </option>
                          <option value="3350"> 3350 </option>
                          <option value="3388"> 3388 </option>
                          <option value="1272"> 1272 </option>
                          <option value="1030"> 1030 </option>
                        </select>
                      </div>
                      <!-- /input-group -->
                    </div>
                    <div class="col-lg-5">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-comments-o"></i>
                        </span>
                        <input class="form-control" type="text" required name="coment" placeholder="Дополнительная информация">
                      </div>
                      <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class="col-lg-2">
                      <div class="input-group">
                        <button type="submit" class="btn btn-block btn-success ">Подтвердить</button>
                      </div>
                      <!-- /input-group -->
                    </div>
          </form>
          <!-- /.col-lg-6 -->
        </div><!-- /.row -->
  </div>
<?php } elseif ($_POST['operation'] == 2) { ?>

  <div class="row">
    <form action="functions/cashTransactions.php" method="POST">
      <input type="text" name="token" hidden value="741852">
      <div class="col-xs-12">
        <div class="box box-warning">
          <!-- collapsed-box -->
          <div class="box-header with-border">
            <h3 class="box-title"> <i class="fa fa-exchange"></i> Переводы между филиалами </h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-lg-4 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </span>
                  <select class="form-control" id="region1" name="region1">
                    <option value="">Выберите город</option>
                    <? foreach ($region as $reg) { ?>
                      <option><?= $reg['region'] ?></option>
                    <? } ?>
                  </select>
                </div>
                <!-- /input-group -->
              </div>
              <!-- /.col-lg-4 -->
              <div class="col-lg-4 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </span>
                  <select class="form-control" id="adress1" name="adress1"></select>
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-4 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-fax"></i>
                  </span>
                  <select class="form-control" name="kassa1">
                    <option value="Касса 1">Касса 1</option>
                    <option value="Касса 2">Касса 2</option>
                    <option value="Касса 3">Касса 3</option>
                    <option value="Касса 4">Касса 4</option>
                    <option value="Касса 5">Касса 5</option>
                  </select>
                </div>
                <!-- /input-group -->
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </span>
                  <select class="form-control" id="region2" name="region2">
                    <option value="">Выберите город</option>
                    <? foreach ($region as $reg) { ?>
                      <option><?= $reg['region'] ?></option>
                    <? } ?>
                  </select>
                </div>
                <!-- /input-group -->
              </div>
              <!-- /.col-lg-4 -->
              <div class="col-lg-4 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </span>
                  <select class="form-control" id="adress2" name="adress2"></select>
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-4 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-fax"></i>
                  </span>
                  <select class="form-control" id="List33" name="kassa2">
                    <option value="Касса 1">Касса 1</option>
                    <option value="Касса 2">Касса 2</option>
                    <option value="Касса 3">Касса 3</option>
                    <option value="Касса 4">Касса 4</option>
                    <option value="Касса 5">Касса 5</option>
                  </select>
                </div>
                <!-- /input-group -->
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-usd"></i>
                  </span>
                  <input class="form-control" type="number" required name="summa" placeholder="Сумма опрерации">
                </div>
                <!-- /input-group -->
              </div>

              <div class="col-lg-2 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa  fa-ellipsis-h"></i>
                  </span>
                  <select class="form-control" name="Chet">
                    <option value=""> КР. Счет </option>
                    <option value="1255"> 1255 </option>
                    <option value="1251"> 1251 </option>
                    <option value="3350"> 3350 </option>
                    <option value="3388"> 3388 </option>
                    <option value="1272"> 1272 </option>
                    <option value="1030"> 1030 </option>
                  </select>
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-5">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-comments-o"></i>
                  </span>
                  <input class="form-control" type="text" required name="coment" placeholder="Дополнительная информация">
                </div>
                <!-- /input-group -->
              </div>
              <!-- /.col-lg-4 -->
              <div class="col-lg-2">
                <div class="input-group">
                  <button type="submit" class="btn btn-block btn-success ">Подтвердить</button>
                </div>
                <!-- /input-group -->
              </div>
    </form>
    <!-- /.col-lg-6 -->
  </div><!-- /.row -->
  </div>
  <!-- /.box-body -->
  </div>
  </div>
  </div>
<? } else { ?>
  <div class="row">
    <div class="col-xs-6">
      <div class="box box-success">
        <div class="box-body">
          <form action="findv.php" method="post">
            <input type="text" hidden name="operation" value="1">
            <button class="btn btn-block btn-social btn-success">
              <i class="fa fa-bank"></i> Операция с банком
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-xs-6">
      <div class="box box-warning">
        <div class="box-body">
          <form action="findv.php" method="post">
            <input type="text" hidden name="operation" value="2">
            <button class="btn btn-block btn-social btn-warning">
              <i class="fa fa-exchange"></i> Переводы между филиалами
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php }; ?>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      <!--box -->
      <div class="box-body">

        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr class="info">
                <th>№</th>
                <th class="text-center">Откуда</th>
                <th class="text-center">Куда</th>
                <th>Дата </th>
                <th>Cчет</th>
                <th>Вид операции</th>
                <th>Сумма</th>
                <th>Касса</th>
                <th>Статус</th>
                <th>Примечание</th>
              </tr>
            </thead>
            <tbody id="otvet">
              <?
              $result = R::findAll('finance', "ORDER BY id DESC LIMIT 50 "); //WHERE status = 1 OR status = 2
              $i = 1;
              foreach ($result as $data) {
                $np = $data['np'];
                $operation = $data['operationtype'];
                $data1 = R::getRow(
                  "SELECT 
                region,filial,kassa  
                FROM finance 
                WHERE np ='$np' 
                AND NOT operationtype = '$operation'  
                ORDER BY id DESC LIMIT 1"
                );
              ?>
                <tr>
                  <th><?= $i++; ?>.
                  </th>

                  <? if ($data['kassaoperation'] == '2') { ?>
                    <td><?= $data['region']; ?>/<?= $data['filial']; ?>/<?= $data['kassa']; ?></td>
                    <td><?= $data1['region']; ?>/<?= $data1['filial']; ?>/<?= $data1['kassa']; ?></td>
                    <? } else {
                    if ($data['operationtype'] === '0') { ?>
                      <td class="success"> Пополнение кассы комиссионного магазина </td>
                      <td><?= $data['region']; ?>/<?= $data['filial']; ?></td>
                    <? } else if ($data['operationtype'] == 1) { ?>
                      <td><?= $data['region']; ?>/<?= $data['filial']; ?></td>
                      <td class="danger"> Изъятие из базы комиссионного магазина</td>
                    <? } else { ?>
                      <td class="danger text-center"> Ошибка</td>
                      <td class="danger text-center"> Ошибка</td>
                  <? }
                  } ?>
                  <td><?= date("d.m.Y H:i:s", strtotime($data['dataatime'])); ?></td>
                  <td><?= $data['chet']; ?></td>
                  <td>
                    <?
                    if ($data['operationtype'] === '0') {
                      echo "<span class='label label-success'> Внесение </span>";
                    } else if ($data['operationtype'] == 1) {
                      echo "<span class='label label-danger'> Изъятие </span>";
                    } else {
                      echo "<span class='label label-danger'> Ошибка </span>";
                    }
                    ?>
                    <br>

                  </td>
                  <td><?= number_format($data['summa'], 0, '.', ' '); ?></td>
                  <td><?= $data['kassa']; ?></td>
                  <td>
                    <?
                    if ($data['status'] == 1) { ?>
                      <span class='label label-info'> Сформирован </span>
                      <!-- <a href="#" title="редактировать" class="btn btn-warning"> <i class="fa fa-edit"></i> </a> -->
                      <!-- <button title="удалить" id='remove' class="btn btn-danger"> <i class="fa fa-remove"></i> </button> -->
                    <? } else {
                      echo "<span class='label label-warning'> Выполнено </span>";
                    }
                    ?>
                  </td>
                  <td><?= $data['coment']; ?> </td>
                </tr>
              <? } ?>
            </tbody>
            <tfoot>
              <?
              $result2 = R::getRow("SELECT SUM(summa) FROM finance WHERE kassaoperation = '1' AND operationtype = '0' ");
              $result3 = R::getRow("SELECT SUM(summa) FROM finance WHERE kassaoperation = '1' AND operationtype = '1' ");
              ?>
              <tr>
                <th colspan="2" class="text-center">ИТОГ:</th>
                <th colspan="2" class="text-center">пополнение:</th>
                <th colspan="2"><?= number_format($result2['SUM(summa)'], 0, '.', ' '); ?></th>
                <th colspan="2" class="text-center">Изъятие:</th>
                <th colspan="2"><?= number_format($result3['SUM(summa)'], 0, '.', ' '); ?></th>
              </tr>
            </tfoot>
          </table>
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->
      <div class="box-footer clearfix">
      </div>
    </div><!-- /.box -->

  </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  $(document).ready(function() {
    $('button#remove').click(function() {
      alert('Хотите удалить ?');
    });
  });



  $('#region1').change(function() {
    var region = $(this).val();
    console.log(region);
    $('#adress1').load('../function/get_adress.php', {
      region: region
    });
  });

  $('#region2').change(function() {
    var region = $(this).val();
    console.log(region);
    $('#adress2').load('../function/get_adress.php', {
      region: region
    });
  });
</script>

<? include "footer.php";
else :
  header('Location: /');
endif; ?>