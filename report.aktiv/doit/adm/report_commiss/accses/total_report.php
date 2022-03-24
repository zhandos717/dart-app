    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Отчет по аксессуарам
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

            <div class="col-xs-6">
                <div class="box ">
                    <!-- collapsed-box -->
                    <div class="box-header">
                        <h4> <a class="btn  bg-olive">Февраль 2021</a> <i data-widget="collapse" class="btn bg-red fa fa-tag"></i> </h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="danger">
                                        <th>МАГАЗИНЫ</th>
                                        <th>Количество</th>
                                        <th>Приход</th>
                                        <th>ВЫРУЧКА</th>
                                        <th>ПРИБЫЛЬ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <? 
                  $products = R::getAll("SELECT region, SUM(purchaseamount),SUM(price),COUNT(*) as count  FROM productreport WHERE datereg BETWEEN  '2021-02-01' AND  '2021-02-28'  GROUP BY region");
                  foreach($products as $product):?>
                                    <tr>
                                        <th> <button value="<?= $product['region'] ?> " id="region_report" class="btn bg-olive btn-block"> <?= $product['region'] ?> </button> </th>
                                        <th>
                                            <? echo number_format($product['count'], 0, '.', ' '); 
                          $count += $product['count'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $purchaseamount += $product['SUM(purchaseamount)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'], 0, '.', ' '); 
                          $price += $product['SUM(price)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'] - $product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $totalDecember += $product['SUM(price)'] - $product['SUM(purchaseamount)'];?>
                                        </th>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr class="info">
                                        <th>Итого (СУММА)</th>
                                        <th><?= number_format($count, 0, '.', ' '); ?></th>
                                        <th><?= number_format($purchaseamount, 0, '.', ' '); ?></th>
                                        <th><?= number_format($price, 0, '.', ' '); ?></th>
                                        <th><?= number_format($totalDecember, 0, '.', ' '); ?></th>
                                        <?unset($price2,$price,$purchaseamount,$count);?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->


            <div class="col-xs-6">
                <div class="box ">
                    <!-- collapsed-box -->
                    <div class="box-header">
                        <h4> <a class="btn  bg-olive">Январь 2021</a> <i data-widget="collapse" class="btn bg-red fa fa-tag"></i> </h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="danger">
                                        <th>МАГАЗИНЫ</th>
                                        <th>Количество</th>
                                        <th>Приход</th>
                                        <th>ВЫРУЧКА</th>
                                        <th>ПРИБЫЛЬ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <? 
                  $products = R::getAll("SELECT region, SUM(purchaseamount),SUM(price),COUNT(*) as count  FROM productreport WHERE datereg BETWEEN  '2021-01-01' AND  '2021-01-31'  GROUP BY region");
                  foreach($products as $product):?>
                                    <tr>
                                        <th> <button value="<?= $product['region'] ?> " id="region_report" class="btn bg-olive btn-block"> <?= $product['region'] ?> </button> </th>
                                        <th>
                                            <? echo number_format($product['count'], 0, '.', ' '); 
                          $count += $product['count'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $purchaseamount += $product['SUM(purchaseamount)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'], 0, '.', ' '); 
                          $price += $product['SUM(price)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'] - $product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $totalDecember += $product['SUM(price)'] - $product['SUM(purchaseamount)'];?>
                                        </th>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr class="info">
                                        <th>Итого (СУММА)</th>
                                        <th><?= number_format($count, 0, '.', ' '); ?></th>
                                        <th><?= number_format($purchaseamount, 0, '.', ' '); ?></th>
                                        <th><?= number_format($price, 0, '.', ' '); ?></th>
                                        <th><?= number_format($totalDecember, 0, '.', ' '); ?></th>
                                        <?unset($price2,$price,$purchaseamount,$count);?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-xs-6">
                <div class="box ">
                    <!-- collapsed-box -->
                    <div class="box-header">
                        <h4> <a class="btn  bg-olive">Декабрь</a> <i data-widget="collapse" class="btn bg-red fa fa-tag"></i> </h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="danger">
                                        <th>МАГАЗИНЫ</th>
                                        <th>Количество</th>
                                        <th>Приход</th>
                                        <th>ВЫРУЧКА</th>
                                        <th>ПРИБЫЛЬ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <? 
                  $products = R::getAll("SELECT region, SUM(purchaseamount),SUM(price),COUNT(*) as count  FROM productreport WHERE datereg BETWEEN  '2020-12-01' AND  '2020-12-31'  GROUP BY region");
                  foreach($products as $product):?>
                                    <tr>
                                        <th> <button value="<?= $product['region'] ?> " id="region_report" class="btn bg-olive btn-block"> <?= $product['region'] ?> </button> </th>
                                        <th>
                                            <? echo number_format($product['count'], 0, '.', ' '); 
                          $count += $product['count'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $purchaseamount += $product['SUM(purchaseamount)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'], 0, '.', ' '); 
                          $price += $product['SUM(price)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'] - $product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $totalDecember += $product['SUM(price)'] - $product['SUM(purchaseamount)'];?>
                                        </th>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr class="info">
                                        <th>Итого (СУММА)</th>
                                        <th><?= number_format($count, 0, '.', ' '); ?></th>
                                        <th><?= number_format($purchaseamount, 0, '.', ' '); ?></th>
                                        <th><?= number_format($price, 0, '.', ' '); ?></th>
                                        <th><?= number_format($totalDecember, 0, '.', ' '); ?></th>
                                        <?unset($price2,$price,$purchaseamount,$count);?>
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



            <div class="col-xs-6">
                <div class="box">
                    <!-- collapsed-box -->
                    <div class="box-header">
                        <h4> <a class="btn  bg-olive">Ноябрь</a> <i data-widget="collapse" class="btn bg-red fa fa-tag"></i> </h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="danger">
                                        <th>МАГАЗИНЫ</th>
                                        <th>Приход</th>
                                        <th>ВЫРУЧКА</th>
                                        <th>ПРИБЫЛЬ</th>
                                        <th>Количество</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? 
                  $products = R::getAll("SELECT region, SUM(purchaseamount),SUM(price),COUNT(*) as count  FROM productreport WHERE datereg BETWEEN  '2020-11-01' AND  '2020-11-30'  GROUP BY region");
                  foreach($products as $product):?>
                                    <tr>
                                        <th> <a class="btn bg-olive btn-block"> <?= $product['region'] ?> </a> </th>
                                        <th>
                                            <? echo number_format($product['count'], 0, '.', ' '); 
                          $count += $product['count'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $purchaseamount += $product['SUM(purchaseamount)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'], 0, '.', ' '); 
                          $price += $product['SUM(price)'];?>
                                        </th>
                                        <th>
                                            <? echo number_format($product['SUM(price)'] - $product['SUM(purchaseamount)'], 0, '.', ' '); 
                          $totalNovember += $product['SUM(price)'] - $product['SUM(purchaseamount)'];?>
                                        </th>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr class="info">
                                        <th>Итого (СУММА)</th>
                                        <th><?= number_format($count, 0, '.', ' '); ?></th>
                                        <th><?= number_format($purchaseamount, 0, '.', ' '); ?></th>
                                        <th><?= number_format($price, 0, '.', ' '); ?></th>
                                        <th><?= number_format($totalNovember, 0, '.', ' '); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
            <!--*********************************************************************************************-

            <div class="col-xs-6">
      
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Прибыль</h3>
                        <div class="box-tools pull-right">
                            <input type="number" value="<?= $totalDecember; ?>" hidden id="december">
                            <input type="number" value="<?= $totalNovember; ?>" hidden id="november">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="pieChart" style="height:250px"></canvas>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </section><!-- /.content -->
    <!-- /************************************************* */ -->
    <script src="plugins/ajax/report_accses.js"></script>