<?
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
    $data_begin = date('Y.m.01'); //Дата начало
    $data_end   = date('Y.m.d'); //Дата конец
    $today = date('y-m-d');
    $month =  date('m');
    $today2 = date('Y-m-d');
    $data_begin2 = date('Y-m-01');


    // $data_begin = date('Y.09.01'); //Дата начало
    // $data_end   = date('Y.09.30'); //Дата конец
    // $today = date('y-m-d');
    // $month =  date('m');
    // $today2 = date('Y-m-d');
    // $data_begin2 = date('Y-m-01');

    // $date1 = $_REQUEST['date1'];
    // $date2   = $_REQUEST['date2'];
    function percent($number, $percent)
    {
        return  $number - ($number / 100 * $percent);
    }
    include "header.php";
    include "menu.php";
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Фильтрация отчета ЛОМБАРДА по датам
                <!-- <?= date('01.m.Y') ?> до <?= date('d.m.Y') ?> (е...ый ОБС ТБС пока в процессе) -->
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
                    <div class="box">
                        <div class="box-body">
                            <form action="functions/get_report_date.php" id="report" method="POST">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="view_report" class="form-control">
                                            <option value="1">По городам</option>
                                            <!-- <option value="2">По филиалам</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control" value="<?= date('Y-m-01') ?>"  name="date1" min="<?=$data_begin2;?>" max="<?=$today2;?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date2" min="<?=$data_begin2;?>" max="<?=$today2;?>">
                                    </div>
                                </div>

                                <!-- <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="date1" min="2021-09-01" max="2021-09-30">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control"  name="date2" min="2021-09-01" max="2021-09-30">
                                    </div>
                                </div> -->

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn-success btn ">ФИЛЬТРОВАТЬ !</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="answer">
                                <table class="table table-bordered table-hover" style="white-space:nowrap;" id="datatable-tabletools">
                                    <thead>
                                        <tr class="info">
                                            <th rowspan="2">РЕГИОНЫ</th>
                                            <th colspan="5" class="text-center">Доход</th>
                                            <th rowspan="2">РАСХОДЫ</th>

                                            <th colspan="3" class="text-center">ЧИСТАЯ ПРИБЫЛЬ </th>
                                            <th colspan="2" class="text-center">КЛИЕНТЫ</th>
                                            <th rowspan="2">ЧИСТАЯ <br> ВЫДАЧА</th>
                                            <th colspan="2" class="text-center">АУКЦИОНИСТ</th>
                                            <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                                        </tr>
                                        <tr class="info">
                                            <th>ЛОМБАРДА</th>
                                            <th>МАГАЗИНА</th>
                                            <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>
                                            <th>ДОП</th>
                                            <th>ИТОГ</th>
                                            <th>ЛОМБАРДА (-20%)</th>
                                            <th>Комиссионка (-3%)</th>
                                            <th>ИТОГ</th>
                                            <th>ВСЕ </th>
                                            <th>НОВЫЕ</th>
                                            <th>ТЕХНИКА</th>
                                            <th>ШУБА</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $result = R::getAll("SELECT region, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),
                                            SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                            SUM(newclients),SUM(vzs),SUM(vozvrat),
                                            SUM(nakladnoy),COUNT(adress),SUM(chv)
                                            FROM reports GROUP BY region ORDER BY SUM(dl) ASC");
                                        foreach ($result as $data) {
                                            $region =  $data['region'];
                                            $sales = R::getCol("SELECT SUM(pribl) FROM sales WHERE regionlombard = '$region' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");
                                            $sales = $sales[0];
                                            $all_filial = R::getCol("SELECT  adress FROM reports WHERE region='$region' GROUP BY adress ");
                                            unset($auktech, $aukshubs, $nalvzaloge, $obs, $tbs, $accsess, $get_comission);
                                            $get_comission = R::getCol("SELECT SUM(net_profit) FROM reportstotal WHERE region='$region' AND date_report = '$today'   GROUP BY region   "); ///GROUP BY region ORDER BY date_report DESC
                                            $comission = $get_comission[0];
                                            foreach ($all_filial as $filial) {
                                                $total = R::getAll(" SELECT auktech,aukshubs,nalvzaloge FROM reports WHERE adress = '$filial' ORDER BY segdata DESC  ");
                                                $total = $total[0];
                                                $auktech += $total['auktech'];
                                                $aukshubs += $total['aukshubs'];
                                                $nalvzaloge += $total['nalvzaloge'];
                                            }
                                            $auktech_total +=  $auktech;
                                            $aukshubs_total += $aukshubs;
                                            $nalvzaloge_total += $nalvzaloge;
                                            $number =  $data['SUM(dohod)'] - ($data['SUM(stabrashod)'] + $data['SUM(tekrashod)']);
                                            $chistaya = percent($number, 20);
                                        ?>
                                            <tr>
                                                <td>
                                                  <!-- <a href="viewreportregion.php?region=<?= $region ?>" class="btn bg-olive btn-block"> <?= $region ?></a> -->
                                                  <a href="filtrFiliall.php?data_begin=<?=$data_begin;?>&data_end=<?=$data_end;?>&region=<?=$region;?>" ><?= $region ?></a>
                                                </td>
                                                <td>
                                                    <?= number_format($data['SUM(dl)'], 0, '.', ' ');
                                                    $dl += $data['SUM(dl)']; ?>
                                                </td>
                                                <td>
                                                    <?= number_format($data['SUM(dm)'], 0, '.', ' ');
                                                    $dm += $data['SUM(dm)']; ?>
                                                </td>
                                                <td class="danger">
                                                    <?= number_format($sales, 0, '.', ' ');
                                                    $report_sales_pribl += $sales; ?>
                                                </td>
                                                <td>
                                                    <?= number_format($data['SUM(dop)'], 0, '.', ' ');
                                                    $dop += $data['SUM(dop)']; ?>
                                                </td>
                                                <td class="info">
                                                    <?= number_format($data['SUM(dohod)'], 0, '.', ' ');
                                                    $dohod += $data['SUM(dohod)']; ?>
                                                </td>
                                                <td><?= number_format($data['SUM(tekrashod)'] + $data['SUM(stabrashod)'], 0, '.', ' ');
                                                    $rashod += $data['SUM(tekrashod)'] + $data['SUM(stabrashod)'] ?></td>
                                                <td class="info">
                                                    <?= number_format($chistaya, 0, '.', ' ');
                                                    $chistaya_total += $chistaya; ?></td>
                                                <th>
                                                    <?= number_format($comission, 0, '.', ' ');
                                                    $total_comission += $comission;  ?>
                                                </th>
                                                <th class="success">
                                                    <?= number_format($chistaya + $comission, 0, '.', ' ');
                                                    $total1  += $chistaya + $comission; ?>
                                                </th>
                                                <td><?= number_format($data['SUM(allclients)'], 0, '.', ' ');
                                                    $allclients += $data['SUM(allclients)']; ?></td>
                                                <td><?= number_format($data['SUM(newclients)'], 0, '.', ' ');
                                                    $newclients += $data['SUM(newclients)']; ?></td>
                                                <td><?= number_format($data['SUM(chv)'], 0, '.', ' ');
                                                    $chv += $data['SUM(chv)']; ?></td>
                                                <td class="success"><?= number_format($auktech, 0, '.', ' ');; ?></td>
                                                <td class="warning"><?= number_format($aukshubs, 0, '.', ' ');; ?></td>
                                                <td class="danger"><?= number_format($nalvzaloge, 0, '.', ' ');; ?></td>
                                            </tr>
                                        <?  } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray">
                                            <th>Итого (СУММА)</th>
                                            <th><?= number_format($dl, 0, '.', ' '); ?></th>
                                            <th><?= number_format($dm, 0, '.', ' '); ?></th>
                                            <th class="bg-red"><?= number_format($report_sales_pribl, 0, '.', ' '); ?></th>
                                            <th><?= number_format($dop, 0, '.', ' '); ?></th>
                                            <th class="info"><?= number_format($dohod, 0, '.', ' '); ?></th>
                                            <th><?= number_format($rashod, 0, '.', ' '); ?></th>
                                            <th class="info"><?= number_format($chistaya_total, 0, '.', ' '); ?></th>
                                            <th class="danger"><?= number_format($total_comission, 0, '.', ' '); ?></th>
                                            <th class="success"><?= number_format($total1, 0, '.', ' '); ?></th>
                                            <th><?= number_format($allclients, 0, '.', ' '); ?></th>
                                            <th><?= number_format($newclients, 0, '.', ' '); ?></th>
                                            <th><?= number_format($chv, 0, '.', ' '); ?></th>
                                            <th class="success"><?= number_format($auktech_total, 0, '.', ' '); ?></th>
                                            <th class="warning"><?= number_format($aukshubs_total, 0, '.', ' '); ?></th>
                                            <th class="danger"><?= number_format($nalvzaloge_total, 0, '.', ' '); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script>
        $(document).ready(function name(params) {
            $('input').change(function() {
                var date1 = new Date($('input[name=date1]').val());
                var date2 = new Date($('input[name=date2]').val());
                var out = 'Показать отчет с ' + date1.toLocaleDateString() + ' до ' + date2.toLocaleDateString();
                $('h1').html(out);
            })
        });
    </script>
<?
    include "footer.php";
else :
    header('Location: ../../index.php');
endif;
?>
