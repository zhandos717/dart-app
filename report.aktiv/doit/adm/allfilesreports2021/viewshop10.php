<? //проверка существовании сессии
include("../../../bd.php");
$region = $_GET['region'];
$shop = $_GET['shop'];
$fromtovar = $_GET['from'];
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
          Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за Октябрь 2020
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php"><?= $region; ?></a></li>
          <li class="active"><?= $shop; ?></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
             <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title">Фильтрация</h3>
                   <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                   </div>
                 </div>
                 <div class="box-body">
                   <div class="row">
                   <form action="filtr_shop10.php" method="POST">
                     <input type="text" name="regionshop" value="<?=$region;?>" hidden>
                     <input type="text" name="shopadres" value="<?=$shop;?>" hidden>
                     <input type="text" name="fromtovar" value="<?=$fromtovar;?>" hidden>
                     <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <!-- <input type="date" class="form-control" style="width: 16rem;" value="<?=$data1;?>" name="date1" required> -->
                              <input type="date" class="form-control" style="width: 16rem;"  name="date1" min="2020-10-01" max="2020-10-31" required>
                        </div>
                        <!-- /input-group -->
                     </div>
                      <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <!-- <input type="date" class="form-control" style="width: 16rem;" value="<?=$data2;?>" name="date2"> -->
                              <input type="date" class="form-control" style="width: 16rem;" name="date2" min="2020-10-01" max="2020-10-31">
                        </div>
                        <!-- /input-group -->
                     </div>
                                       <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-bank"></i>
                                               </span>
                                               <select name="saler" class="form-control" required>
                                                 <option value="">Выберите продавца</option>
                                                   <?
                               // $result = mysqli_query($connect, "SELECT *FROM saler WHERE region = '$region' AND shop = '$shop'");
                               $result = mysqli_query($connect, "SELECT *FROM sales10 WHERE region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar' GROUP BY saler");
                               while ($data = mysqli_fetch_array($result)) { ?>
                                                   <option value="<?= $data['saler']; ?>"><?= $data['saler']; ?></option>
                                                   <? } ?>
                                               </select>
                                         </div>
                                       </div>
                                       <!-- <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-building"></i>
                                               </span>
                                               <select name="vid" class="form-control" required>
                                                   <option value="">Выберите вид оплаты</option>
                                                   <option value="наличные">Наличные</option>
                                                   <option value="безналичные">Безналичные</option>
                                                   <option value="смешанные">Смешанные</option>
                                                   <option value="Каспий банк">Каспий банк</option>
                                                   <option value="Альфа банк">Альфа банк</option>
                                                   <option value="Нурбанк">Нурбанк</option>
                                                   <option value="иные переводы">Иные переводы</option>
                                               </select>
                                         </div>
                                       </div> -->
                                       <div class="input-group input-group-sm">
                                           <span class="input-group-btn">
                                             <button type="submit" class="btn btn-info btn-flat">Фильтровать</button>
                                           </span>
                                     </div>
                                     </form>
                                 </div><!-- /.row -->
                      </div><!--.box-body -->
                   </div> <!--.box -->
                 </div> <!--.col-md-12 -->
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"> <i class="fa fa-cart-plus"></i> Ломбард
                </h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
              </div>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <?
                  $result = mysqli_query($connect, " SELECT * FROM magazin WHERE region = '$region' AND adress ='$shop' ");
                  $data = mysqli_fetch_array($result);
                  ?>
<!--
                  <form action="functions/rplanmag.php" method="post">
                    <font color="red">Ежемесячный план магазина <?=$region;?>/<?=$shop;?>: </font><input type="number" name="plan" value="<?=$data['plan'];?>">
                    <input type="text" name="region" value="<?=$region;?>" hidden="hidden">
                    <input type="text" name="adress" value="<?=$shop;?>" hidden="hidden">
                    <input type="submit" name="do_signup" value="Сохранить">
                  </form> -->
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th>ДАТА</th>
                        <th>ВЫРУЧКА</th>
                        <th>Приход <br /> Сумма</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Кол/во <br />проданных<br />товаров</p>
                        </th>
                        <!-- <th>АУКЦИОНИСТ +/-</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT data, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                                        from sales10  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '1' GROUP BY data ");
                    while ($data1 = mysqli_fetch_array($result)) {
                      ?>
                        <tr>
                          <td><a href="detail10.php?region=<?= $region; ?>&shop=<?= $shop; ?>&data_z=<?= $data1['data']; ?>&from=1"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
                          <th><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></th>
                          <th><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                          <th><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></th>
                          <th><?= $data1['COUNT(*)']; ?></th>
                        </tr>
                      <? } ?>
                    </tbody>
                    <tfoot>
                      <tr style="background: #398ebd; color: white;">
                        <?
                        $result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summazaden), SUM(pribl), SUM(summaprihod), COUNT(*)
                                        from sales10  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '1' ");
                        $data2 = mysqli_fetch_array($result2);
                        $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];
                        ?>
                        <th><strong>ИТОГО </strong></th>
                        <th><strong><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></strong></th>
                        <th><strong><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></strong></th>
                        <th><strong><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></strong></th>
                        <th><strong><?= number_format($data2['COUNT(*)'], 0, '.', ' '); ?></strong></th>
                        <!-- <th><?= $sc; ?></th> -->
                        <!-- <th style="background: #00a759; color: white;"><strong><?= number_format($aukminus, 0, '.', ' '); ?></strong></th> -->
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"> <i class="fa fa-tags"></i> Комиссионный магазин
                </h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
              </div>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <?
                  $result = mysqli_query($connect, " SELECT * FROM magazin WHERE region = '$region' AND adress ='$shop' ");
                  $data = mysqli_fetch_array($result);
                  ?>
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr class="info">
                        <th>ДАТА</th>
                        <th>ВЫРУЧКА</th>
                        <th>Приход  Сумма</th>
                        <th>ПРИБЫЛЬ</th>
                        <th> Кол/во проданных товаров</th>
                        <th>АУКЦИОНИСТ +/-</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT data, SUM(summareal), SUM(summazaden), SUM(pribl),SUM(summaprihod), COUNT(*)
                                        from sales10  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '2' GROUP BY data ");
                      $sc = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $sc = $sc + $data1['COUNT(*)'];
                      ?>
                        <tr>
                          <td><a href="detail10.php?region=<?= $region; ?>&shop=<?= $shop; ?>&data_z=<?= $data1['data']; ?>&from=2"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
                          <th><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></th>
                          <th><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                          <th><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></th>
                          <th><?= $data1['COUNT(*)']; ?></th>
                        </tr>
                      <? } ?>
                    </tbody>
                    <tfoot>
                      <tr style="background: #398ebd; color: white;">
                        <?
                        $result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summazaden), SUM(pribl),SUM(summaprihod)
                                        from sales10  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '2' ");
                        $data2 = mysqli_fetch_array($result2);
                        $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];
                        ?>
                        <th><strong>ИТОГО </strong></th>
                        <th><strong><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></strong></th>
                        <th><strong><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></strong></th>
                        <th><strong><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></strong></th>
                        <th><?= $sc; ?></th>
                        <th style="background: #00a759; color: white;"><strong><?= number_format($aukminus, 0, '.', ' '); ?></strong></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"> <i class="fa fa-building"></i> Отчет по филиально
                </h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
              </div>
              </div>
              <div class="box-body">
                <div class="">
                  <table class="table table-bordered table-hover" id="datatable-tabletools" >
                    <thead >
                      <tr >
                        <th class="info">Регион</th>
                        <th class="info">Филиал</th>
                        <th class="warning">Приход</th>
                        <th class="success">ВЫРУЧКА</th>
                        <th class="info">ПРИБЫЛЬ</th>
                        <th class="info">Кл.</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT regionlombard, adresslombard, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                                        from sales10  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '1' GROUP BY adresslombard  ");
                      while ($data1 = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                          <td><?= $data1['regionlombard']; ?></td>
                          <td><?= $data1['adresslombard']; ?></td>
                          <th class="warning"><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                          <th class="success"><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></th>
                          <th class="info"><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></th>
                          <th><?= $data1['COUNT(*)']; ?></th>
                        </tr>
                      <? } ?>
                    </tbody>
                    <tfoot>
                      <tr class="danger">
                        <?
                        $result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summazaden), SUM(pribl), SUM(summaprihod), COUNT(*)
                                        from sales10  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '1' ");
                        $data2 = mysqli_fetch_array($result2);
                        $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];
                        ?>
                        <th colspan="2">ИТОГО</th>
                        <th><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['COUNT(*)'], 0, '.', ' '); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->

          <!-- <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">График доли от прибыли</h3>
            </div>
            <!-- /.box-header -
            <div class="box-body text-center">
              <!-- <p>By adding the class <code>.vertical</code> and <code>.progress-sm</code>, <code>.progress-xs</code> or
                <code>.progress-xxs</code> we achieve:</p> -
                <?
                $result = mysqli_query($connect, "SELECT regionlombard, adresslombard, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                from sales10  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '1' GROUP BY adresslombard  ");

                while($data1 = mysqli_fetch_array($result)){
                  $procent = round(($data1['SUM(pribl)']*100)/$data2['SUM(pribl)']);
                  // $procent = ($data1['SUM(pribl)']*100)/$datapl['plan'];

                  $arr=['success','danger','warning','info','primary'];

                  ?>
                <div class="progress">
                <div class="progress-bar progress-bar-<?=$arr[rand(1,5)]?> progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?=$procent;?>%">
                  <span class="sr-only"><?=$procent;?>% Complete (success)</span>
                </div>
              </div>
              <p><b><?=$procent;?> %</b> <?= $data1['regionlombard']; ?>: <?= $data1['adresslombard']; ?>  </p>
                <?}?>
          </div>
          <!-- /.box --
        </div>
        </div> -->

        <div class='col-xs-6'>
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">График доли от прибыли</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                <table class="table table-condensed">
                <tr>
                      <th style="width: 10px">#</th>
                      <th>Филиал</th>
                      <th>Прогресс</th>
                      <th style="width: 40px">Процент</th>
                    </tr>
                <?
                $result = mysqli_query($connect, "SELECT regionlombard, adresslombard, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                from sales10  WHERE region = '$region' AND adress = '$shop' GROUP BY adresslombard  ");
                $i = 1;
                while($data1 = mysqli_fetch_array($result)){
                  $procent = round(($data1['SUM(pribl)']*100)/$data2['SUM(pribl)']);
                  // $procent = ($data1['SUM(pribl)']*100)/$datapl['plan'];
                //  $arr=['success','danger','warning','info','primary','yellow'];
                  if ($procent >20) {
                    $color = 'success';
                    $color1 = 'green';
                  } elseif($procent >10) {
                    $color = 'info';
                    $color1 = 'blue';

                  }elseif($procent >5) {
                    $color = 'warning';
                    $color1 = 'yellow';
                  }else{
                    $color = 'danger';
                    $color1 = 'red';
                  }
                  ?>
                    <tr>
                      <td><?=$i++?>.</td>
                      <td> <?= $data1['regionlombard']; ?>: <?= $data1['adresslombard']; ?></td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-<?=$color;?>" style="width: <?=$procent;?>%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-<?=$color1;?>"><?=$procent;?>% </span></td>
                    </tr>
                    <?}?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </div>
        <div class='col-xs-6'>
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">График доли от прибыли</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                <table class="table table-condensed">
                <tr>
                      <th style="width: 10px">#</th>
                      <th>Филиал</th>
                      <th>Прогресс</th>
                      <th style="width: 40px">Процент</th>
                    </tr>
                <?
                $result = mysqli_query($connect, "SELECT saler, regionlombard, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                from sales10  WHERE region = '$region' AND adress = '$shop'  GROUP BY saler  ");
                $i = 1;
                while($data1 = mysqli_fetch_array($result)){
                  $procent = round(($data1['SUM(pribl)']*100)/$data2['SUM(pribl)']);
                  // $procent = ($data1['SUM(pribl)']*100)/$datapl['plan'];
                //  $arr=['success','danger','warning','info','primary','yellow'];
                  if ($procent >20) {
                    $color = 'success';
                    $color1 = 'green';
                  } elseif($procent >10) {
                    $color = 'info';
                    $color1 = 'blue';

                  }elseif($procent >5) {
                    $color = 'warning';
                    $color1 = 'yellow';
                  }else{
                    $color = 'danger';
                    $color1 = 'red';
                  }
                  ?>
                    <tr>
                      <td><?=$i++?>.</td>
                      <td >

                        <?= $data1['saler']; ?> <br>
                        Прибыль: <?=number_format($data1['SUM(pribl)'], 0, '.', ' ');?> тг.
                      </td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-<?=$color;?>" style="width: <?=$procent;?>%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-<?=$color1;?>"><?=$procent;?>% </span></td>
                    </tr>


                    <?}?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </div>
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <? include "footer.php"; ?>
  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>
  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь
<?php endif; ?>
