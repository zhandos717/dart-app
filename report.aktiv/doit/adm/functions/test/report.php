<? include_once '../../../../bd.php'; ?>

<table class="table table-bordered table-hover" id="datatable-tabletools" style="white-space:nowrap;">
    <thead>
        <tr class="bg-blue">
            <th>Филиалы</th>
            <th>Доход <br> ЛОМБАРДА</th>
            <th>Доход <br> МАГАЗИНА</th>
            <th>ДОП <br> Доход</th>
            <th>ИТОГ</th>
            <th>РАСХОДЫ</th>
            <th>ЛОМБАРДА (-20%)</th>
            <th>КОМИССИОНКА (-3%)</th>
            <th>ИТОГ</th>
            <th>ВСЕ <br> КЛИЕНТЫ</th>
            <th>НОВЫЕ <br> КЛИЕНТЫ</th>
            <th>ЧИСТАЯ <br> ВЫДАЧА</th>
            <th>ТЕХНИКА</th>
            <th>ШУБА</th>
            <th>НАЛ В <br> ЗАЛОГЕ</th>
        </tr>
    </thead>
    <tbody>
        <?
                   $result = mysqli_query($connect, " SELECT id, region,adress, SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                                       FROM reports WHERE region = '$region'  GROUP BY adress  ");
                   while ($data1 = mysqli_fetch_array($result)) {
                    $region =  $data1['region'];
                    $adress=  $data1['adress'];
                    $table =R::getCol("SELECT SUM(tekrashod),adress FROM comisstest WHERE adress=? AND data BETWEEN '2021-02-01' AND '2021-02-28' ",[$adress]);
                    $ras =$table[0];
                    $res = R::getRow("SELECT * FROM reports WHERE adress = '$adress' ORDER BY reg_date DESC LIMIT 1");
                    if($adress == 'Тауелсыздык 45/1'){
                    $adress1 = 'Тауелсыздык 45';
                    }elseif($adress == 'Шахтеров (Ермекова) 52'){
                    $adress1 = 'Шахтеров 52';
                    }elseif($adress == 'Назарбекова 11 (Нурсат)'){
                    $adress1 = 'Назарбекова 11';
                    }elseif($adress == 'Уалиханова 192 (11 мкрн)'){
                    $adress1 = 'Уалиханова 192';
                    }else {
                    $adress1 = $adress;
                    }
                    $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                    $chistaya_lombard = percent($pr);
               
                    if(!empty($comis2)){
                        $tbs_reg = R::findOne('comision2','adress=? AND data = ? ',[$adress1,$day]);
                    };
                    if(!empty($tbs_reg)){
                    $chistaya1= $tbs_reg['comis']+$tbs_reg['proc']+($tbs_reg['cena_pr']-$tbs_reg['sale'])+$tbs_reg['profit']-$tbs_reg['SUM(summa)']-$ras;
                    }else {
              

                    $result12 =$mysqli->query("SELECT SUM(summa_vydachy),SUM(p1),SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND NOT (status = '11' OR status = '1') AND dataseg BETWEEN '2021-02-01' AND '2021-02-28' ");
                    $data89 = mysqli_fetch_array($result12);
                    $result19 =$mysqli->query("SELECT SUM(proc)  FROM tickets WHERE adressfil = '$adress1' AND status = '4' AND datavykup BETWEEN '2021-02-01' AND '2021-02-28' ");
                    $data19 = mysqli_fetch_array($result19);
                    $result81 = mysqli_query($connect, " SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit) FROM tickets  WHERE adressfil = '$adress1' AND status = '5' AND datesale BETWEEN '2021-02-01' AND '2021-02-28'  ");
                    $data81 = mysqli_fetch_array($result81);

                    $chistaya1 = $data89['SUM(p1)']+$data19['SUM(proc)']+($data81['SUM(cena_pr)']-$data81['SUM(summa_vydachy)'])+$data81['SUM(profit)']-$ras; // чистая прибыль  = за минусом 20 процентов
                    }
                    $chistaya1 = percent_comiss($chistaya1);
                    ?>
        <tr>
            <td><a href="viewfilial.php?region=<?= $region; ?>&adress=<?= $data1['adress']; ?>"><?= $data1['adress']; ?></a></td>
            <td>
                <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
            </td>
            <td>
                <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
            </td>
            <td>
                <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
            </td>
            <td class="info">
                <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
            </td>
            <td><?= number_format($data1['SUM(tekrashod)'] + $data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
            <td style="background: #00c2f0; color: black;"><strong><?= number_format($chistaya_lombard, 0, '.', ' '); ?></strong></td>
            <th class="danger"><?= number_format($chistaya1, 0, '.', ' ');
                                $chistaya_tbs += $chistaya1; ?></th>
            <th class="success"><?= number_format($chistaya_lombard + $chistaya1, 0, '.', ' '); ?></th>
            <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
            <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
            <?
                       $result4 = mysqli_query($connect, "SELECT *FROM reports WHERE adress='$adress' GROUP BY adress ");
                       $s = 0;
                       $s2 = 0;
                       $s3 = 0;
                       while ($data4 = mysqli_fetch_array($result4)) {
                         $filial =  $data4['adress'];
                         $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports WHERE segdata=(SELECT MAX(segdata) FROM reports WHERE region = '$region' AND adress = '$filial' ) ");
                         $data5 = mysqli_fetch_array($result5);

                         $s += $data5['auktech'];
                         $s2 += $data5['aukshubs'];
                         $s3 += $data5['nalvzaloge'];
                       }
                       ?>
            <td style="background: #00a759; color: black;"><?= number_format($s, 0, '.', ' ');; ?></td>
            <td style="background: #f39d0a; color: black;"><?= number_format($s2, 0, '.', ' ');; ?></td>
            <td style="background: #de4936; color: black;"><?= number_format($s3, 0, '.', ' ');; ?></td>
        </tr>
        <? } ?>
    </tbody>
    <tfoot>
        <tr class="bg-gray">
            <th>Итого (СУММА)</th>
            <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
            <!-- <th><?= number_format($data2['SUM(dk)'], 0, '.', ' '); ?></th> -->
            <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
            <!--    <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                       <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th> -->
            <!--   <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td> -->
            <th><?= number_format($data2['SUM(stabrashod)'] + $data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
            <th style="background: #00c2f0; color: black;"><?= number_format($chistaya, 0, '.', ' '); ?></th>
            <th class="danger"><?= number_format($chistaya_tbs, 0, '.', ' '); ?></th>
            <th class="success"><?= number_format($chistaya_tbs + $chistaya, 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
            <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
            <th style="background: #00a759; color: black;"><?= number_format($ss, 0, '.', ' '); ?></th>
            <th style="background: #f39d0a; color: black;"><?= number_format($ss2, 0, '.', ' '); ?></th>
            <th style="background: #de4936; color: black;"><?= number_format($ss3, 0, '.', ' '); ?></th>
        </tr>
    </tfoot>
</table>