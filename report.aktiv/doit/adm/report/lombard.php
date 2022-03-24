<?php
include __DIR__ . '/../../../bd.php';
if($_SESSION['logged_user']->status != 3) header('Location: /');
include  __DIR__.'/../../layouts/header.php';
include __DIR__.'/../edo/menu.php';

$table = 'reports';

function percent(int $number, int $percent): int
{
    $result = $number - ($number / 100 * $percent);
    return $result > 0 ? $result : $number;
}

$result = R::getAll('SELECT 
        t1.dl, t1.dm, t1.dop, t1.dohod, t1.newclients,t1.allclients,t1.chv, t1.region, 
        t2.summarf , t3.pribl,(t3.remainder - t3.summaprihod) as income_score , t3.countsale, t4.auktech,
        t4.aukshubs, t4.nalvzaloge FROM
        (SELECT region, 
        SUM(dl) as dl,
        SUM(dm) as dm,
        SUM(dop) as dop,
        SUM(dohod) as dohod,
        SUM(newclients) as newclients,
        SUM(allclients) as allclients,
        SUM(chv) as chv
        FROM reports  GROUP BY region ORDER BY SUM(dl) ) t1
        INNER JOIN 
        (SELECT  SUM(summarf) as summarf , region FROM rashodfillial 
        WHERE datez BETWEEN  (SELECT MIN(data) FROM reports ) AND  
        (SELECT MAX(data) FROM reports ) 
        GROUP BY region ) t2 
        ON t1.region = t2.region
        INNER JOIN 
        (SELECT SUM(pribl) as pribl,SUM(remainder) as remainder, SUM(summaprihod) as summaprihod, COUNT(*) as countsale, regionlombard as region FROM sales 
        WHERE fromtovar = 1  AND data BETWEEN (SELECT MIN(data) FROM reports) AND  
        (SELECT MAX(data) FROM reports)  AND statustovar IS NULL GROUP BY regionlombard) t3 
        ON t2.region = t3.region 
        INNER JOIN 
        (SELECT SUM(auktech) as auktech ,SUM(aukshubs) as aukshubs ,SUM(nalvzaloge) as nalvzaloge, region FROM reports 
        WHERE  data = (SELECT MAX(data) FROM reports)  GROUP BY region) t4
        ON t3.region = t4.region ');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Отчет за Январь 2022 год
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
                        <div class="">
                            <table class="table table-bordered table-hover" style="white-space:nowrap;" id="datatable-tabletools">
                                <thead>
                                    <tr style="background: #398ebd; color: white;">
                                        <th rowspan="2">РЕГИОНЫ</th>
                                        <th colspan="5" class="text-center">Доход</th>
                                        <th rowspan="2">РАСХОДЫ</th>
                                        <th class="text-center">ЧИСТАЯ ПРИБЫЛЬ </th>
                                        <th colspan="2" class="text-center">КЛИЕНТЫ</th>
                                        <th rowspan="2">ЧИСТАЯ <br> ВЫДАЧА</th>
                                        <th colspan="2" class="text-center">АУКЦИОНИСТ</th>
                                        <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                                    </tr>
                                    <tr style="background: #398ebd; color: white;">
                                        <th>ЛОМБАРДА</th>
                                        <th>МАГАЗИНА</th>
                                        <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>
                                        <th>ДОП</th>
                                        <th>ИТОГ</th>
                                        <th>ЛОМБАРДА (-20%)</th>
                                        <th>ВСЕ </th>
                                        <th>НОВЫЕ</th>
                                        <th>ТЕХНИКА</th>
                                        <th>ШУБА</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $data1) { ?>
                                        <tr>
                                            <td><a href="viewreportregion.php?region=<?= $data1['region']  ?>"> <?= $data1['region']  ?></a></td>
                                            <td>
                                                <?= number_format($data1['dl'], 0, '.', ' ');
                                                $dl += $data1['dl']; ?>
                                            </td>
                                            <td>
                                                <?= number_format($data1['dm'], 0, '.', ' ');
                                                $dm += $data1['dm'];?>
                                            </td>
                                            <td class="danger">
                                                <?= number_format($data1['income_score'], 0, '.', ' ');
                                                $report_sales_pribl += $data1['income_score'] ?> </td>
                                            <td>
                                                <?= number_format($data1['dop'], 0, '.', ' ');
                                                $dop += $data1['dop']; ?>
                                            </td>
                                            <td class="info">
                                                <?= number_format($data1['dohod'], 0, '.', ' ');
                                                $dohod += $data1['dohod']; ?>
                                            </td>
                                            <td>
                                                <?= number_format($data1['summarf'], 0, '.', ' ');
                                                $summarf += $data1['summarf']; ?>

                                            </td>
                                            <td class="bg-primary"><strong><?= number_format(percent($data1['dohod'] - $data1['summarf'], 20), 0, '.', ' '); ?></strong></td>
                                            <td><?= number_format($data1['allclients'], 0, '.', ' ');
                                                $allclients += $data1['allclients']; ?></td>
                                            <td><?= number_format($data1['newclients'], 0, '.', ' ');
                                                $newclients += $data1['newclients'];  ?></td>
                                            <td><?= number_format($data1['chv'], 0, '.', ' ');
                                                $chv += $data1['chv'];  ?></td>

                                            <td class='bg-green'><?= number_format($data1['auktech'], 0, '.', ' ');
                                                                    $auktech += $data1['auktech']; ?></td>

                                            <td class='bg-yellow'><?= number_format($data1['aukshubs'], 0, '.', ' ');
                                                                    $aukshubs += $data1['aukshubs'];  ?></td>

                                            <td class='bg-red'><?= number_format($data1['nalvzaloge'], 0, '.', ' ');
                                                                $nalvzaloge += $data1['nalvzaloge']; ?></td>
                                        <? } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray">
                                        <th>Итого (СУММА)</th>
                                        <th><?= number_format($dl, 0, '.', ' '); ?></th>
                                        <th><?= number_format($dm, 0, '.', ' '); ?></th>
                                        <th class="bg-red"><?= number_format($report_sales_pribl, 0, '.', ' '); ?></th>
                                        <th><?= number_format($dop, 0, '.', ' '); ?></th>
                                        <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                                        <th>
                                            <?= number_format($summarf, 0, '.', ' '); ?>
                                        </th>
                                        <th class="bg-primary">
                                            <?= number_format(percent($dohod - $rashodporegionam, 20), 0, '.', ' '); ?>
                                        </th>
                                        <th><?= number_format($allclients, 0, '.', ' '); ?></th>
                                        <th><?= number_format($newclients, 0, '.', ' '); ?></th>
                                        <th><?= number_format($chv, 0, '.', ' '); ?></th>
                                        <th class='bg-green'><?= number_format($auktech, 0, '.', ' '); ?></th>
                                        <th class='bg-yellow'><?= number_format($aukshubs, 0, '.', ' '); ?></th>
                                        <th class='bg-red'><?= number_format($nalvzaloge, 0, '.', ' '); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div><!-- /.row -->
<?php include __DIR__ . '/../../layouts/footer.php';?>