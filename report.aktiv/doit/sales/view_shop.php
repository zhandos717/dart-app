<? //проверка существовании сессии
include("../../bd.php");
$region = $_GET['region'];
$shop = $_GET['shop'];
$fromtovar = $_GET['from'];
$month = $_GET['month'];

$start_month = date("Y-$month-01");

$date = new DateTime($start_month);
$date->modify('last day of this month');
$end_month = $date->format('Y-m-d');

if ($_SESSION['logged_user']->status == 5) : ?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за <?= date('d.m.Y'); ?>
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
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th>ДАТА</th>
                                            <th>ВЫРУЧКА</th>
                                            <th>Приход <br /> Сумма</th>
                                            <th>ПРИБЫЛЬ</th>
                                            <th>ПРИБЫЛЬ <br> (- % Банка)</th>
                                            <th>Кол/во </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $result = R::getAll("SELECT data, SUM(remainder), SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                                        from sales  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '1' AND statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month'  GROUP BY data ");
                                        foreach ($result as $data1) {
                                        ?>
                                            <tr>
                                                <td><a class="btn bg-green btn-block" href="more_details.php?region=<?= $region; ?>&shop=<?= $shop; ?>&data_z=<?= $data1['data']; ?>&from=1"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
                                                <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' ');
                                                    $summareal += $data1['SUM(summareal)'] ?></td>
                                                <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' ');
                                                    $summaprihod += $data1['SUM(summaprihod)'] ?></td>
                                                <td><?= number_format($data1['SUM(pribl)'], 0, '.', ' ');
                                                    $pribl += $data1['SUM(pribl)'] ?></td>

                                                <td class="danger"><?= number_format($data1['SUM(remainder)'] - $data1['SUM(summaprihod)'], 0, '.', ' ');
                                                                    $pribl1 += $data1['SUM(remainder)'] - $data1['SUM(summaprihod)'] ?></td>

                                                <td><?= number_format($data1['COUNT(*)'], 0, '.', ' ');
                                                    $count += $data1['COUNT(*)'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray">
                                            <th>ИТОГО </th>
                                            <th><?= number_format($summareal, 0, '.', ' '); ?></th>
                                            <th><?= number_format($summaprihod, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl1, 0, '.', ' '); ?></th>
                                            <th><?= number_format($count, 0, '.', ' '); ?></th>
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
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th>ДАТА</th>
                                            <th>ВЫРУЧКА</th>
                                            <th>Приход <br /> Сумма</th>
                                            <th>ПРИБЫЛЬ</th>
                                            <th>ПРИБЫЛЬ <br> (- % Банка)</th>
                                            <th>Кол/во </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $com = R::getAll("SELECT data, SUM(remainder), SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                                        from sales  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '2' AND statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month'  GROUP BY data ");
                                        foreach ($com as $item) {
                                        ?>
                                            <tr>
                                                <td><a class="btn bg-green btn-block" href="more_details.php?region=<?= $region; ?>&shop=<?= $shop; ?>&data_z=<?= $item['data']; ?>&from=2"><?= date("d.m.Y", strtotime($item['data'])); ?></a></td>
                                                <td><?= number_format($item['SUM(summareal)'], 0, '.', ' ');
                                                    $summareal_comis += $item['SUM(summareal)'] ?></td>
                                                <td><?= number_format($item['SUM(summaprihod)'], 0, '.', ' ');
                                                    $summaprihod_comis += $item['SUM(summaprihod)'] ?></td>
                                                <td><?= number_format($item['SUM(pribl)'], 0, '.', ' ');
                                                    $pribl_comis += $item['SUM(pribl)'] ?></td>

                                                <td class="danger"><?= number_format($item['SUM(remainder)'] - $item['SUM(summaprihod)'], 0, '.', ' ');
                                                                    $pribl_comis1 += $item['SUM(remainder)'] - $item['SUM(summaprihod)'] ?></td>

                                                <td><?= number_format($item['COUNT(*)'], 0, '.', ' ');
                                                    $count_comis += $item['COUNT(*)'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray">
                                            <th>ИТОГО </th>
                                            <th><?= number_format($summareal_comis, 0, '.', ' '); ?></th>
                                            <th><?= number_format($summaprihod_comis, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_comis, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_comis1, 0, '.', ' '); ?></th>
                                            <th><?= number_format($count_comis, 0, '.', ' '); ?></th>
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
                                <table class="table table-bordered table-hover" id="datatable-tabletools">
                                    <thead>
                                        <tr class="info">
                                            <th>Регион</th>
                                            <th>Филиал</th>
                                            <th>Приход</th>
                                            <th>ВЫРУЧКА</th>
                                            <th>ПРИБЫЛЬ</th>
                                            <th>ПРИБЫЛЬ <br> (- % Банка)</th>
                                            <th>Кл.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $shop_total = R::getAll("SELECT regionlombard, adresslombard, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod) ,SUM(remainder)
                                        from sales  WHERE region = '$region' AND adress = '$shop' AND statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month'  GROUP BY adresslombard  ");
                                        foreach ($shop_total as $data) {
                                        ?>
                                            <tr>
                                                <td><?= $data['regionlombard']; ?></td>
                                                <td><?= $data['adresslombard']; ?></td>
                                                <td><?= number_format($data['SUM(summareal)'], 0, '.', ' ');
                                                    $summareal_shop += $data['SUM(summareal)'] ?></td>
                                                <td><?= number_format($data['SUM(summaprihod)'], 0, '.', ' ');
                                                    $summaprihod_shop += $data['SUM(summaprihod)'] ?></td>
                                                <td><?= number_format($data['SUM(pribl)'], 0, '.', ' ');
                                                    $pribl_shop += $data['SUM(pribl)'] ?></td>

                                                <td class="danger"><?= number_format($data['SUM(remainder)'] - $data['SUM(summaprihod)'], 0, '.', ' ');
                                                                    $pribl_shop1 += $data['SUM(remainder)'] - $data['SUM(summaprihod)'] ?></td>

                                                <td><?= number_format($data['COUNT(*)'], 0, '.', ' ');
                                                    $count_shop += $data['COUNT(*)'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray">
                                            <th colspan="2">ИТОГО</th>
                                            <th><?= number_format($summareal_shop, 0, '.', ' '); ?></th>
                                            <th><?= number_format($summaprihod_shop, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_shop, 0, '.', ' '); ?></th>
                                            <th><?= number_format($pribl_shop1, 0, '.', ' '); ?></th>
                                            <th><?= number_format($count_shop, 0, '.', ' '); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

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

                                echo $shop;

                                $result = R::getAll("SELECT regionlombard, adresslombard, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                            from sales  WHERE region = '$region' AND adress = '$shop' AND statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month'  GROUP BY adresslombard  ");
                                $i = 1;
                                foreach($result as $data1) {
                                   $procent = round(($data1['SUM(pribl)'] * 100) / $pribl_shop1);

                                    if ($procent > 20) {
                                        $color = 'success';
                                        $color1 = 'green';
                                    } elseif ($procent > 10) {
                                        $color = 'info';
                                        $color1 = 'blue';
                                    } elseif ($procent > 5) {
                                        $color = 'warning';
                                        $color1 = 'yellow';
                                    } else {
                                        $color = 'danger';
                                        $color1 = 'red';
                                    }
                                ?>
                                    <tr>
                                        <td><?= $i++ ?>.</td>
                                        <td> <?= $data1['regionlombard']; ?>: <?= $data1['adresslombard']; ?></td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-<?= $color; ?>" style="width: <?= $procent; ?>%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-<?= $color1; ?>"><?= $procent; ?>% </span></td>
                                    </tr>
                                <? } ?>
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
                                $result = R::getAll("SELECT saler, regionlombard, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*), SUM(summaprihod)
                                from sales  WHERE region = '$region' AND adress = '$shop' AND statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month'   GROUP BY saler  ");
                                $i = 1;
                                foreach ($result as $data1) {
                                    $procent = round(($data1['SUM(pribl)'] * 100) / $pribl_shop);

                                    if ($procent > 20) {
                                        $color = 'success';
                                        $color1 = 'green';
                                    } elseif ($procent > 10) {
                                        $color = 'info';
                                        $color1 = 'blue';
                                    } elseif ($procent > 5) {
                                        $color = 'warning';
                                        $color1 = 'yellow';
                                    } else {
                                        $color = 'danger';
                                        $color1 = 'red';
                                    }
                                ?>
                                    <tr>
                                        <td><?= $i++ ?>.</td>
                                        <td>
                                            <a href="more_details_saler.php?saler=<?= $data1['saler']; ?>&start_month=<?= $start_month ?>&end_month=<?= $end_month; ?>  "><?= $data1['saler']; ?></a> <br>
                                            Прибыль: <?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?> тг.
                                        </td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-<?= $color; ?>" style="width: <?= $procent; ?>%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-<?= $color1; ?>"><?= $procent; ?>% </span></td>
                                    </tr>
                                <? } ?>
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