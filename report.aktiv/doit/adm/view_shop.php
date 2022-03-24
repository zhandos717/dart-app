<?php
include("../../bd.php");
if (!$_SESSION['logged_user']->status == 3) header('Location: /');

$region = $_GET['region'];
$shop = $_GET['shop'];
$fromtovar = $_GET['from'];
$month = $_GET['month'];
$year = $_GET['year'];

$start_month = date("$year-$month-01");
$date = new DateTime($start_month);
$date->modify('last day of this month');

$end_month = $date->format('Y-m-d');

$city = R::findAll('kassa', 'region <> "Тест" GROUP BY region');

include "header.php";
include "menu.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за <?= date('d.m.Y', strtotime($start_month)); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php"><?= $region; ?></a></li>
            <li class="active"><?= $shop; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-primary" id='get_chart'> Построить график </button>
                        <h3 class="box-title"> <i class="fa fa-cart-plus"></i> Ломбард
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body hidden" id='table_chart'>
                        <div class="btn-group" id="filter">
                            <button type="button" class="btn btn-danger">Выберите фильтр</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#all">По магазину</a></li>
                                <li><a href="#branches">По филиалам</a></li>
                                <li class="divider"></li>
                                <li><a href="#year_total">За год</a></li>
                            </ul>
                        </div>


                        <div class="col-lg-3 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-bank"></i>
                                </span>
                                <select class="form-control" id="get_shop" name="region">
                                    <? if (isset($_GET['region'])) { ?>
                                        <option><?= $_GET['region'] ?></option>
                                    <? };
                                    foreach ($city as $reg) { ?>
                                        <option><?= $reg['region'] ?></option>
                                    <? } ?>
                                </select>
                            </div>
                            <!-- /input-group -->
                        </div>
                        <!-- /.col-lg-4 -->
                        <div class="col-lg-3 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <select class="form-control" id="shop" name="adress">
                                    <? if (isset($_GET['shop'])) { ?>
                                        <option><?= $_GET['shop'] ?></option>
                                    <? }; ?>
                                </select>
                            </div>
                            <!-- /input-group -->
                        </div>


                        <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <canvas id="myChart" height="120%"></canvas>
                    </div>
                    <div class="box-body" id="report_mounth">
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

                            $result = R::getAll("SELECT regionlombard, adresslombard, SUM(pribl)
                            from sales  WHERE region = '$region' AND adress = '$shop' AND statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month'  GROUP BY adresslombard ORDER BY SUM(pribl) DESC   ");
                            $i = 1;
                            foreach ($result as $data1) {
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
                            $result = R::getAll("SELECT saler, SUM(pribl)
                                from sales  WHERE region = '$region' AND adress = '$shop' AND statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month'   GROUP BY saler ORDER BY SUM(pribl) DESC  ");
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    function $_get(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    const config = {
        type: 'line',
        data: {
            labels: [1, 2],
            datasets: [{
                label: 'Продажи в регионе',
                data: [0],
                backgroundColor: [
                    '#FBDB54',
                ],
                borderColor: [
                    '#F78309',
                ],
                borderWidth: 1
            }]
        }
    };
    const myLineChart = new Chart(ctx, config);

    $('.dropdown-menu').click(function(event) {
        $('.overlay').toggleClass('hidden')
        $.getJSON('/doit/function/get_region_sales.php', {
            year: $_get('year'),
            month: $_get('month'),
            region: $('#get_shop').val(),
            shop: $('#shop').val(),
            filter: event.target.hash
        }).done(function(data) {
            $('.overlay').toggleClass('hidden')
            myLineChart.data = data;
            myLineChart.update();
        });
    });

    $('#get_chart').click(function() {
        $.getJSON('/doit/function/get_region_sales.php', {
            year: $_get('year'),
            month: $_get('month'),
            region: $_get('region'),
            shop: $_get('shop'),
        }).done(function(data) {

            $('#get_chart').text('Показать/скрыть');
            $('#table_chart').toggleClass('hidden');
            $('#report_mounth').toggleClass('hidden');

            myLineChart.data = data;
            myLineChart.update();
        });
    });
</script>


<?php include "footer.php"; ?>