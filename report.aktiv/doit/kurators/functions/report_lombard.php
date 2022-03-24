<? include_once "../../../bd.php";

$table =strip_tags(htmlspecialchars($_POST['table'], ENT_QUOTES));
$adres = strip_tags(htmlspecialchars($_POST['adres'], ENT_QUOTES));

if(!empty($adres)){?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr style="background: #398ebd; color: white;">
            <th style="width: 10px">#</th>
            <th>Дата</th>
            <th>Доход ломбард</th>
            <th>Доход магазин</th>
            <th>Доп доход</th>
            <th>Доход</th>
            <th>Стабильные расходы</th>
            <th>Текущие расходы</th>
            <th>ПРИБЫЛЬ</th>
            <th>Чистая прибыль (-20%)</th>
            <th>Все клиенты</th>
            <th>Новые клиенты</th>
            <th>Выдача за сутки</th>
            <!--  <th>Возврат</th>
                        <th>Накладные</th> -->
            <th>Чистая выдача</th>
            <th>Аукционист техника</th>
            <th>Аукционист шубы</th>
            <th>Нал в залоге</th>
        </tr>
    </thead>
    <tbody>
        <?
        $result = R::getAll("SELECT *FROM $table WHERE  `adress`='$adress' ORDER BY data ");
        foreach ($result as $data1) {?>
        <tr>
            <td>
                <!--<a href="look.php?id=<?= $data1['id']; ?>"><i class="fa fa-pencil"></i></a>-->
            </td>
            <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
            <td><?= number_format($data1['dl'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['dm'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['dop'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['dohod'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['stabrashod'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['tekrashod'], 0, '.', ' '); ?>
                <? if (strlen($data1['comment']) != 0) echo '<font style="color:red">+</font>'; ?>
            </td>
            <?
                $pribl = $data1['dohod'] - $data1['stabrashod'] - $data1['tekrashod'];
                $pr20 = ($pribl * 20) / 100;
                $chistpribl = $pribl - $pr20;
            ?>
            <td><strong><?= number_format($pribl, 0, '.', ' '); ?></strong></td>
            <td><strong><?= number_format($chistpribl, 0, '.', ' '); ?></strong></td>
            <td><?= number_format($data1['allclients'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['newclients'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['vzs'], 0, '.', ' '); ?></td>
            <!--   <td><?= number_format($data1['vozvrat'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['nakladnoy'], 0, '.', ' '); ?></td>-->
            <td><?= number_format($data1['chv'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['auktech'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['aukshubs'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['nalvzaloge'], 0, '.', ' '); ?></td>
        </tr>
        <? } ?>
    </tbody>
    <tfoot>
        <tr style="background: #398ebd; color: white;">
            <?
                $result2 = mysqli_query($connect, " SELECT id, region, auktech, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                from $table WHERE adress ='$adress' ");
                $data2 = mysqli_fetch_array($result2);
            ?>
            <th>*</th>
            <th>Итого</th>
            <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
            <?
            $summapribl = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];
            $pr20 = ($summapribl * 20) / 100;
            $summachistpribl = $summapribl - $pr20;
            ?>
            <th><?= number_format($summapribl, 0, '.', ' '); ?></th>
            <th><?= number_format($summachistpribl, 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(vzs)'], 0, '.', ' '); ?></th>
            <!--  <th><?= number_format($data2['SUM(vozvrat)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(nakladnoy)'], 0, '.', ' '); ?></th>-->
            <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
            <th>
                <?
            $result3 = mysqli_query($connect, " SELECT * FROM $table WHERE segdata=(SELECT MAX(segdata) FROM $table WHERE adress ='$adress') ");
            $data3 = mysqli_fetch_array($result3);
            ?>
                <?= number_format($data3['auktech'], 0, '.', ' '); ?>
            </th>
            <th><?= number_format($data3['aukshubs'], 0, '.', ' '); ?></th>
            <th><?= number_format($data3['nalvzaloge'], 0, '.', ' '); ?></th>
        </tr>
    </tfoot>
</table>
<?}else{?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr style="background: #398ebd; color: white;">
            <th>Адрес филиала</th>
            <th>Доход ломбард</th>
            <th>Доход магазин</th>
            <th>Доп доход</th>
            <th>Доходы</th>
            <th>Стаб расходы</th>
            <th>Текущие расходы</th>
            <th>ПРИБЫЛЬ</th>
            <th>Чистая прибыль (-20%)</th>
            <th>Все клиенты</th>
            <th>Новые клиенты</th>
            <th>Чистая выдача</th>
            <th>Аукционист техника</th>
            <th>Аукционист шубы</th>
            <th>Нал в залоге</th>
        </tr>
    </thead>
    <tbody>
        <?
            $result = R::getAll("SELECT adress,id, region, SUM(dl),SUM(dm),SUM(dop), SUM(stabrashod), SUM(dohod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
            FROM $table WHERE `region`='$region' GROUP BY `adress` ");
            foreach ($result as $data1) {
            $filial =  $data1['adress'];
            ?>
        <tr>
            <td>
                <button class="btn btn-block bg-red adres" data-table='<?= $table; ?>' value="<?= $data1['adress']; ?>"><?= $data1['adress']; ?> </button>
            </td>
            <td><?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td>
            <?
                          $pribl = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                          $pr20 = ($pribl * 20) / 100;
                          $chistpribl = $pribl - $pr20;
                          ?>
            <td><?= number_format($pribl, 0, '.', ' '); ?></td>
            <td><strong><?= number_format($chistpribl, 0, '.', ' '); ?></strong></td>
            <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
            <?
            $result3 = mysqli_query($connect, " SELECT * FROM $table WHERE segdata=(SELECT MAX(segdata) FROM $table WHERE region = '$region' AND adress = '$filial' ) ");
            $data12 = mysqli_fetch_array($result3);
            ?>
            <td><?= number_format($data12['auktech'], 0, '.', ' '); ?></td>
            <td><?= number_format($data12['aukshubs'], 0, '.', ' '); ?></td>
            <td><?= number_format($data12['nalvzaloge'], 0, '.', ' '); ?></td>
        </tr>
        <? } ?>
    </tbody>
    <tfoot>
        <tr style="background: #d3d7df; color: black;">
            <?
            $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
            from $table WHERE region = '$region' ");
            $data2 = mysqli_fetch_array($result2);
            ?>
            <th>Итого</th>
            <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
            <?
            $summapribl = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];
            $pr20 = ($summapribl * 20) / 100;
            $summachistpribl = $summapribl - $pr20;
            ?>
            <th><?= number_format($summapribl, 0, '.', ' '); ?></th>
            <th style="background: #00c2f0; color: black;"><?= number_format($summachistpribl, 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
            <?
            $result4 = mysqli_query($connect, "SELECT *FROM $table WHERE region='$region' GROUP BY adress ");
            $s = 0;
            $s2 = 0;
            $s3 = 0;
            while ($data4 = mysqli_fetch_array($result4)) {
            $filial =  $data4['adress'];
            $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM $table WHERE segdata=(SELECT MAX(segdata) FROM $table WHERE region = '$region' AND adress = '$filial' ) ");
            $data5 = mysqli_fetch_array($result5);
            //echo " * ".$data5['auktech']." * ";
            $s += $data5['auktech'];
            $s2 += $data5['aukshubs'];
            $s3 += $data5['nalvzaloge'];
            }
            ?>
            <th style="background: #00a759; color: black;"><?= number_format($s, 0, '.', ' '); ?></th>
            <th style="background: #f39d0a; color: black;"><?= number_format($s2, 0, '.', ' '); ?></th>
            <th style="background: #de4936; color: black;"><?= number_format($s3, 0, '.', ' '); ?></th>
        </tr>
    </tfoot>
</table>
<?}?>
<script>
    $(function() {
        $('.adres').click(function(e) {
            var adres = $(this).val();
            var table = $(this).data('table');
            console.log(table);
            $.post('functions/report_lombard.php', {
                    table: table,
                    adres: adres
                })
                .done(function(data) {
                    $('.answer').html(data);
                });
        });
    })
</script>