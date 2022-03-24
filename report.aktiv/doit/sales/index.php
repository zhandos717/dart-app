<?
include("../../bd.php");
if ($status == 5) :
  include "header.php";
  include "menu.php";
  include_once 'functions/notification.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регион - <?= $region; ?></a></li>
        <li class="active"><?= $adress; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <? if ($_SESSION['message']) : ?>
        <div class="row">
          <? if ($_SESSION['message_status'] == '2') {
            $color = 'success';
            $ico = 'check';
            $coment = 'Успех';
          } else {
            $color = 'danger';
            $ico = 'ban';
            $coment = 'Ошибка';
          } ?>
          <div class="col-xs-12">
            <div class="alert alert-<?= $color; ?> alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-<?= $ico; ?>"></i> <?= $coment; ?>!</h4>
              <?= $_SESSION['message']; ?>
            </div>
          </div>
        </div>
      <? unset($_SESSION['message'], $_SESSION['message_status']);
      endif; ?>
      <? if (!empty($res)) { ?>
        <!-- если товары есть показываем их  -->
        <div class="row">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h4>У вас
                  <?= $res['count']; ?> ед. товара находятся более 10 дней на реализации
                </h4>
                <h3>На общую сумму <?= number_format($res['SUM(cena_pr)'], 0, '.', ' '); ?> тг</h3>
              </div>
              <div class="icon">
                <i class="fa fa-warning"></i>
              </div>
              <a href="a_report.php?id=7" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      <? }; ?>
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Ежедневная Форма отчета продажи <?= date('m.d.Y'); ?>
              </h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form action="functions/test.php" method="POST">
              <div class="box-body">
                <div class="row ">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="data">Дата отчета:</label>
                      <input class="form-control" id="data" type="date" name="data" min="2021-09-01" value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="codetovar">Код товара:</label>
                      <input class="form-control" id="codetovar" type="text" name="codetovar" placeholder="00-00" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="get_region">Город:</label>
                      <select id="get_region" name="regionlombard" class="form-control" required>
                        <option value="">Выберите город</option>
                        <? $regions = R::getCol('SELECT region FROM diruser GROUP BY region');
                        foreach ($regions as $city) { ?>
                          <option><?= $city ?></option>
                        <? } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="adress">Филиал:</label>
                      <select id="adress" required name="adresslombard" class="form-control">
                        <option value="">Выберите город</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="summaprihod">Приходная сумма:</label>
                      <input class="form-control" required id="summaprihod" type="number" name="summaprihod">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="count_payment">К-во способов оплаты:</label>
                      <select name="count_payment" required class="form-control" id="count_payment">
                        <option value="">Выберите количество</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                      </select>
                    </div>
                  </div>
                  <div id="payment_answer">

                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="tovarname">Наименование:</label>
                      <textarea class="form-control" id="tovarname" name="tovarname" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="saler">Продавец (ФИО):</label>
                      <select name="saler" required id="saler" class="form-control">
                        <option value="">Выберите продавца</option>
                        <? $salers = R::getCol("SELECT fiosaler FROM saler WHERE region = '$region' AND shop = '$adress'");
                        var_dump($salers);
                        foreach ($salers as $saler) { ?>
                          <option><?= $saler; ?></option>
                        <? } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pokupatel">ФИО покупателя:</label>
                      <input class="form-control" id="pokupatel" type="text" name="pokupatel" required>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Отправить отчет</button>
              </div><!-- /.box-footer -->
            </form>
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <script>
    $(function() {
      $('#get_region').change(function() {
        var region = $(this).val();
        $('#adress').load('../function/get_adress.php', {
          value: region
        });
      });
      $('#count_payment').change(function() {
        var count = $(this).val();
        $('#payment_answer').load('../function/get_count_payment.php', {
          value: count
        });
      });
      // $('#codetovar').keyup(function() {
      //   var code = $(this).val();
      //   if (code.includes('-')) {
      //     $.post('../function/get_product.php', {
      //         code: code
      //       })
      //       .done(function(response) {
      //         var data = JSON.parse(response)
      //         console.log(data)

      //         if (data.status == 'success') {
      //           $('#summaprihod').val(data.ticket.summa_vydachy).attr('disabled', 'disabled');

      //           $('#get_region').val(data.ticket.region).attr('disabled', 'disabled');

      //           $('#tovarname').val(data.ticket.category + ' ' + data.ticket.tovarname);

      //           $('#adress').load('../function/get_adress.php', {
      //             value: data.ticket.region
      //           });

      //           function sayHi() {
      //             $('#adress').val(data.ticket.adressfil).attr('disabled', 'disabled');
      //           }
      //           setTimeout(sayHi, 1500);
      //           console.log(data)

      //         } else {

      //           $('#summaprihod').val(0).removeAttr('disabled');
      //           $('#summaprihod').removeAttr('disabled');;
      //           $('#get_region').removeAttr('disabled');;
      //           $('#tovarname').val('').removeAttr('disabled');
      //           $('#adress').removeAttr('disabled');

      //         }
      //       })
      //   }
      // })
    });
  </script>
<?php
  include "footer.php";
else :
  header('Location: /');
endif;
//{{ option.text }} v-for="option in options" v-bind:value="option.value"
?>