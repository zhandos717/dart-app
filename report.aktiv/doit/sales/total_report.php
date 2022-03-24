<? include("../../bd.php");
if ($_SESSION['logged_user']->status == 5) :
    $start_month = date('Y-m-01');
    $end_month = date('Y-m-t');
    $date = new DateTime($start_month);
    $date->modify('last day of this month');
    $last_day = $date->format('d');
    $month = $date->format('m');
    $year = $date->format('Y');

    function calculate_percentage($price, $sale)
    {
        return round((($price - $sale) * 100) / $price, 2);
    }

    include "header.php";
    include "menu.php";
    // calculate_percentage(1000, 800);   20

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Отчет МАГАЗИНА <?= date('Y'); ?> год. </h1>
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
                    <div class="box">
                        <div class="box-body">
                            <div class="">
                                <!-- table-responsive -->
                                <table id="datatable-tabletools" class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th class="text-center" rowspan="2">МАГАЗИНЫ</th>
                                            <th class="text-center" rowspan="2">ВЫРУЧКА</th>
                                            <th class="text-center" rowspan="2">ВЫРУЧКА <br> (- % банка)</th>
                                            <th class="text-center" rowspan="2">Приход.Сумма</th>
                                            <th class="text-center" rowspan="2">ПРИБЫЛЬ</th>
                                            <th class="text-center" rowspan="2">ПРИБЫЛЬ <br> (- % банка)</th>
                                            <th class="text-center" rowspan="2">КЛ.</th>
                                            <th class="text-center" rowspan="2">ПРИБЫЛЬ %</th>
                                            <th class="text-center" colspan="3">ПЛАН</th>
                                        </tr>
                                        <tr class="info">
                                            <th class="text-center">За месяц</th>
                                            <th class="text-center">В день</th>
                                            <th class="text-center">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $result = R::getAll("SELECT COUNT(*), region, adress, SUM(remainder), SUM(summareal),  SUM(summaprihod), SUM(pribl)
                                    FROM sales WHERE  statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month' AND adress = '$adress'  GROUP BY region ");

                                        // COUNT(*), id,  data, summazaden, SUM(summazaden), SUM(),,,
                                        foreach ($result as $data1) {
                                            $sc += $data1['COUNT(*)'];
                                            $region = $data1['region'];
                                            $adress = $data1['adress'];
                                            $datapl = R::findOne('magplan', 'month =  ? AND year =  ? AND region =? AND adress = ?', [$month, $year, $region, $adress]);
                                            $planden = $datapl['plan'] / $last_day; // сколько нужно в день

                                            if ($month == date('m'))
                                                $need_to_do = $planden * date('d'); // Сколько нужно по сегодняшний день  
                                            else
                                                $need_to_do = $planden * $last_day;

                                            $procent =   calculate_percentage($data1['SUM(pribl)'], $need_to_do);
                                            $resul_proc = $data1['SUM(pribl)'] - $need_to_do; // разница 
                                            $need_to_do_total += $need_to_do;
                                        ?>
                                            <tr>
                                                <th><a class="btn bg-olive btn-block" href="view_shop.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=1&month=<?= $month; ?>"><b><?= $data1['region']; ?> <?= $data1['adress']; ?></b></a></th>
                                                <td class="warning"><?= number_format($data1['SUM(summareal)'], 0, '.', ' ');
                                                                    $summareal += $data1['SUM(summareal)'] ?></td>
                                                <td class="danger"> <?= number_format($data1['SUM(remainder)'], 0, '.', ' ');
                                                                    $remainder += $data1['SUM(remainder)'] ?></td>

                                                <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' ');
                                                    $summaprihod += $data1['SUM(summaprihod)'] ?></td>
                                                <td class="success"><?= number_format($data1['SUM(pribl)'], 0, '.', ' ');
                                                                    $pribl += $data1['SUM(pribl)']  ?></td>

                                                <td class="danger"> <?= number_format($data1['SUM(remainder)'] - $data1['SUM(summaprihod)'], 0, '.', ' ');
                                                                    $pribl1 += $data1['SUM(remainder)'] - $data1['SUM(summaprihod)'] ?> </td>
                                                <td><?= $data1['COUNT(*)']; ?></td>
                                                <td><em><b><?= number_format(($data1['SUM(pribl)'] * 100) / $data1['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></td>

                                                <td class="text-center">
                                                    <?= number_format($datapl['plan'], 0, '.', ' ');
                                                    $plan += $datapl['plan']  ?> </td>

                                                <td class="text-center"><?= number_format($planden, 0, '.', ' ');
                                                                        $planden_total += $planden; ?></td>
                                                <td class="text-center">
                                                    <? if ($procent > 0) { ?>
                                                        <a title="<?= number_format(round($data1['SUM(pribl)']), 0, '.', ' '); ?>-<?= number_format(round($need_to_do), 0, '.', ' ') ?>=<?= number_format(round($resul_proc), 0, '.', ' ') ?>" class="description-percentage text-green">
                                                            <i class="fa fa-caret-up"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                                                    <? } elseif ($procent < 0) { ?>
                                                        <a title="<?= number_format(round($data1['SUM(pribl)']), 0, '.', ' '); ?>-<?= number_format(round($need_to_do), 0, '.', ' ') ?>=<?= number_format(round($resul_proc), 0, '.', ' ') ?>" class="description-percentage text-danger">
                                                            <i class="fa fa-caret-down"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                                                    <? }; ?>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="background: #d3d7df; color: black;">
                                            <th class="text-center">Итого (СУММА)</th>
                                            <th class="text-center"><?= number_format($summareal, 0, '.', ' '); ?></th>
                                            <th class="bg-red"><?= number_format($remainder, 0, '.', ' '); ?></th>
                                            <th class="text-center"><?= number_format($summaprihod, 0, '.', ' '); ?></th>
                                            <th class="text-center"><?= number_format($pribl, 0, '.', ' '); ?></th>

                                            <th class="bg-red"><?= number_format($pribl1, 0, '.', ' '); ?></th>
                                            <th class="text-center"><?= $sc; ?></th>
                                            <th><?= number_format(($pribl * 100) / $summareal, 0, '.', ' '); ?> %</th>
                                            <th class="text-center"><?= number_format($plan, 0, '.', ' '); ?> тг.</th>
                                            <th class="text-center"><?= number_format($planden_total, 0, '.', ' '); ?></th>
                                            <th class="text-center">
                                                <?

                                                $procent =   calculate_percentage($pribl, $need_to_do_total);
                                                $res =  $need_to_do_total - $pribl;

                                                if ($procent > 0) { ?>
                                                    <a title="<?= number_format(round($pribl), 0, '.', ' '); ?>-<?= number_format(round($need_to_do_total), 0, '.', ' ') ?>=<?= number_format(round($res), 0, '.', ' ') ?>" class="description-percentage text-green">
                                                        <i class="fa fa-caret-up"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                                                <? } elseif ($procent < 0) { ?>
                                                    <a title="<?= number_format(round($pribl), 0, '.', ' '); ?>-<?= number_format(round($need_to_do_total), 0, '.', ' ') ?>=<?= number_format(round($res), 0, '.', ' ') ?>" class="description-percentage text-danger">
                                                        <i class="fa fa-caret-down"></i> <?= number_format(round($procent), 0, '.', ' '); ?> %</a>
                                                <? }; ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
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
                                        <tr class="info">
                                            <th style="width: 10px">id</th>
                                            <th>МАГАЗИНЫ</th>
                                            <th>ВЫРУЧКА</th>
                                            <th>Приход.Сумма</th>
                                            <th>ПРИБЫЛЬ</th>
                                            <th class="text-center" rowspan="2">ПРИБЫЛЬ <br> (- % банка)</th>
                                            <th>Количество</th>
                                            <th>ПРИБЫЛЬ %</th>

                                            <!-- <th>АУКЦИОНИСТ +/-</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $result = R::getAll("SELECT COUNT(*), region, SUM(remainder), adress, SUM(summareal), SUM(summaprihod), SUM(pribl) 
                                    FROM sales 
                                    WHERE fromtovar = 1 
                                    AND statustovar IS NULL 
                                    AND adress = '$adress'
                                    AND data BETWEEN '$start_month' AND '$end_month'   
                                    GROUP BY region ");
                                        foreach ($result as $data1) {
                                        ?>
                                            <tr>
                                                <td><i class="fa fa-shopping-cart"></i></td>
                                                <td><a href="view_shop.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=2&month=<?= $month ?>"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
                                                <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' ');
                                                    $summareal_1 += $data1['SUM(summareal)']; ?></td>
                                                <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' ');
                                                    $summaprihod_1 += $data1['SUM(summaprihod)']; ?></td>
                                                <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' ');
                                                    $pribl_1 += $data1['SUM(pribl)'] ?></td>

                                                <td class="danger"> <?= number_format($data1['SUM(remainder)'] - $data1['SUM(summaprihod)'], 0, '.', ' ');
                                                                    $pribl_2 += $data1['SUM(remainder)'] - $data1['SUM(summaprihod)'] ?> </td>

                                                <td><?= $data1['COUNT(*)'];
                                                    $sc_1 += $data1['COUNT(*)']; ?></td>
                                                <td><em><b><?= number_format(($data1['SUM(pribl)'] * 100) / $data1['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></td>
                                                <!-- <td></td> -->
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray">
                                            <th></th>
                                            <th>Итого (СУММА)</th>
                                            <th><?= number_format($summareal_1, 0, '.', ' '); ?></th>
                                            <th><?= number_format($summaprihod_1, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_1, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_2, 0, '.', ' '); ?></th>
                                            <th><?= $sc_1; ?></th>
                                            <th><em><b><?= number_format(($pribl_1 * 100) / $summareal_1, 0, '.', ' '); ?> %</b></em></th>
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
                                        <tr class="success">
                                            <th style="width: 10px">id</th>
                                            <th>МАГАЗИНЫ</th>
                                            <th>ВЫРУЧКА</th>
                                            <th>Приход.Сумма</th>
                                            <th>ПРИБЫЛЬ</th>
                                            <th class="text-center" rowspan="2">ПРИБЫЛЬ <br> (- % банка)</th>
                                            <th>Количество</th>
                                            <th>ПРИБЫЛЬ %</th>
                                            <!-- <th>АУКЦИОНИСТ +/-</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $result = R::getAll("SELECT COUNT(*), region, adress,  SUM(remainder), SUM(summareal), SUM(summaprihod), SUM(pribl) 
                                    FROM sales 
                                    WHERE fromtovar = 2 
                                    AND adress = '$adress'
                                    AND statustovar IS NULL 
                                    AND data BETWEEN '$start_month' AND '$end_month'   
                                    GROUP BY region ");
                                        foreach ($result as $data1) {
                                        ?>
                                            <tr>
                                                <td><i class="fa fa-shopping-cart"></i></td>
                                                <td><a href="view_shop.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=2&month=<?= $month ?>"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
                                                <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' ');
                                                    $summareal_2 += $data1['SUM(summareal)']; ?></td>
                                                <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' ');
                                                    $summaprihod_2 += $data1['SUM(summaprihod)']; ?></td>
                                                <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' ');
                                                    $pribl_com += $data1['SUM(pribl)'] ?></td>


                                                <td class="danger"> <?= number_format($data1['SUM(remainder)'] - $data1['SUM(summaprihod)'], 0, '.', ' ');
                                                                    $pribl_com1 += $data1['SUM(remainder)'] - $data1['SUM(summaprihod)'] ?> </td>
                                                <td><?= $data1['COUNT(*)'];
                                                    $sc_2 += $data1['COUNT(*)']; ?></td>
                                                <td><em><b><?= number_format(($data1['SUM(pribl)'] * 100) / $data1['SUM(summareal)'], 0, '.', ' '); ?> %</b></em></td>
                                                <!-- <td></td> -->
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray">
                                            <th></th>
                                            <th>Итого (СУММА)</th>
                                            <th><?= number_format($summareal_2, 0, '.', ' '); ?></th>
                                            <th><?= number_format($summaprihod_2, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_com, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_com1, 0, '.', ' '); ?></th>
                                            <th><?= $sc_2; ?></th>
                                            <th><em><b><?= number_format(($pribl_2 * 100) / $summareal_2, 0, '.', ' '); ?> %</b></em></th>
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
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Таблица эфективности продавцов</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body ">
                            <table class="table table-bordered table-hover" id="example1">
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
                                    $result = R::getAll("SELECT saler, region,adress , SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                                from sales WHERE statustovar  IS NULL AND adress = '$adress'
                                AND data BETWEEN '$start_month' AND '$end_month' GROUP BY saler  ");
                                    $i = 1;
                                    foreach ($result as $data1) {
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?>.</td>
                                            <td> <?= $data1['region']; ?> </td>
                                            <td> <?= $data1['adress']; ?> </td>
                                            <td>
                                                <?= $data1['saler']; ?>
                                            </td>
                                            <td class="info">
                                                <?= $data1['SUM(summaprihod)']; ?>
                                            </td>
                                            <td class="success">
                                                <?= $data1['SUM(pribl)']; ?>
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?
    include "footer.php";
else :
    header('Location: /');
endif; ?>