<? 
include_once '../../../../bd.php';

if(!empty($_POST['regions'])){
function percent($number) {
	$percent = '20';
	$number_percent = $number / 100 * $percent;
	return $number - $number_percent;
}
function percent_comiss($number) {
	$percent = '3';
	$number_percent = $number / 100 * $percent;
	return $number - $number_percent;
}
$data =  explode("-", $_POST["datarange"]);
$data_begin = date('Y-m-d',strtotime($data[0]));
$data_end   = date('Y-m-d',strtotime($data[1]));


// $table = 'reports';
// $result = R::getAll("SELECT SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod), SUM(stabrashod),SUM(tekrashod),SUM(allclients), SUM(newclients),SUM(vzs),SUM(vozvrat), SUM(nakladnoy),COUNT(adress),SUM(chv)
//             FROM '$table' 
//             WHERE adress = '$adress' 
//             AND data BETWEEN '$data_begin' 
//             AND '$data_end' 
//             GROUP BY adress");

?>
<div class="table-responsive">
    <table class="table table-bordered table-hover" style="white-space:nowrap;" id="example1">
        <thead>
            <tr class="info">
                <th rowspan="2">РЕГИОНЫ</th>
                <th colspan="5" class="text-center">Доход</th>
                <th rowspan="2">РАСХОДЫ</th>
                <th colspan="2" class="text-center">ЧИСТАЯ ПРИБЫЛЬ </th>
                <th colspan="2" class="text-center">КЛИЕНТЫ</th>
                <th rowspan="2">ЧИСТАЯ <br> ВЫДАЧА</th>
                <th colspan="2" class="text-center">АУКЦИОНИСТ</th>
                <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
            </tr>
            <tr class="bg-olive">
                <th>ЛОМБАРДА</th>
                <th>МАГАЗИНА</th>
                <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th>
                <th>ДОП</th>
                <th>ИТОГ</th>
                <th>ЛОМБАРДА (-20%)</th>
                <!-- <th>TBS (-3%)</th>
                <th>OBS (-3%)</th> -->
                <th>ИТОГ</th>
                <th>ВСЕ </th>
                <th>НОВЫЕ</th>
                <th>ТЕХНИКА</th>
                <th>ШУБА</th>
            </tr>
        </thead>
        <tbody>
            <?
        foreach($_POST['regions'] as $key => $adress){
            $result = R::getAll("SELECT SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod), SUM(stabrashod),SUM(tekrashod),SUM(allclients), SUM(newclients),SUM(vzs),SUM(vozvrat), SUM(nakladnoy),COUNT(adress),SUM(chv)
            FROM reports WHERE adress = '$adress' AND data BETWEEN '$data_begin' AND '$data_end' GROUP BY adress");
            $data1 = $result[0];

            
            $sales = R::getAll("SELECT SUM(pribl) FROM sales WHERE adresslombard = '$adress' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");
            $sale12 = $sales[0];
            $data5 = R::findOne('reports','adress =? ORDER BY id DESC LIMIT 1',[$adress]);
            $auktech = $data5['auktech'];
            $aukshubs = $data5['aukshubs'];
            $nalvzaloge = $data5['nalvzaloge'];
            $auktech_total += $auktech; // Итог аукционист техники
            $aukshubs_total += $aukshubs;  // Итог аукционист шуб
            $nalvzaloge_total += $nalvzaloge; // Итог нал залогов
            $dl += $data1['SUM(dl)'];   //  итог доходов ломбардов
            $dm += $data1['SUM(dm)'];  // итог доходов 
            $report_sales_pribl += $sale12['SUM(pribl)']; // Итог прибыли
            $dop += $data1['SUM(dop)']; // Итог доп дохода
            $dohod += $data1['SUM(dohod)']; // Итог доходов
            $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'] ; // Итог прибыли
            $chistaya = percent($chistaya); // Отнимаем КПН
            $rashod += $data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)']; // Итог расходов
            $chistaya_total += $chistaya; // Итог чистая прибыль 
            $tbsTotal += $tbs; // итог ТБС
            $obsTotal += $obs; // итог ОБС
            $chv += $data1['SUM(chv)']; // Чистая выдача 
            $allclients += $data1['SUM(allclients)']; //итог всех клиентов
            $newclients += $data1['SUM(newclients)']; //итог новых клиентов
        ?>
            <tr>
                <td><a href="viewreportregion.php?region=<?= $data5['region']  ?>"> <?= $adress  ?></a></td>
                <td>
                    <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
                </td>
                <td>
                    <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
                </td>
                <td class="danger">
                    <?= number_format($sale12['SUM(pribl)'], 0, '.', ' '); ?>
                </td>
                <td>
                    <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                </td>
                <td class="info">
                    <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                </td>
                <td>
                    <?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?>
                </td>
                <td class="bg-aqua"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                <!-- <th>
                    <?= number_format($tbs, 0, '.', ' '); ?>
                </th>
                <th class="danger">
                    <?= number_format($obs, 0, '.', ' '); ?>
                </th> -->
                <th class="success"><?= number_format($obs + $chistaya + $tbs, 0, '.', ' '); ?>
                </th>
                <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                <td class="bg-olive">
                    <?= number_format($auktech, 0, '.', ' ');  ?>
                </td>
                <td class="bg-orange">
                    <?= number_format($aukshubs, 0, '.', ' '); ?>
                </td>
                <td class="bg-red">
                    <?= number_format($nalvzaloge, 0, '.', ' '); ?>
                </td>
                <? unset($s,$s2,$s3,$obs,$tbs,$accsess );}?>
        </tbody>
        <tfoot>
            <tr style="background: #d3d7df; color: black;">
                <th>Итого (СУММА)</th>
                <th><?= number_format($dl, 0, '.', ' '); ?></th>
                <th><?= number_format($dm, 0, '.', ' '); ?></th>
                <th class="danger"><?= number_format($report_sales_pribl, 0, '.', ' '); ?></th>
                <th><?= number_format($dop, 0, '.', ' '); ?></th>
                <th><?= number_format($dohod, 0, '.', ' '); ?></th>
                <th><?= number_format($rashod, 0, '.', ' '); ?></th>
                <th class="bg-aqua"><strong><?= number_format($chistaya_total, 0, '.', ' '); ?></strong></th>
                <!-- <th> <?= number_format($tbsTotal, 0, '.', ' '); ?> </th>
                <th class="danger"><?= number_format($obsTotal, 0, '.', ' '); ?></th>-->
                <th class="success"><?= number_format($obsTotal + $chistaya_total + $tbsTotal, 0, '.', ' '); ?></th>
                <th><?= number_format($allclients, 0, '.', ' '); ?></th>
                <th><?= number_format($newclients, 0, '.', ' '); ?></th>
                <th><?= number_format($chv, 0, '.', ' '); ?></th>
                <td class="bg-olive"><?= number_format($auktech_total, 0, '.', ' ');  ?></td>
                <td class="bg-orange"><?= number_format($aukshubs_total, 0, '.', ' ');; ?></td>
                <td class="bg-red"><?= number_format($nalvzaloge_total, 0, '.', ' ');; ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        // $(".select3").select2();
        $("#example1").DataTable();
    });
</script>
<?}else{
    header('Location: /');
}?>