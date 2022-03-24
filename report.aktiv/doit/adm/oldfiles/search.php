<?
include("../../bd.php");
if ($status == 3) :

  $region = $_GET['region'];
  $shop = $_GET['shop'];
  $codetovar = $_GET['codetovar'];
  $active_mag = 'active';

include "header.php"; 
include "menu.php"; 
$result = R::findAll('sales', 'ORDER BY id DESC LIMIT 50');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
    </ol>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Поиск товаров</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <div class="box-body">

            <input type="text" class="form-control" placeholder="Поиск..." name="search" />
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Продажи </h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <div class="box-body answer">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="info">
                  <th>№</th>
                  <th>ДАТА</th>
                  <th>Код товара</th>
                  <th>Адрес филиала</th>
                  <th>ТОВАР</th>
                  <th>Приход</th>
                  <th>Предоплата</th>
                  <th>Продажа</th>
                  <th>ПРИБЫЛЬ</th>
                  <th>Вид</th>
                  <th>Продавец</th>
                  <th>Покупатель</th>
                </tr>
              </thead>
              <?$i= 1;
              foreach ($result as $data) {?>
              <tr <?if($data['statustovar']==3){echo'class="danger"';}; ?>>
                  <td><?= $i++; ?>.</td>
                  <td><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                  <td> <?= $data['codetovar']; ?></td>
                  <td>
                  <?= $data['regionlombard'] . '/' . $data['adresslombard']; ?>
                  </td>
                <td><?= $data['tovarname']; ?></td>
                <td class="warning"><?= number_format($data['summaprihod'], 0, '.', ' ');
                                    $summaprihod += $data['summaprihod']; ?></td>
                <td><?= number_format($data['predoplata'], 0, '.', ' ');
                    $predoplata += $data['predoplata']; ?></td>
                <td class="danger"><?= number_format($data['summareal'], 0, '.', ' ');
                                    $summareal += $data['summareal']; ?></td>
                <td class="success"><?= number_format($data['pribl'], 0, '.', ' ');
                                    $pribl += $data['pribl']; ?></td>
                <td><?= $data['vid']; ?></td>
                <td><?= $data['saler']; ?></td>
                <td><?= $data['pokupatel']; ?></td>
              </tr>
              <?}?>
            </table>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
      <script>
            $('[name=search]')
            .keyup( function(){
                var data=$(this).val();
                $.post('functions/search.php',{search:data})
                .done(function(data) { 
                      $('.answer').html(data); })
                .fail(function(data) { alert('Ошибка отправки'+data) }) }); 
            </script>
          </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<? include "footer.php"; 
else :
header('Location: /index.php'); 
endif; ?>