<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Отчет за <?= date('Y'); ?> г. <?= $region ?>

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
                    <h4> <button id='back' value="back" class="btn bg-olive">Назад</button> <i data-widget="collapse" class="btn bg-red fa fa-tag"></i> <span> Февраль </span> </h4>
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
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Приход</th>
                                    <th>ВЫРУЧКА</th>
                                    <th>ПРИБЫЛЬ</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?        
                                $products = R::findAll('productreport', "region = '$region' AND datereg BETWEEN  '2021-02-01' AND  '2021-02-28' ");
                                foreach($products as $product):?>
                                <tr>
                                    <th> <?= $product['category'] ?> <?= $product['name'] ?> </th>
                                    <th>
                                        <? echo number_format($product['counttovar'], 0, '.', ' '); 
                                            $count += $product['counttovar'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['purchaseamount'], 0, '.', ' '); 
                          $purchaseamount += $product['purchaseamount'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'], 0, '.', ' '); 
                          $price += $product['price'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'] - $product['purchaseamount'], 0, '.', ' '); 
                          $price2 += $product['price'] - $product['purchaseamount'];?>
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
                                    <th><?= number_format($price2, 0, '.', ' '); ?></th>
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
                    <h4><i data-widget="collapse" class="btn bg-red fa fa-tag"></i> <span> Январь </span> </h4>
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
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Приход</th>
                                    <th>ВЫРУЧКА</th>
                                    <th>ПРИБЫЛЬ</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?
                                                    
                                $products = R::findAll('productreport', "region = '$region' AND datereg BETWEEN  '2021-01-01' AND  '2021-01-31' ");
                                foreach($products as $product):?>
                                <tr>
                                    <th> <?= $product['category'] ?> <?= $product['name'] ?> </th>
                                    <th>
                                        <? echo number_format($product['counttovar'], 0, '.', ' '); 
                                            $count += $product['counttovar'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['purchaseamount'], 0, '.', ' '); 
                          $purchaseamount += $product['purchaseamount'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'], 0, '.', ' '); 
                          $price += $product['price'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'] - $product['purchaseamount'], 0, '.', ' '); 
                          $price2 += $product['price'] - $product['purchaseamount'];?>
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
                                    <th><?= number_format($price2, 0, '.', ' '); ?></th>
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
                    <h4> <i data-widget="collapse" class="btn bg-red fa fa-tag"></i> <span> Декабрь </span> </h4>
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
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Приход</th>
                                    <th>ВЫРУЧКА</th>
                                    <th>ПРИБЫЛЬ</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?
                                                    
                                $products = R::findAll('productreport', "region = '$region' AND datereg BETWEEN  '2020-12-01' AND  '2020-12-31' ");
                                foreach($products as $product):?>
                                <tr>
                                    <th> <?= $product['category'] ?> <?= $product['name'] ?> </th>
                                    <th>
                                        <? echo number_format($product['counttovar'], 0, '.', ' '); 
                                            $count += $product['counttovar'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['purchaseamount'], 0, '.', ' '); 
                          $purchaseamount += $product['purchaseamount'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'], 0, '.', ' '); 
                          $price += $product['price'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'] - $product['purchaseamount'], 0, '.', ' '); 
                          $price2 += $product['price'] - $product['purchaseamount'];?>
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
                                    <th><?= number_format($price2, 0, '.', ' '); ?></th>
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
                    <h4> <i data-widget="collapse" class="btn bg-red fa fa-tag"></i> <span> Ноябрь </span> </h4>
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
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Приход</th>
                                    <th>ВЫРУЧКА</th>
                                    <th>ПРИБЫЛЬ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <? 
                                $products = R::findAll('productreport', "region = '$region' AND datereg BETWEEN  '2020-11-01' AND  '2020-11-30' ");
                                foreach($products as $product):?>
                                <tr>
                                    <th> <?= $product['category'] ?> <?= $product['name'] ?> </th>
                                    <th>
                                        <? echo number_format($product['counttovar'], 0, '.', ' '); 
                                            $count += $product['counttovar'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['purchaseamount'], 0, '.', ' '); 
                          $purchaseamount += $product['purchaseamount'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'], 0, '.', ' '); 
                          $price += $product['price'];?>
                                    </th>
                                    <th>
                                        <? echo number_format($product['price'] - $product['purchaseamount'], 0, '.', ' '); 
                          $price2 += $product['price'] - $product['purchaseamount'];?>
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
                                    <th><?= number_format($price2, 0, '.', ' '); ?></th>
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
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
    $(document).ready(function() {
        $("#back").click(function() {
            var back = $(this).val();
            $.post("accses.php", {
                    back: back
                })
                .done(function(data) {
                    $('.content-wrapper').html(data);
                });
        });
    });
</script>