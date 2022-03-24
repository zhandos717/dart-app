<? //проверка существовании сессии
$today = date('Y-m-d');
$adress = $_POST['adress'];
$kassa = $_POST['kassa'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$status = $_POST['status'];
if($_POST['date1'] AND $_POST['date2']){
$data1 = $_POST['date1'];
$date2 = $_POST['date2'];
} else {
$date1 = $today;
$date2 = $today;
};
if($adress != 'Все'){
$data = R::find('tickets',"status = 5 AND salerstatus =1 AND region = ? AND adressfil = ?  AND datesale BETWEEN '$date1' AND '$date2'",[$region,$adress ] );
$data1 = R::find('tickets',"status = 5 AND salerstatus =2 AND region = ? AND adressfil = ?  AND datesale BETWEEN '$date1' AND '$date2'",[$region,$adress ] );
$product = R::find('productreport',"salerstatus IS NULL AND region = :region   AND datereg BETWEEN :date AND :date1",[':date'=>$date1,':date1'=>$date2,':region'=>$region] );
$product1 = R::find('productreport',"salerstatus = 2 AND region = :region  AND datereg BETWEEN :date AND :date1",[':date'=>$date1,':date1'=>$date2,':region'=>$region] );
}
elseif( ($region != 'Все') AND ($adress == 'Все')){
$data = R::find('tickets',"status = 5 AND salerstatus =1 AND region = ? AND datesale BETWEEN '$date1' AND '$date2'",[$region] );
$data1 = R::find('tickets',"status = 5 AND salerstatus =2 AND region = ? AND datesale BETWEEN '$date1' AND '$date2'",[$region] );
$product = R::find('productreport',"salerstatus IS NULL AND region = :region  AND datereg BETWEEN :date AND :date1",[':date'=>$date1,':date1'=>$date2,':region'=>$region ] );
$product1 = R::find('productreport',"salerstatus = 2 AND region = :region AND datereg BETWEEN :date AND :date1",[':date'=>$date1,':date1'=>$date2,':region'=>$region ] );
}        
$comment = 'Сведения по реализованным товарам ' .$region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($date1)). ' по ' .date("d.m.Y", strtotime($date2));
$comment1 = 'Сведения по реализованным аксессуарам ' .$region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($date1)). ' по ' .date("d.m.Y", strtotime($date2));       

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Сведения по реализованным товарам
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
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Выберите период</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
            </div>
          </div>
          <div class="box-body">
            <form action="a_report.php?id=2" method="POST">
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?= $today; ?>" value="<?= $date1; ?>" name="date1">
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="input-group">
                  <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?= $today; ?>" value="<?= $date2; ?>" name="date2">
                </div>
                <!-- /input-group -->
              </div>
              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </span>
                  <select class="form-control" id="List1" name="region">
                    <option>Выберите регион</option>
                    <option><?= $region; ?></option>
                  </select>
                </div>
              </div>
              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </span>
                  <select class="form-control" id="List2" name="adress">

                    <option value="<?= $adress; ?>"><?= $adress; ?></option>

                  </select>
                </div>
              </div>
              <div class="input-group input-group-sm">
                <!-- <span class="input-group-btn">     </span> -->
                <button type="submit" class="btn-success btn ">Подтвердить!</button>
              </div>
            </form>
          </div>
          <!--.box-body -->
        </div>
        <!--.box -->
      </div>
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title text-center">
              <b> <?= $comment; ?> </b>
            </h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example0" class="tableas table table-hover table-bordered">
                <thead>
                  <tr class="info">
                    <th class="text-center">№</th>
                    <th class="text-center">Код товара</th>
                    <th class="text-center">Тип залогового имущества</th>
                    <th>Дата реализации</th>
                    <th class="text-center">Сумма реализации</th>
                    <th class="text-center">Сумма кредита</th>
                    <th class="text-center"> Доход от продажи</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="success">
                    <td></td>
                    <td></td>
                    <td class="text-center">Способ оплаты: <b> Наличный</b> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?
                  $i = 1;
                  foreach ($data as $data12) {
                  ?>
                  <tr>
                    <td><?= $i++; ?>.</td>
                    <td><?= $data12['nomerzb']; ?></td>
                    <td class="text-left">
                      <?= $data12['type']; ?>
                      <?= $data12['category']; ?>
                      <?= $data12['opisanie']; ?>
                      <?= $data12['tovarname']; ?>
                      <?= $data12['hdd']; ?>
                    </td>
                    <td><?= date("d.m.Y", strtotime($data12['datesale'])); ?></td>
                    <td class="success"> <?= number_format($data12['cena_pr'], 0, '.', ' '); ?>
                      <?  $cena_pr += $data12['cena_pr']; ?>
                    </td>
                    <td class="warning"> <?= number_format($data12['summa_vydachy'], 0, '.', ' '); ?>
                      <?  $summa_vydachy += $data12['summa_vydachy']; ?>
                    </td>
                    <td class="info"> <?= number_format($data12['cena_pr'] - $data12['summa_vydachy'], 0, '.', ' '); ?>
                      <?  $total += $data12['cena_pr'] - $data12['summa_vydachy']; ?>
                    </td>
                  </tr>
                  <?}?>
                  <tr class="success" style="white-space:nowrap;">
                    <th colspan="4" class="text-center"> ИТОГО по способу оплаты "Наличный"</th>
                    <td class="success"> <?= number_format($cena_pr, 0, '.', ' '); ?></td>
                    <td class="warning"> <?= number_format($summa_vydachy, 0, '.', ' '); ?></td>
                    <td class="info"> <?= number_format($total, 0, '.', ' '); ?></td>
                  </tr>
                  <tr class="danger">
                    <td></td>
                    <td></td>
                    <td class="text-center">Способ оплаты: <b> Безналичный</b> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?
                  $i = 1;
                  foreach ($data1 as $data12) {
                  ?>
                  <tr>
                    <td><?= $i++; ?>.</td>
                    <td><?= $data12['nomerzb']; ?></td>
                    <td class="text-left">
                      <?= $data12['type']; ?>
                      <?= $data12['category']; ?>
                      <?= $data12['opisanie']; ?>
                      <?= $data12['tovarname']; ?>
                      <?= $data12['hdd']; ?>
                    </td>
                    <td><?= date("d.m.Y", strtotime($data12['datesale'])); ?></td>
                    <td class="success"> <?= number_format($data12['cena_pr'], 0, '.', ' '); ?>
                      <?  $cena_pr1 += $data12['cena_pr']; ?>
                    </td>
                    <td class="warning"> <?= number_format($data12['summa_vydachy'], 0, '.', ' '); ?>
                      <?  $summa_vydachy1 += $data12['summa_vydachy']; ?>
                    </td>
                    <td class="info"> <?= number_format($data12['cena_pr'] - $data12['summa_vydachy'], 0, '.', ' '); ?>
                      <?  $total1 += $data12['cena_pr'] - $data12['summa_vydachy']; ?>
                    </td>
                  </tr>
                  <?}?>
                  <tr class="danger">
                    <th></th>
                    <th></th>
                    <th class="text-center"> ИТОГО по способу оплаты "Безналичный"</th>
                    <th></th>
                    <td class="success"> <?= number_format($cena_pr1, 0, '.', ' '); ?></td>
                    <td class="warning"> <?= number_format($summa_vydachy1, 0, '.', ' '); ?></td>
                    <td class="info"> <?= number_format($total1, 0, '.', ' '); ?></td>
                  </tr>
                </tbody>
                <tr class="info">
                  <th></th>
                  <th></th>
                  <th> ИТОГО:</th>
                  <th></th>
                  <td class="success"> <?= number_format($cena_pr1 + $cena_pr, 0, '.', ' '); ?></td>
                  <td class="warning"> <?= number_format($summa_vydachy + $summa_vydachy1, 0, '.', ' '); ?></td>
                  <td class="info"> <?= number_format($total + $total1, 0, '.', ' '); ?></td>
                </tr>
                <tfoot>
                </tfoot>
              </table>
            </div><!-- /.table-responsive -->
          </div><!-- /.box-body -->
        </div><!-- /.box box-primary -->
      </div><!-- /.col-md-6 -->
      <!-- /******************** */ -->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title text-center">
              <b> <?= $comment1; ?> </b>
            </h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example0" class="tableas table table-hover table-bordered">
                <thead>
                  <tr class="info">
                    <th class="text-center">№</th>
                    <th class="text-center">Код товара</th>
                    <th class="text-center">Тип залогового имущества</th>
                    <th>Дата реализации</th>
                    <th class="text-center">Сумма реализации</th>
                    <th class="text-center">Сумма кредита</th>
                    <th class="text-center"> Доход от продажи</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="success">
                    <td></td>
                    <td></td>
                    <td class="text-center">Способ оплаты: <b> Наличный</b> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?
                  $i = 1;
                  foreach ($product as $data14) {
                  ?>
                  <tr>
                    <td><?= $i++; ?>.</td>
                    <td>Z<?= $data14['id_product']; ?></td>
                    <td class="text-left">
                      <?= $data14['category']; ?>
                      <?= $data14['name']; ?>
                    </td>
                    <td><?= date("d.m.Y", strtotime($data14['datereg'])); ?></td>
                    <td class="success"> <?= number_format($data14['price'], 0, '.', ' '); ?>
                      <?  $cena_pr4 += $data14['price']; ?>
                    </td>
                    <td class="warning"> <?= number_format($data14['purchaseamount'], 0, '.', ' '); ?>
                      <?  $summa_vydachy4 += $data14['purchaseamount']; ?>
                    </td>
                    <td class="info"> <?= number_format($data14['price'] - $data14['purchaseamount'], 0, '.', ' '); ?>
                      <?  $total4 += $data14['price'] - $data14['purchaseamount']; ?>
                    </td>
                  </tr>
                  <?}?>
                  <tr class="success" style="white-space:nowrap;">
                    <th colspan="4" class="text-center"> ИТОГО по способу оплаты "Наличный"</th>
                    <td class="success"> <?= number_format($cena_pr4, 0, '.', ' '); ?></td>
                    <td class="warning"> <?= number_format($summa_vydachy4, 0, '.', ' '); ?></td>
                    <td class="info"> <?= number_format($total4, 0, '.', ' '); ?></td>
                  </tr>
                  <tr class="danger">
                    <td></td>
                    <td></td>
                    <td class="text-center">Способ оплаты: <b> Безналичный</b> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?
                  $i = 1;
                  foreach ($product1 as $data13) {
                  ?>
                  <tr>
                    <td><?= $i++; ?>.</td>
                    <td>Z<?= $data13['id_product']; ?></td>
                    <td class="text-left">
                      <?= $data13['category']; ?>
                      <?= $data13['name']; ?>
                    </td>
                    <td><?= date("d.m.Y", strtotime($data13['datereg'])); ?></td>
                    <td class="success"> <?= number_format($data13['price'], 0, '.', ' '); ?>
                      <?  $cena_pr13 += $data13['price']; ?>
                    </td>
                    <td class="warning"> <?= number_format($data13['purchaseamount'], 0, '.', ' '); ?>
                      <?  $summa_vydachy13 += $data13['purchaseamount']; ?>
                    </td>
                    <td class="info"> <?= number_format($data13['price'] - $data13['purchaseamount'], 0, '.', ' '); ?>
                      <?  $total13 += $data13['price'] - $data13['purchaseamount']; ?>
                    </td>
                  </tr>
                  <?}?>
                </tbody>
                <tfoot>
                  <tr class="danger">
                    <th></th>
                    <th></th>
                    <th class="text-center"> ИТОГО по способу оплаты "Безналичный"</th>
                    <th></th>
                    <td class="success"> <?= number_format($cena_pr13, 0, '.', ' '); ?></td>
                    <td class="warning"> <?= number_format($summa_vydachy13, 0, '.', ' '); ?></td>
                    <td class="info"> <?= number_format($total13, 0, '.', ' '); ?></td>
                  </tr>
                  <tr class="info">
                    <th></th>
                    <th></th>
                    <th> ИТОГО:</th>
                    <th></th>
                    <td class="success"> <?= number_format($cena_pr13 + $cena_pr4, 0, '.', ' '); ?></td>
                    <td class="warning"> <?= number_format($summa_vydachy13 + $summa_vydachy4, 0, '.', ' '); ?></td>
                    <td class="info"> <?= number_format($total13 + $total4, 0, '.', ' '); ?></td>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.table-responsive -->
          </div><!-- /.box-body -->
        </div><!-- /.box box-primary -->
      </div><!-- /.col-md-6 -->
      <!-- /************ */ -->
    </div><!-- /.content-wrapper -->
  </section>
</div>
<!--.col-md-12 -->