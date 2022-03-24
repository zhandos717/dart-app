<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 1) :
    include "header.php";
    include "menu.php";
    function percent($number, $percent)
    {
        return $number - ($number / 100 * $percent);
    }

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $region; ?>/<?= $adress; ?>
                <small><a href="index.php">назад к списку</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php">Регионы</a></li>
                <li class="active">Филиалы</li>
            </ol>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Отчет за ломбард</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <?





                                        $result = R::getAll(" SELECT id, adress,
              SUM(dl),SUM(dm),SUM(dop), SUM(dk),
              SUM(dohod),SUM(stabrashod),SUM(tekrashod),
              SUM(allclients),SUM(newclients),SUM(vzs),
              SUM(vozvrat),SUM(nakladnoy),COUNT(adress),
              SUM(chv)
                  from reports012022 WHERE adress = '$adress' ");
                                        $data1 = $result[0];
                                        $start = '2022-01-01';
                                        $end = '2022-01-31';
                                        $table = R::getCol("SELECT SUM(tekrashod) FROM comisstest WHERE region=? AND adress=? AND data BETWEEN '$start' AND '$end'  ", [$region, $adress]);
                                        $ras = $table[0];

                                        $chistaya = percent($data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'], 20);

                                        $reg = ['Нур-Султан', 'Кокшетау', 'Павлодар', 'Кокшетау', 'Костанай', 'Караганда', 'Петропавловск'];
                                        $data5 = R::getAll("SELECT auktech,aukshubs,nalvzaloge FROM reports122021 WHERE segdata=(SELECT MAX(segdata) FROM reports122021 WHERE adress = '$adress ' )");
                                        $data5 = $data5[0];

                                        if (in_array($region, $reg)) {
                                            $data89 = R::getAll("SELECT COUNT(*) as count ,SUM(summa_vydachy)  FROM tickets WHERE adressfil = '$adress' AND NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$start' AND '$end' ");
                                            $data11 = R::getCol(" SELECT SUM(p1) FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND dataseg BETWEEN '$start' AND '$end' AND adressfil = '$adress'  ");
                                            $data19 = R::getCol(" SELECT SUM(proc) FROM tickets WHERE status = '4'  AND datavykup BETWEEN '$start' AND '$end' AND adressfil = '$adress'  ");
                                            $tehnica = R::getCol("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND  (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы' ");
                                            $data122 = R::getCol("SELECT SUM(summa_vydachy) FROM tickets WHERE adressfil = '$adress' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND type = 'Шубы'  ");
                                            $data55 = R::getCol("SELECT SUM(summa_vydachy) FROM tickets  WHERE adressfil = '$adress'  AND status = '2' ");
                                            $data8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress' AND status = '5' AND datesale BETWEEN '$start' AND '$end'  ");
                                            $shuby = $data122[0];
                                            $nal =  $data55[0];
                                            $tehnica = $tehnica[0];
                                            $proc = $data19[0];
                                            $comis = $data11[0];
                                            $count = $data89[0]['count'];
                                            $summa_vydachy = $data89[0]['summa_vydachy'];
                                            $sale = $data8[0]["SUM(summa_vydachy)"];
                                            $cena_pr = $data8[0]["SUM(cena_pr)"];
                                            $chistaya1 = percent(($cena_pr - $sale) + ($comis + $proc) - $ras, 3);
                                            // $s = 'Пока';
                                        } ?>
                                        <thead>
                                            <tr>
                                                <th><?= $adress; ?></th>
                                                <th class="info">Ломбард</th>
                                                <th class="warning">Комиссионка </th>
                                                <th class="danger">ИТОГ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>ДОХОД</th>
                                                <td class="info"><?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?></td>
                                                <td class="warning"> <?= number_format($comis + $proc, 0, '.', ' '); ?> </td>
                                                <td class="danger"><?= number_format($data1['SUM(dl)'] + $comis + $proc, 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>ДОХОД МАГАЗИНА</th>
                                                <td class="info"><?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format($cena_pr - $sale, 0, '.', ' '); ?> </td>
                                                <td class="danger"><?= number_format($data1['SUM(dm)'] + ($cena_pr - $sale) + $data8['SUM(profit)'], 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>ДОП ДОХОДЫ</th>
                                                <td class="info"><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
                                                <td class="warning">0</td>
                                                <td class="danger"><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>ДОХОДЫ</th>
                                                <td class="info"><?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format(($cena_pr - $sale) + ($comis + $proc), 0, '.', ' '); ?> </td>
                                                <td class="danger"><?= number_format((($cena_pr - $sale) + ($comis + $proc)) + $data1['SUM(dohod)'], 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>РАСХОДЫ</th>
                                                <td class="info"><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format($ras, 0, '.', ' '); ?></td>
                                                <td class="danger"><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'] + $ras, 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>ЧИСТАЯ ПРИБЫЛЬ (-20%)</th>
                                                <td class="info"><?= number_format($chistaya, 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format($chistaya1, 0, '.', ' '); ?></td>
                                                <td class="danger"><?= number_format($chistaya + $chistaya1, 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>ВСЕ КЛИЕНТЫ</th>
                                                <td class="info"><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format($count, 0, '.', ' '); ?></td>
                                                <td class="danger"><?= number_format($data1['SUM(allclients)'] + $count, 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>НОВЫЕ КЛИЕНТЫ</th>
                                                <td class="info"><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                                                <td class="warning">-</td>
                                                <td class="danger"><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>ЧИСТАЯ ВЫДАЧА</th>
                                                <td class="info"><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                                                <td class="warning">-</td>
                                                <td class="danger"><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                                            </tr>
                                            <tr>
                                                <th>АУКЦИОНИСТ ТЕХНИКА</th>
                                                <td class="info"><?= number_format($data5['auktech'], 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format($tehnica, 0, '.', ' ');; ?></td>
                                                <td class="danger"><?= number_format($tehnica + $data5['auktech'], 0, '.', ' ');; ?></td>
                                            </tr>
                                            <tr>
                                                <th>АУКЦИОНИСТ ШУБА</th>
                                                <td class="info"><?= number_format($data5['aukshubs'], 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format($shuby, 0, '.', ' ');; ?></td>
                                                <td class="danger"><?= number_format($data5['aukshubs'] + $shuby, 0, '.', ' ');; ?></td>
                                            </tr>
                                            <tr>
                                                <th>НАЛ В ЗАЛОГЕ</th>
                                                <td class="info"><?= number_format($data5['nalvzaloge'], 0, '.', ' '); ?></td>
                                                <td class="warning"><?= number_format($nal, 0, '.', ' '); ?></td>
                                                <td class="danger"><?= number_format($data5['nalvzaloge'] + $nal, 0, '.', ' '); ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
    </div><!-- /.content-wrapper -->
<? include "footer.php";
else :
    header('Location: /');
endif; ?>
