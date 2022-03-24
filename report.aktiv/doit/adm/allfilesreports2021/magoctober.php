<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])):   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3):
    $active_mag = 'active';

    $result22 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summaprihod), SUM(pribl), SUM(summazaden) from sales10  ");
    $data22 = mysqli_fetch_array($result22);
    $aukminus = $data22['SUM(summareal)'] - $data22['SUM(summazaden)'];
?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет МАГАЗИНОВ за Октябрь <?=date('Y');?> г.
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
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= number_format($data22['SUM(summareal)'], 0, '.', ' '); ?> тг</h3>
                <p>ВЫРУЧКА</p>
              </div>
              <div class="icon">
                <i class="fa fa-cart-plus"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= number_format($data22['SUM(summaprihod)'], 0, '.', ' '); ?> тг</h3>
                <p>Приход.Сумма</p>
              </div>
              <div class="icon">
                <i class="fa fa-level-down"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= number_format($data22['SUM(pribl)'], 0, '.', ' '); ?> тг</h3>
                <p>ПРИБЫЛЬ</p>
              </div>
              <div class="icon">
                <i class="fa fa-usd"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?= number_format($aukminus, 0, '.', ' '); ?> тг</h3>
                <p>АУКЦИОНИСТ +-</p>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->
        <!--  -->
        <div class="row">
        <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-body">
              <a href="test.php" class="btn btn-block btn-social btn-success">
                    <i class="fa fa-bank"></i> Данные по регионам
            </a>
          </div>
        </div>
        </div>

          <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
              <h4>Общие данные </h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th rowspan="2" style="width: 10px">id</th>
                        <th rowspan="2">МАГАЗИНЫ</th>
                        <th rowspan="2">ВЫРУЧКА</th>
                        <th rowspan="2">Приход.Сумма</th>
                        <th rowspan="2">ПРИБЫЛЬ</th>
                        <th rowspan="2">Количество <br> проданных товаров</th>
                        <th rowspan="2">ПРИБЫЛЬ %</th>
                        <!-- <th>АУКЦИОНИСТ +/-</th> -->
                        <th colspan="3" class="text-center">ПЛАН</th>
                      </tr>
                      <tr class="info">
                        <th class="text-center">За месяц</th>
                        <th class="text-center">В день</th>
                        <th class="text-center">%</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT COUNT(*), region, adress, SUM(summareal), SUM(summaprihod), SUM(pribl)
                      FROM sales10  GROUP BY adress "); // COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,
                      $sc = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $sc = $sc + $data1['COUNT(*)'];
                        $region = $data1['region'];
                        $adress = $data1['adress'];
                        $resultpl = mysqli_query($connect, "SELECT * FROM magplan WHERE region ='$region' AND adress = '$adress' AND month = '10' ");
                        $datapl = mysqli_fetch_array($resultpl);

                        $procent = ($data1['SUM(pribl)']*100)/$datapl['plan'];

                        $summaplanvden = 0; $summaprocent = 0; $kolvozap = 0; $q = 0;
                        $planden = $datapl['plan']/31;    //еждневный план = Ежемесячный план деленная на 31 дней

                        $planden1 = $planden*31;

                        $procent2 = $data1['SUM(pribl)'] - $planden1;

                        $procent = ($procent2*100)/$planden1;


                          // +- на сколько отстает от плана или перевыполняет?>
                        <tr>
                          <td><i class="fa fa-shopping-cart"></i></td>
                          <td><a href="viewshop10.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=1"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
                          <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></td>
                          <td><?= $data1['COUNT(*)']; ?></td>
                          <td><em><b><?= number_format(($data1['SUM(pribl)']*100)/$data1['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></td>
                          <td class="text-center"><?= number_format($datapl['plan'], 0, '.', ' ');?></td>
                          <td class="text-center"><?= number_format($planden, 0, '.', ' '); ?></td>
                          <td class="text-center">
                            <?if($procent > 0)
                              {?>
                                <a title="<?=number_format(round($data1['SUM(pribl)']), 0, '.', ' ');?>-<?=number_format(round($planden1), 0, '.', ' ')?>=<?=number_format(round($procent2), 0, '.', ' ')?>" class="description-percentage text-green">
                                  <i class="fa fa-caret-up"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                                <?}elseif($procent < 0) {?>
                                  <a title="<?=number_format(round($data1['SUM(pribl)']), 0, '.', ' ');?>-<?=number_format(round($planden1), 0, '.', ' ')?>=<?=number_format(round($procent2), 0, '.', ' ')?>" class="description-percentage text-danger">
                                    <i class="fa fa-caret-down"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                                <?};?>
                          </td>
                        </tr>
                      <? } ?>
                    </tbody>
                    <tfoot>
                      <?
                      $result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summaprihod), SUM(pribl), SUM(summazaden) from sales10  ");
                      $data2 = mysqli_fetch_array($result2);
                      $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];

                      $resultplan = mysqli_query($connect, "SELECT SUM(plan) FROM magplan WHERE month = '10' ");
                      $dataplan = mysqli_fetch_array($resultplan);
                      $planden = $dataplan['SUM(plan)']/31;    //еждневный план = Ежемесячный план деленная на 31 дне

                      $planden1 = $planden*31;

                      $procent2 = $data2['SUM(pribl)'] - $planden1;

                      $procent = ($procent2*100)/$planden1;
                      ?>
                      <tr style="background: #d3d7df; color: black;">
                        <th></th>
                        <th>Итого (СУММА)</th>
                        <th><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></th>
                        <th><?= $sc; ?></th>
                        <th><em><b><?= number_format(($data2['SUM(pribl)']*100)/$data2['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></th>
                        <!-- <th style="background: #de4936; color: white;"><strong><?= number_format($aukminus, 0, '.', ' '); ?></strong></th> -->
                        <th class="text-center"><?=number_format($dataplan['SUM(plan)'], 0, '.', ' ');?> тг.</th>
                        <th class="text-center"><?= number_format($planden, 0, '.', ' '); ?></th>
                        <th class="text-center">

                          <?if($procent > 0)
                            {?>
                              <a title="<?=number_format(round($data2['SUM(pribl)']), 0, '.', ' ');?>-<?=number_format(round($planden1), 0, '.', ' ')?>=<?=number_format(round($procent2), 0, '.', ' ')?>" class="description-percentage text-green">
                                <i class="fa fa-caret-up"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                              <?}elseif($procent < 0) {?>
                                <a title="<?=number_format(round($data2['SUM(pribl)']), 0, '.', ' ');?>-<?=number_format(round($planden1), 0, '.', ' ')?>=<?=number_format(round($procent2), 0, '.', ' ')?>" class="description-percentage text-danger">
                                  <i class="fa fa-caret-down"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                              <?};?>

                        </th>
                      </tr>
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

                        <div class="box-header">
                        <h4>Ломбард магазин</h4>
                        <div class="box-tools pull-right">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                           <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                         </div>
                        </div>
                        <div class="box-body">
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr style="background: #398ebd; color: white;">
                                  <th style="width: 10px">id</th>
                                  <th>МАГАЗИНЫ</th>
                                  <th>ВЫРУЧКА</th>
                                  <th>Приход.Сумма</th>
                                  <th>ПРИБЫЛЬ</th>
                                  <th>Количество <br /> проданных<br />товаров</p></th>
                                  <th>ПРИБЫЛЬ %</th>
                                  <!-- <th>АУКЦИОНИСТ +/-</th> -->
                                </tr>
                              </thead>
                              <tbody>
                                <?
                                $result = mysqli_query($connect, "SELECT COUNT(*), region, adress, SUM(summareal), SUM(summaprihod), SUM(pribl) from sales10 WHERE fromtovar = 1  GROUP BY adress ");// COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,
                                $sc = 0;
                                while ($data1 = mysqli_fetch_array($result)) {
                                  $sc = $sc + $data1['COUNT(*)'];
                                ?>
                                  <tr>
                                    <td><i class="fa fa-shopping-cart"></i></td>
                                    <td><a href="viewshop10.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=2"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
                                    <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></td>
                                    <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></td>
                                    <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></td>
                                    <td><?= $data1['COUNT(*)']; ?></td>
                                    <td><em><b><?= number_format(($data1['SUM(pribl)']*100)/$data1['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></td>
                                    <!-- <td></td> -->
                                  </tr>
                                <? } ?>
                              </tbody>
                              <tfoot>
                                <?$result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summaprihod), SUM(pribl), SUM(summazaden) from sales10 WHERE fromtovar = 1  ");
                                  $data22 = mysqli_fetch_array($result2);
                                  $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];
                                ?>
                                <tr style="background: #d3d7df; color: black;">
                                  <th></th>
                                  <th>Итого (СУММА)</th>
                                  <th><?= number_format($data22['SUM(summareal)'], 0, '.', ' '); ?></th>
                                  <th><?= number_format($data22['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                                  <th><?= number_format($data22['SUM(pribl)'], 0, '.', ' '); ?></th>
                                  <th><?= $sc; ?></th>
                                  <th><em><b><?= number_format(($data2['SUM(pribl)']*100)/$data2['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></th>
                                  <!-- <th style="background: #de4936; color: white;"><strong><?= number_format($aukminus, 0, '.', ' '); ?></strong></th> -->
                                </tr>
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
              <div class="box-header">
              <h4>Комисионный магазин</h4>
              <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                 <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
               </div>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th style="width: 10px">id</th>
                        <th>МАГАЗИНЫ</th>
                        <th>ВЫРУЧКА</th>
                        <th>Приход.Сумма</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Количество <br /> проданных<br />товаров</p></th>
                        <th>ПРИБЫЛЬ %</th>
                        <!-- <th>АУКЦИОНИСТ +/-</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT COUNT(*), region, adress, SUM(summareal), SUM(summaprihod), SUM(pribl) from sales10 WHERE fromtovar = 2  GROUP BY adress ");// COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,
                      $sc = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $sc = $sc + $data1['COUNT(*)'];
                      ?>
                        <tr>
                          <td><i class="fa fa-shopping-cart"></i></td>
                          <td><a href="viewshop10.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=2"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
                          <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></td>
                          <td><?= $data1['COUNT(*)']; ?></td>
                          <td><em><b><?= number_format(($data1['SUM(pribl)']*100)/$data1['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></td>
                              <!-- <td></td> -->
                        </tr>
                      <? } ?>
                    </tbody>
                    <tfoot>
                      <?$result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summaprihod), SUM(pribl), SUM(summazaden) from sales10 WHERE fromtovar = 2  ");
                        $data22 = mysqli_fetch_array($result2);
                        $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];
                      ?>
                      <tr style="background: #d3d7df; color: black;">
                        <th></th>
                        <th>Итого (СУММА)</th>
                        <th><?= number_format($data22['SUM(summareal)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data22['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data22['SUM(pribl)'], 0, '.', ' '); ?></th>
                        <th><?= $sc; ?></th>
                        <th><em><b><?= number_format(($data2['SUM(pribl)']*100)/$data2['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></th>
                        <!-- <th style="background: #de4936; color: white;"><strong><?= number_format($aukminus, 0, '.', ' '); ?></strong></th> -->
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer clearfix">
              </div>
            </div><!-- /.box -->
          </div><!-- /.col -->


          <div class='col-xs-12'>
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Таблица эфективности продавцов</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                <table class="table table-bordered table-hover" id="datatable-tabletools" >
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Регион</th>
                      <th>Магазин</th>
                      <th>Сотрудник</th>
                      <th class="info">Выручка</th>
                      <th class="success">Прибыль</th>
                    </tr>
                  </thead>
                      <tbody>
                      <?
                $result = mysqli_query($connect, "SELECT saler, region,adress , SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                from sales10  GROUP BY saler  ");
                $i = 1;
                while($data1 = mysqli_fetch_array($result)){
                  ?>
                    <tr>
                      <td><?=$i++?>.</td>
                      <td> <?= $data1['region']; ?> </td>
                      <td> <?= $data1['adress']; ?> </td>
                      <td >
                        <?=$data1['saler'];?>
                      </td>
                      <td class="info">
                      <?=number_format($data1['SUM(summaprihod)'], 0, '.', ' ');?>
                      </td>
                      <td class="success">
                      <?=number_format($data1['SUM(pribl)'], 0, '.', ' ');?>
                      </td>
                    </tr>
                    <?}?>
                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </div>
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <? include "footer.php"; ?>
    <?php endif; ?>
<? else :?>
  <meta http-equiv='Refresh' content='0; URL=/report/'>
<?php endif; ?>
