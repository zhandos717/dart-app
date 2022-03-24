<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 9) :
    include "header.php";
    include "menu.php";

    $access_region = R::findOne('access', 'userid = :userid', [':userid' => $_SESSION['logged_user']->id]);

      $data_begin = '2022-02-01'; //Дата начало
      $data_end   = '2022-02-28'; //Дата конец

    $table = 'reports';

  function percent(int $number,int $percent)
  {

    $result = $number - ($number / 100 * $percent);
    if($result > 0)
    return $result;
    else
    return $number;
  }
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Отчет 2021
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

                                    <!-- datatable-tabletools  -->
                                    <thead>
                                        <tr style="background: #398ebd; color: white;">
                                            <th rowspan="2">РЕГИОНЫ</th>
                                            <th colspan="5" class="text-center">Доход</th>
                                            <!-- <th rowspan="2">ДОХОДЫ</th> -->
                                            <th rowspan="2">РАСХОДЫ</th>
                                            <!--    <th>СТАБ.РАСХОДЫ</th>
                                            <th>ТЕК.РАСХОДЫ</th>
                                            <th>ПРИБЫЛЬ</th>  -->
                                            <th colspan="3" class="text-center">ЧИСТАЯ ПРИБЫЛЬ </th>
                                            <th colspan="2" class="text-center">КЛИЕНТЫ</th>
                                            <th rowspan="2">ЧИСТАЯ <br> ВЫДАЧА</th>
                                            <th colspan="2" class="text-center">АУКЦИОНИСТ</th>
                                            <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                                        </tr>
                                        <tr style="background: #398ebd; color: white;">
                                            <th>ЛОМБАРДА</th>
                                            <th>МАГАЗИНА</th>
                                            <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>
                                            <!-- <th>ДОХОД КОМИССИОНКИ</th> -->
                                            <th>ДОП</th>
                                            <th>ИТОГ</th>
                                            <th>ЛОМБАРДА (-20%)</th>
                                            <th>Комиссонка</th>
                                            <th>ИТОГ</th>
                                            <th>ВСЕ </th>
                                            <th>НОВЫЕ</th>
                                            <th>ТЕХНИКА</th>
                                            <th>ШУБА</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $regions = explode(";", $access_region['regions']);
                                        if (empty($regions)) {
                                            $regions = [$region];
                                        }

                                        foreach ($regions as $region) {
                                            $lombard =  R::getAll("SELECT
                                                SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(allclients),
                                                SUM(newclients),SUM(vozvrat),
                                                SUM(nakladnoy),SUM(chv)
                                                FROM reports
                                                WHERE region = ?", [$region])[0];



                                   

                                            unset($auktech, $aukshubs, $nalvzaloge, $obs, $tbs, $accsess, $get_comission);

                                            $sales = R::getCol("SELECT SUM(pribl) FROM sales WHERE regionlombard = '$region' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");
                                            $sales = $sales[0];
                                            $all_filial = R::getCol("SELECT  adress FROM reports WHERE region='$region' GROUP BY adress ");



                                            $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                                            $accsess = $accsess[0];

                                            $p1 = R::getRow("SELECT SUM(p1) FROM tickets WHERE region = '$region' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$data_begin' AND '$data_end' ");

                                            $data81 = R::getRow(" SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");

                                            $proc = R::getRow("SELECT SUM(proc) FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");

                                            $obs = $p1['SUM(p1)'] + $proc['SUM(proc)'] + ($data81['SUM(cena_pr)'] - $data81['SUM(summa_vydachy)']) + $data81['SUM(profit)'] + ($accsess['SUM(price)'] - $accsess['SUM(purchaseamount)']) - $ras;                                                  // чистая прибыль  = за минусом 20 процентов
                                            $comission = percent($obs, 3);

                                                
                                            $datar = R::getCell("SELECT SUM(summarf) FROM rashodfillial WHERE  region ='$region'  AND datarashoda BETWEEN '$data_begin' AND '$data_end' ");

             
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
                                            $number =  $lombard['SUM(dohod)'] - $datar;

                                            $chistaya = percent($number, 20);

                                        ?>
                                            <tr>
                                                <td>
                                                    <a href="viewreportregion.php?region=<?= $region ?>" class="btn bg-olive btn-block"> <?= $region ?></a>
                                                    <!-- <a href="#" ><?= $region ?></a> -->
                                                </td>
                                                <td>
                                                    <?= number_format($lombard['SUM(dl)'], 0, '.', ' ');
                                                    $dl += $lombard['SUM(dl)']; ?>
                                                </td>
                                                <td>
                                                    <?= number_format($lombard['SUM(dm)'], 0, '.', ' ');
                                                    $dm += $lombard['SUM(dm)']; ?>
                                                </td>
                                                <td class="danger">
                                                    <?= number_format($sales, 0, '.', ' ');
                                                    $report_sales_pribl += $sales; ?>
                                                </td>
                                                <td>
                                                    <?= number_format($lombard['SUM(dop)'], 0, '.', ' ');
                                                    $dop += $lombard['SUM(dop)']; ?>
                                                </td>
                                                <td class="info">
                                                    <?= number_format($lombard['SUM(dohod)'], 0, '.', ' ');
                                                    $dohod += $lombard['SUM(dohod)']; ?>
                                                </td>
                                                <td><?= number_format($datar, 0, '.', ' ');
                                                    $rashod += $datar ?></td>
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
                                                <td><?= number_format($lombard['SUM(allclients)'], 0, '.', ' ');
                                                    $allclients += $lombard['SUM(allclients)']; ?></td>
                                                <td><?= number_format($lombard['SUM(newclients)'], 0, '.', ' ');
                                                    $newclients += $lombard['SUM(newclients)']; ?></td>
                                                <td><?= number_format($lombard['SUM(chv)'], 0, '.', ' ');
                                                    $chv += $lombard['SUM(chv)']; ?></td>
                                                <td class="success"><?= number_format($auktech, 0, '.', ' ');; ?></td>
                                                <td class="warning"><?= number_format($aukshubs, 0, '.', ' ');; ?></td>
                                                <td class="danger"><?= number_format($nalvzaloge, 0, '.', ' ');; ?></td>
                                            </tr>
                                        <? } ?>
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
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b> OBS </b></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example1">
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

                                        foreach ($regions as $region) {

                                            $lombard = R::getAll("SELECT COUNT(*) as count , SUM(p1) FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND region = $region AND dataseg BETWEEN '$data_begin' AND '$data_end'");

                                            #####################
                                            $lombard9 = R::getRow("SELECT SUM(proc) FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                                            ##################### Сумма процентов выкупленных товаров
                                            $result8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit),COUNT(*) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                                            $data8 = $result8[0];
                                            ##################### Сумма выдачи, сумма продажи и количество проданных товаров
                                            $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                                            $acc = $accsess[0];
                                            ##################### Сумма прихода и продажи товаров товаров
                                            $sales = R::getAll("SELECT SUM(pribl), SUM(remainder), SUM(summaprihod),COUNT(*) FROM sales WHERE regionlombard = '$region'  AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'   AND statustovar IS NULL ");
                                            $sale_com = $sales[0];
                                            ##################### Сумму и количество проданных товаров в магазине
                                            //Аукционист шуб
                                            $auctioneer_fur = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region'  AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND  type = 'Шубы'  ");
                                            //Аукционист техники
                                            $auctioneer_teh = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы'  ");
                                            //Нал в залоге
                                            $cash_in_pledge_end = R::getRow("SELECT SUM(summa_vydachy) FROM tickets  WHERE region = '$region' AND status = '2' ");
                                            ############################## Аукционист шуб // Аукционист техники
                                            $rashod = R::getRow("SELECT SUM(tekrashod) FROM comisstest  WHERE region = '$region' AND data BETWEEN '$data_begin' AND '$data_end' ");
                                            // var_dump($rashod)
                                        ?>
                                            <tr>
                                                <td><a class="btn btn-block bg-olive" href="viewreportregion.php?region=<?= $region; ?>"><?= $region; ?></a></td>
                                                <td>
                                                    <? echo number_format($lombard['SUM(p1)'] + $lombard9['SUM(proc)'], 0, '.', ' ');
                                                    $dohod += $lombard['SUM(p1)'] + $lombard9['SUM(proc)']; ?>
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
                                                <? $chistaya = $lombard['SUM(p1)'] + $lombard9['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)']  + ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);
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
                                                    <?= number_format($lombard['count'], 0, '.', ' ');
                                                    $count += $lombard['count']; ?>
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
                </div>
            </div><!-- /.col -->
        </section>
    </div>
<?
    include "footer.php";
else :
    header('Location: ../../index.php');
endif; ?>