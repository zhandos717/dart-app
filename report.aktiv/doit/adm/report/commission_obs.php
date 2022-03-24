<?php
include __DIR__ . '/../../../bd.php';
if ($_SESSION['logged_user']->status != 3) header('Location: /');
// include  __DIR__ . '/../../layouts/header.php';
// include __DIR__ . '/../edo/menu.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$table = 'reports';
function percent(int $number, int $percent)
{
    $result = $number - ($number / 100 * $percent);
    if ($result > 0)
        return $result;
    else
        return $number;
}
// t2.tickets_proc, t3.summa_vydachy,t3.cena_pr,
        // t3.cena_pr,t3.sale_count
        //  t1.ticket_count, t1.p1,
$result = R::getAll("SELECT t1.region FROM 
        (SELECT COUNT(*) as ticket_count , SUM(p1) as p1, region FROM tickets 
        WHERE NOT status IN (1,11) 
        AND dataseg BETWEEN (SELECT MIN(data) FROM reports) AND (SELECT MAX(data) FROM reports)  
        GROUP BY region ) t1 
        INNER JOIN 
        (SELECT SUM(proc) as tickets_proc,region FROM tickets WHERE status = 4 
        AND datavykup BETWEEN (SELECT MIN(data) FROM reports) AND (SELECT MAX(data) FROM reports)  
        GROUP BY region ) t2 
        ON t2.region = t1.region
        INNER JOIN 
        (SELECT SUM(summa_vydachy) as summa_vydachy , SUM(cena_pr) as cena_pr,
        COUNT(*) as sale_count , region FROM tickets  
        WHERE status = 5 
        AND datesale BETWEEN (SELECT MIN(data) FROM reports) AND (SELECT MAX(data) FROM reports) 
        GROUP BY region  ) t3 
        ON  t1.region = t2.region 
        -- INNER JOIN 
        -- (SELECT SUM(price) as price ,SUM(purchaseamount) as purchaseamount ,region FROM productreport 
        -- WHERE  datereg BETWEEN (SELECT MIN(data) FROM reports) AND (SELECT MAX(data) FROM reports)
        -- GROUP BY region ) t4 
        -- ON t3.region = t1.region
        -- INNER JOIN 
        -- (SELECT SUM(pribl), SUM(remainder), SUM(summaprihod), COUNT(*), regionlombard as region FROM sales 
        -- WHERE fromtovar = '2' AND data BETWEEN (SELECT MIN(data) FROM reports) AND (SELECT MAX(data) FROM reports)
        -- AND statustovar IS NULL GROUP BY regionlombard ) t5 
        -- ON t5.region = t1.region
        -- INNER JOIN 
        -- (SELECT SUM(summa_vydachy) as furs, region FROM tickets 
        -- WHERE status IN(7,10,14,15) 
        -- AND  type = 'Шубы'   GROUP BY region ) t6 
        -- ON t6.region = t1.region
        -- INNER JOIN 
        -- (SELECT SUM(summa_vydachy) as not_furs, region FROM tickets 
        -- WHERE status IN(7,10,14,15) 
        -- AND  NOT type = 'Шубы' GROUP BY region ) t7 
        -- ON t7.region = t1.region
        -- INNER JOIN 
        -- (SELECT SUM(summa_vydachy), region FROM tickets 
        -- WHERE status = 2 GROUP BY region ) t8 
        -- ON t8.region = t1.region
    ");?>
<pre>
<? var_dump($result); exit; ?>
</pre>
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
                            <table class="table table-bordered table-hover" id="tabletools">
                                <thead style="white-space:nowrap;">
                                    <tr class="bg-blue">
                                        <th rowspan="2">РЕГИОНЫ</th>
                                        <th rowspan="2">КОМИССИОНКА</th>
                                        <th colspan="5" class="text-center">МАГАЗИН доход</th>
                                        <!-- <th>ДОП <br> ДОХОДЫ</th> -->
                                        <!-- <th rowspan="2">ДОХОДЫ</th> -->
                                        <!-- <th rowspan="2">РАСХОДЫ</th> -->
                                        <th rowspan="2">ПРИБЫЛЬ</th>
                                        <th rowspan="2">РАСХОД</th>
                                        <th rowspan="2">ПРИБЫЛЬ -3%</th>
                                        <th rowspan="2">ВСЕ <br> КЛИЕНТЫ</th>
                                        <!-- <th>НОВЫЕ <br> КЛИЕНТЫ</th> -->
                                        <th rowspan="2">АУКЦИОНИСТ <br> ТЕХНИКА</th>
                                        <th rowspan="2">АУКЦИОНИСТ <br> ШУБА</th>
                                        <th rowspan="2">АУКЦИОНИСТ <br> В ОЖИДАНИИ</th>
                                        <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                                    </tr>
                                    <tr>

                                        <td class="info">
                                            По факту кол-во.
                                        </td>
                                        <td class="info">
                                            По факту СУММ.
                                        </td>
                                        <td class="info">
                                            Аксессуары
                                        </td>
                                        <td class="bg-red">
                                            ОТЧЕТ магазина
                                        </td>
                                        <td class="bg-red">
                                            По списку кол-во.
                                        </td>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?

                                    foreach ($result as $data1) {

                                    ?>
                                        <tr>
                                            <td><a class="btn btn-block bg-olive" href="viewreportregion.php?region=<?= $data1['region']; ?>"><?= $data1['region']; ?></a></td>
                                            <td>
                                                <? echo number_format($data1['SUM(p1)'] + $data19['SUM(proc)'], 0, '.', ' ');
                                                $dohod += $data1['SUM(p1)'] + $data19['SUM(proc)']; ?>
                                            </td>
                                            <td><?= $data8['COUNT(*)'];
                                                $countm += $data8['COUNT(*)']; ?></td>
                                            <td>
                                                <? echo number_format(($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'], 0, '.', ' ');
                                                $dohodm += ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)']; ?>
                                            </td>
                                            <th>
                                                <?= number_format($acc['SUM(price)'] - $acc['SUM(purchaseamount)'], 0, '.', ' ');
                                                $accses_obs += ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);  ?>
                                            </th>
                                            <td class="danger">
                                                <?= number_format($sale_com['SUM(remainder)'] - $sale_com['SUM(summaprihod)'], 0, '.', ' ');
                                                $dohodml += $sale_com['SUM(remainder)'] - $sale_com['SUM(summaprihod)'] ?>
                                            </td>
                                            <td class="danger"><?= $sale_com['COUNT(*)'];
                                                                $countml += $sale_com['COUNT(*)']; ?></td>


                                            <!-- <td>0</td> -->
                                            <? $chistaya = $data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'] - $data451['SUM(summa)'] + ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);
                                            $ch = percent($chistaya, 3);
                                            ?>

                                            <th><?= number_format($chistaya, 0, '.', ' '); ?></th>
                                            <td>
                                                <?= number_format($rashod['SUM(tekrashod)'],  0, '.', ' ');
                                                $tekrashod_com += $rashod['SUM(tekrashod)'];
                                                ?>

                                            </td>
                                            <td class="info">
                                                <?= number_format($ch - $tekrashod_com, 0, '.', ' ');
                                                $total_ch += $ch; ?>
                                            </td>

                                            <td>
                                                <?= number_format($data1['count'], 0, '.', ' ');
                                                $count += $data1['count']; ?>
                                            </td>
                                            <td class="success">
                                                <?= number_format($auctioneer_teh['SUM(summa_vydachy)'], 0, '.', ' ');
                                                $summa_vydachy += $auctioneer_teh['SUM(summa_vydachy)']; ?>
                                            </td>
                                            <td class="warning">
                                                <?= number_format($auctioneer_fur['SUM(summa_vydachy)'], 0, '.', ' ');
                                                $summa_vydachy2 += $auctioneer_fur['SUM(summa_vydachy)']; ?>
                                            </td>
                                            <td> <?= number_format($sale['SUM(summaprihod)'] - $data8['SUM(summa_vydachy)'], 0, '.', ' ');
                                                    $auct += $sale['SUM(summaprihod)'] - $data8['SUM(summa_vydachy)']; ?></td>
                                            <td class="danger">
                                                <?= number_format($cash_in_pledge_end['SUM(summa_vydachy)'], 0, '.', ' ');
                                                $cash_in_pledge += $cash_in_pledge_end['SUM(summa_vydachy)'];
                                                ?>
                                            </td>
                                        </tr>
                                    <? }; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray">
                                        <th>Итого (СУММА)</th>
                                        <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                                        <td> <?= $countm; ?></td>
                                        <th><?= number_format($dohodm, 0, '.', ' '); ?></th>
                                        <th><?= number_format($accses_obs, 0, '.', ' '); ?></th>

                                        <th class="bg-red"><?= number_format($dohodml, 0, '.', ' '); ?></th>
                                        <td class="bg-red"> <?= $countml; ?></td>
                                        <!-- <th></th> -->
                                        <!-- <th>0</th> -->

                                        <th><?= number_format($dohodm + $dohod + $accses_obs, 0, '.', ' '); ?></th>
                                        <td> <?= $tekrashod_com ?></td>
                                        <td class="bg-blue"><?= number_format($total_ch - $tekrashod_com, 0, '.', ' '); ?></td>

                                        <th><?= number_format($count, 0, '.', ' '); ?></th>
                                        <th><?= number_format($summa_vydachy, 0, '.', ' '); ?></th>
                                        <th><?= number_format($summa_vydachy2, 0, '.', ' '); ?></th>
                                        <td><?= number_format($auct, 0, '.', ' '); ?> </td>
                                        <th>
                                            <? echo number_format($cash_in_pledge, 0, '.', ' ');
                                            unset($dohod, $dohodm, $count, $newclients, $summa_vydachy, $summa_vydachy2, $cash_in_pledge_end); ?>
                                        </th>
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
<?php include __DIR__ . '/../../layouts/footer.php'; ?>