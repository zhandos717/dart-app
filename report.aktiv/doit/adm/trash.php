<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])):   //если сущесттвует пользователь
  $active_mag = 'active';
  if ($_SESSION['logged_user']->status == 3):
  include "header.php";
  include "menu.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Удаленные товары за <?= date('m.Y'); ?> г.
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
      <div class="col-xs-12">
        <div class="box ">
          <!-- collapsed-box -->
          <div class="box-header">
            <h4>2021 год</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class="info">
                    <th>№</th>
                    <th>код товара</th>
                    <th>ВЫРУЧКА</th>
                    <th>Приход.Сумма</th>
                    <th>ПРИБЫЛЬ</th>
                    <th>Продавец</th>
                    <th> Наименование</th>
                    <th>Дата продажи</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $i = 1;
                  $result = mysqli_query($connect, "SELECT codetovar from sales WHERE statustovar IS NOT NULL  GROUP BY codetovar  ");// COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,
                  while ($data2 = mysqli_fetch_array($result)) {
                    $codetovar = $data2['codetovar'];
                    $result58 = mysqli_query($connect, "SELECT * from sales WHERE codetovar = '$codetovar' AND NOT codetovar = '0' AND NOT codetovar = '0000' AND statustovar IS NOT NULL ");
                    while ($data1 = mysqli_fetch_array($result58)) {
                  ?>
                  <tr <?if($data1['statustovar']){?> class="danger"
                    <?}?> >
                    <td><?= $i++; ?>.</td>
                    <td><?= $data1['codetovar']; ?></td>
                    <td><?= number_format($data1['summareal'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['summaprihod'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['pribl'], 0, '.', ' '); ?></td>
                    <td><?= $data1['saler']; ?></td>
                    <td><?= $data1['tovarname']; ?></td>
                    <td><?= $data1['data']; ?></td>
                  </tr>
                  <?  }} ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->

      <div class="col-xs-12">
        <div class="box collapsed-box">
          <!-- collapsed-box -->
          <div class="box-header">
            <h4>Декабрь</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class="info">
                    <th>№</th>
                    <th>код товара</th>
                    <th>ВЫРУЧКА</th>
                    <th>Приход.Сумма</th>
                    <th>ПРИБЫЛЬ</th>
                    <th>Продавец</th>
                    <th> Наименование</th>
                    <th>Дата продажи</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $i = 1;
                  $result = mysqli_query($connect, "SELECT codetovar from sales12 WHERE statustovar IS NOT NULL  GROUP BY codetovar  ");// COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,
                  while ($data2 = mysqli_fetch_array($result)) {
                    $codetovar = $data2['codetovar'];
                    $result58 = mysqli_query($connect, "SELECT * from sales12 WHERE codetovar = '$codetovar' AND NOT codetovar = '0' AND NOT codetovar = '0000' AND statustovar IS NOT NULL ");
                    while ($data1 = mysqli_fetch_array($result58)) {
                  ?>
                  <tr <?if($data1['statustovar']){?> class="danger"
                    <?}?> >
                    <td><?= $i++; ?>.</td>
                    <td><?= $data1['codetovar']; ?></td>
                    <td><?= number_format($data1['summareal'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['summaprihod'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['pribl'], 0, '.', ' '); ?></td>
                    <td><?= $data1['saler']; ?></td>
                    <td><?= $data1['tovarname']; ?></td>
                    <td><?= $data1['data']; ?></td>
                  </tr>
                  <?  }} ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
      <!--*********************************************************************************************-->
      <div class="col-xs-12">
        <div class="box collapsed-box">
          <!-- collapsed-box -->
          <div class="box-header">
            <h4>Ноябрь</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class="info">
                    <th>№</th>
                    <th>код товара</th>
                    <th>ВЫРУЧКА</th>
                    <th>Приход.Сумма</th>
                    <th>ПРИБЫЛЬ</th>
                    <th>Продавец</th>
                    <th> Наименование</th>
                    <th>Дата продажи</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $i = 1;
                  $result = mysqli_query($connect, "SELECT codetovar from sales11 WHERE statustovar IS NOT NULL  GROUP BY codetovar  ");// COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,
                  while ($data2 = mysqli_fetch_array($result)) {
                    $codetovar = $data2['codetovar'];
                    $result58 = mysqli_query($connect, "SELECT * from sales11 WHERE codetovar = '$codetovar' AND NOT codetovar = '0' AND NOT codetovar = '0000' AND statustovar IS NOT NULL ");
                    while ($data1 = mysqli_fetch_array($result58)) {
                  ?>
                  <tr <?if($data1['statustovar']){?> class="danger"
                    <?}?> >
                    <td><?= $i++; ?>.</td>
                    <td><?= $data1['codetovar']; ?></td>
                    <td><?= number_format($data1['summareal'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['summaprihod'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['pribl'], 0, '.', ' '); ?></td>
                    <td><?= $data1['saler']; ?></td>
                    <td><?= $data1['tovarname']; ?></td>
                    <td><?= $data1['data']; ?></td>
                  </tr>
                  <? }} ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
      <!--*********************************************************************************************-->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<? include "footer.php"; ?>
<? endif; ?>
<? else :?>
<meta http-equiv='Refresh' content='0; URL=/report/'>
<? endif; ?>