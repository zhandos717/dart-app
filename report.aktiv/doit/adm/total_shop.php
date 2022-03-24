<? include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
    $active_mag = 'active';
    $start_month = $_GET['start'];
    $end_month = $_GET['end'];
    $date = new DateTime($start_month);
    $date->modify('last day of this month');
    $last_day = $date->format('d');
    $month = $date->format('m');
    $year = $date->format('Y');

    include "header.php";
    include "menu.php";

    function calculate_percentage($price, $sale)
    {
        return round((($price - $sale) * 100) / $price, 2);
    }
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
                        <div class="box-header">
                            <button class="btn btn-primary" id='get_chart'> Построить график </button>
                        </div>

                        <div class="box-body hidden" id='table_chart'>

                            <div class="btn-group" id="filter">
                                <button type="button" class="btn btn-danger">Выберите фильтр</button>
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#all">Весь Казахстан</a></li>
                                    <li><a href="#city">По городам</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#year_total_all">За год весь Казахстан</a></li>
                                    <li><a href="#year_total_city">За год по городам</a></li>
                                </ul>
                            </div>

                            <div class="overlay hidden">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>

                            <canvas id="myChart" height="120%"></canvas>
                        </div>
                        <div class="box-body" id='report_mounth'>

                            <div id="main_report">

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
                                    FROM sales WHERE  statustovar IS NULL AND data BETWEEN '$start_month' AND '$end_month' GROUP BY adress,region ORDER BY SUM(pribl) DESC");

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
                                                <th><a class="btn bg-olive btn-block" href="view_shop.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=1&year=<?= $year ?>&month=<?= $month; ?>"><b><?= $data1['region']; ?> <?= $data1['adress']; ?></b></a></th>
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
                                    AND data BETWEEN '$start_month' AND '$end_month'   
                                    GROUP BY adress ");
                                        foreach ($result as $data1) {
                                        ?>
                                            <tr>
                                                <td><i class="fa fa-shopping-cart"></i></td>
                                                <td><a href="view_shop.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=2&year=<?= $year ?>&month=<?= $month ?>"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
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
                                    AND statustovar IS NULL 
                                    AND data BETWEEN '$start_month' AND '$end_month'   
                                    GROUP BY adress ");
                                        foreach ($result as $data1) {
                                        ?>
                                            <tr>
                                                <td><i class="fa fa-shopping-cart"></i></td>
                                                <td><a href="view_shop.php?region=<?= $data1['region']; ?>&shop=<?= $data1['adress']; ?>&from=2&year=<?= $year ?>&month=<?= $month ?>"><?= $data1['region']; ?>-<?= $data1['adress']; ?></a></td>
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
                <!--*********************************************************************************************-->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <div class="box-body">
                            <form action="functions/rplan.php" method="POST">
                                <input type="search" name="page" hidden value="tatal_shop.php?start=<?= $start_month; ?>&end=<?= $end_month; ?>">
                                <div class="col-lg-3 col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-bank"></i>
                                        </span>
                                        <? $regions = R::findall('diruser', 'GROUP BY region'); ?>
                                        <select class="form-control" id="region" name="region">
                                            <option value="">Выберите город</option>
                                            <? foreach ($regions as $region) { ?>
                                                <option value="<?= $region['region'] ?>"><?= $region['region'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select class="form-control" id="adress" name="adress">
                                            <option value="Все">Выберите адрес</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-2 col-sm-2">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="plan" placeholder="1.000.000 $">
                                        <span class="input-group-btn">
                                            <input type="submit" class="btn btn-success btn-flat" name="go_plan" value="Выставить план" />
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--.box-body -->
                        <div class="box-footer clearfix">
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <!--*********************************************************************************************-->
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
                                from sales WHERE statustovar  IS NULL AND data BETWEEN '$start_month' AND '$end_month' GROUP BY saler  ");
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
                    label: 'Продажи по Казахстану',
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

            $.getJSON('/doit/function/get_total_sales.php', {
                start: $_get('start'),
                end: $_get('end'),
                filter: event.target.hash
            }).done(function(data) {

                $('.overlay').toggleClass('hidden')
                myLineChart.data = data;
                myLineChart.update();
            });





        });

        $('#get_chart').click(function() {
            $.getJSON('/doit/function/get_total_sales.php', {
                start: $_get('start'),
                end: $_get('end'),
            }).done(function(data) {

                $('#get_chart').text('Показать/скрыть');
                $('#table_chart').toggleClass('hidden');
                $('#report_mounth').toggleClass('hidden');

                myLineChart.data = data;
                myLineChart.update();
            });
        });
    </script>


    <!-- /**************************************************/-->
<?
    include "footer.php";
else :
    header('Location: /');
endif; ?>