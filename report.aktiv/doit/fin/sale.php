<?php

  include("../../bd.php");
  if ($_SESSION['logged_user']->status == 11) :

      if(preg_match('/[0-9]-[0-9]/',$_REQUEST['nomerzb'])){
         $data_zb = R::findOne('tickets','nomerzb=?',[$_REQUEST['nomerzb']]);
         $data_st = R::findOne('status_zb','id=?',[$data_zb['status']]);
       }elseif(preg_match("/\d+\z/i",$_REQUEST['nomerzb'],$matches)){
         $book = R::load('product',$matches[0]);
       }
       
  $statuszb = $data_st['name'];
  $today = $data_zb['datesale'] ?? date("Y-m-d"); 
  $active = 'active';     
  include "header.php"; 
  include "menu.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li><a href="index.php">Регионы</a></li>
      <li class="active">Филиалы</li>
    </ol>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <? if($_SESSION['message']){?>
    <div class="row">
      <div class="col-xs-12">
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4> <i class="icon fa fa-check"></i> Успех!</h4>
          <?= $_SESSION['message']; ?>
        </div>
      </div>
    </div>
    <?};unset($_SESSION['message']);?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Поиск товара по базе данных </h3>
          </div>
          <div class="box-body">
            <form action="" method="GET">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" name="nomerzb" value="<?= $data_zb['nomerzb']; ?>" placeholder="Введите код товара">
                <span class="input-group-btn">
                  <button class="btn btn-info btn-flat" type="submit">Найти!</button>
                </span>
              </div><!-- /input-group -->
            </form>
            <br>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
        <? if($statuszb):?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Информация о товаре</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">№</th>
                  <th colspan="2" class="text-center">Общие сведения</th>
                </tr>
              </thead>
              <tr class="success">
                <td></td>
                <td style="width:20rem;">Код товара</td>
                <td>
                  <?= $data_zb['nomerzb']; ?>
                </td>
              </tr>
              <tr class="danger">
                <td></td>
                <td>Дата выдачи</td>
                <td>
                  <?= $data_zb['dataseg']; ?>
                </td>
              </tr>
              <tr>
                <td></td>
                <td> Наименование товара</td>
                <td>
                  <?= $data_zb['category']; ?>, <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?>
                  SN: <?= $data_zb['sn']; ?>, IMEI:<?= $data_zb['imei']; ?>, <?= $data_zb['complect']; ?> <?= $data_zb['opisanie']; ?>
                </td>
              </tr>
              <tr class="danger">
                <td></td>
                <td> Сумма выдачи</td>
                <td>
                  <?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?> тг.
                </td>
              </tr>
              <?if($data_zb['zadatok']):?>
              <tr>
                <td></td>
                <td> Сумма задатка</td>
                <td>
                  <?= number_format($data_zb['zadatok'], 0, '.', ' '); ?> тг.
                </td>
              </tr>
              <?endif;?>
              <?if($data_zb['cena_pr']):?>
              <tr>
                <td></td>
                <td> Сумма продажи</td>
                <td>
                  <?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?> тг.
                </td>
              </tr>
              <tr>
                <td></td>
                <td> Прибыль</td>
                <td>
                  <?= number_format($data_zb['cena_pr'] - $data_zb['summa_vydachy'], 0, '.', ' '); ?> тг.
                </td>
              </tr>
              <?endif;?>
              <tr class="info">
                <td></td>
                <td> Статус товара</td>
                <td>
                  <h4><span class="label label-danger"><?= $data_st['name']; ?></span></h4>
                </td>
              </tr>
              <?if(($data_zb['data_pos']) OR ($data_zb['dateshop'])):?>
              <tr>
                <td></td>
                <td> Дата поступления на склад магазина</td>
                <td>
                  <?= $data_zb['data_pos']; ?>
                </td>
              </tr>
              <tr>
                <td></td>
                <td> Дата выставления на ветрину</td>
                <td>
                  <?= $data_zb['dateshop']; ?>
                </td>
              </tr>
              <tr>
                <td></td>
                <td> Дата продажи</td>
                <td>
                  <?= $data_zb['datesale']; ?>
                </td>
              </tr>
              <tr>
                <td></td>
                <td> Кто продал</td>
                <td>
                  <?= $data_zb['saler']; ?>
                </td>
              </tr>
              <?endif;?>
            </table>
            <br>
            <?if( ($data_zb['status'] == 7) OR ($data_zb['status'] == 10) OR ($data_zb['status'] == 14) OR ($data_zb['status'] == 15) OR ($data_zb['status'] == 5)):?>
            <form action="functions/add_sale.php" method="POST">
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group input-group-sm">
                  <input type="date" class="form-control" style="width: 16rem;" value="<?= $today; ?>" name="datesale">
                  <br>
                  <br>
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="input-group input-group-sm">
                  <input type="text" name="idx" hidden value="<?= $data_zb['id']; ?>">
                  <input type="number" class="form-control" value="<?= $data_zb['cena_pr']; ?>" name="cena_pr" placeholder="Введите сумму реализации">
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" name="go_sale" type="submit">Реализовать!</button>
                  </span>
                </div><!-- /input-group -->
              </div>
            </form>
            <?endif;?>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
        <? endif;?>
      </div><!-- /.col -->
      <!-- */*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*//**/ */ -->
      <?if(!empty($book['status'])):?>
      <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">№</th>
                  <th colspan="2" class="text-center">Общие сведения</th>
                </tr>
              </thead>
              <tbody>
                <tr class="success">
                  <td></td>
                  <td style="width:20rem;">Код товара</td>
                  <td>
                    Z<?= $book['id']; ?>
                  </td>
                </tr>
                <tr class="danger">
                  <td></td>
                  <td>Дата добавления в базу:</td>
                  <td>
                    <?= $book['dateadd']; ?>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td> Наименование товара</td>
                  <td>
                    <?= $book['category']; ?> <?= $book['name']; ?> <?= $book['message']; ?>
                  </td>
                </tr>
                <tr class="warning">
                  <td></td>
                  <td> Приход</td>
                  <td>
                    <?= number_format($book['purchaseamount'], 0, '.', ' '); ?> тг.
                  </td>
                </tr>
                <tr class="danger">
                  <td></td>
                  <td> Продажа</td>
                  <td>
                    <?= number_format($book['price'], 0, '.', ' '); ?> тг.
                  </td>
                </tr>
                <tr class="success">
                  <td></td>
                  <td> Количество товара</td>
                  <td>
                    <?= number_format($book['counttovar'], 0, '.', ' '); ?> шт.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <script>
        $('.table tbody tr').each(function(i) {
          var number = i + 1;
          $(this).find('td:first').text(number + ".");
        });
      </script>
      <div class="col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Форма релизации</h3>
          </div>
          <!-- /.box-header -->
          <form action="functions/add_sale.php" class="form-horizontal" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"> Дата</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" value="<?= $today; ?>" name="date_sale">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Количество</label>
                <div class="col-sm-10">
                  <input type="number" name="counttovar" class="form-control" value="1">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Цена за еденицу </label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="price" value="<?= $book['price']; ?>">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" name='go_shop' value="<?= $book['id']; ?>" class="btn btn-info pull-right">Реализовать</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <!-- DIRECT CHAT -->
        <div class="box box-warning direct-chat direct-chat-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Продажи данного товара</h3>
            <div class="box-tools pull-right">
              <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td>№</td>
                    <td>Регион</td>
                    <td>Товар</td>
                    <td>Когда продан</td>
                    <td>Сумма продажи</td>
                    <td>Количество</td>
                  </tr>
                </thead>
                <? $products = R::find('productreport','name=?',[$book['name']]); $i=1; ?>
                <tbody>
                  <?foreach($products as $product):?>
                  <tr <?if($product['salerstatus']==2){ echo 'class="info"' ;}?>>
                    <td><?= $i++; ?>.</td>
                    <td><?= $product['region']; ?> </td>
                    <td><?= $product['name']; ?> </td>
                    <td><?= date('d.m.Y H:i:s', strtotime($product['datereport'])); ?> </td>
                    <td><?= $product['price']; ?> </td>
                    <td><?= $product['counttovar']; ?> </td>
                  </tr>
                  <?endforeach;?>
                </tbody>
              </table>
            </div>
            <!--/.direct-chat-messages-->
            <!-- /.direct-chat-pane -->
          </div>
        </div>
        <!--/.direct-chat -->
      </div>
      <!-- /.col -->
    </div>
    <?endif;?>
</div><!-- /.row -->
</section>
</div> <!-- /.content-wrapper -->
<?include "footer.php"; ?>
<? endif; ?>