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
              $result = R::getAll("SELECT COUNT(*) as count , SUM(p1), region FROM tickets WHERE NOT (status = '11' OR status = '1' ) AND (region = 'Караганда' OR region = 'Кокшетау' OR region = 'Костанай' OR region = 'Павлодар' OR region = 'Нур-Султан') AND dataseg BETWEEN '$data_begin' AND '$data_end'  GROUP BY region  ");
              foreach ($result as $data1) {
                ##################### Регион
                $region = $data1['region'];
                #####################
                $data19 = R::getRow("SELECT SUM(proc) FROM tickets WHERE region = '$region' AND status = '4' AND datavykup BETWEEN '$data_begin' AND '$data_end' ");
                ##################### Сумма процентов выкупленных товаров
                $result8 = R::getAll("SELECT SUM(summa_vydachy), SUM(cena_pr),SUM(profit),COUNT(*) FROM tickets  WHERE region = '$region' AND status = '5' AND datesale BETWEEN '$data_begin' AND '$data_end'  ");
                $data8 = $result8[0];
                ##################### Сумма выдачи, сумма продажи и количество проданных товаров
                $accsess = R::getAll("SELECT SUM(price),SUM(purchaseamount) FROM productreport WHERE region ='$region' AND datereg BETWEEN '$data_begin' AND '$data_end' ");
                $acc = $accsess[0];
                ##################### Сумма прихода и продажи товаров товаров
                $sales = R::getAll("SELECT SUM(pribl),COUNT(*),SUM(summaprihod) FROM sales WHERE regionlombard = '$region'  AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'   AND statustovar IS NULL ");
                $sale = $sales[0];
                ##################### Сумму и количество проданных товаров в магазине
                //Аукционист шуб
                $auctioneer_fur = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region'  AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND  type = 'Шубы'  ");
                //Аукционист техники
                $auctioneer_teh = R::getRow("SELECT SUM(summa_vydachy) FROM tickets WHERE region = '$region' AND (status = '7' OR status = '10' OR status = '14' OR status = '15' ) AND NOT type = 'Шубы'  ");
                //Нал в залоге
                $cash_in_pledge_end = R::getRow("SELECT SUM(summa_vydachy) FROM tickets  WHERE region = '$region' AND status = '2' ");
                ############################## Аукционист шуб // Аукционист техники
                $rashod = R::getRow("SELECT SUM(summa_vydachy) FROM comisstest  WHERE region = '$region' AND data BETWEEN '$data_begin' AND '$data_end' ");
                // var_dump($rashod)
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
                  <td class="danger"><?= number_format($sale['SUM(pribl)'], 0, '.', ' ');
                                      $dohodml += $sale['SUM(pribl)']; ?></td>
                  <td class="danger"><?= $sale['COUNT(*)'];
                                      $countml += $sale['COUNT(*)']; ?></td>
                  <!-- <td>0</td> -->
                  <? $chistaya = $data1['SUM(p1)'] + $data19['SUM(proc)'] + ($data8['SUM(cena_pr)'] - $data8['SUM(summa_vydachy)']) + $data8['SUM(profit)'] - $data451['SUM(summa)'] + ($acc['SUM(price)'] - $acc['SUM(purchaseamount)']);
                  $ch = percent_comiss($chistaya);
                  ?>

                  <th><?= number_format($chistaya, 0, '.', ' '); ?></th>
                  <td><?= $rashod[0] ?></td>
                  <td class="info">
                    <?= number_format($ch, 0, '.', ' ');
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
                <td></td>
                <td class="bg-blue"><?= number_format($total_ch, 0, '.', ' '); ?></td>

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
  <!--  -->
  <div class="col-xs-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title"><b> TBS </b></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" style="white-space:nowrap;">
            <thead>
              <tr class="bg-blue">
                <th rowspan="2">РЕГИОНЫ</th>
                <th rowspan="2">КОМИССИОНКА</th>
                <th colspan="5" class="text-center">МАГАЗИН доход</th>
                <!-- <th>ДОП <br> ДОХОДЫ</th> -->
                <!-- <th rowspan="2">ДОХОДЫ</th> -->
                <!-- <th>РАСХОДЫ</th> -->
                <th rowspan="2">ПРИБЫЛЬ</th>
                <th rowspan="2">РАСХОД</th>
                <th rowspan="2">ПРИБЫЛЬ-3 % </th>
                <!-- ЧИСТАЯ -->
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
              <? $result1 = R::findAll('comision2region', "data = ? AND region IS NOT NULL GROUP BY region", [$day]); //(region = 'Талдыкорган' OR region = 'Уральск' OR region = 'Атырау')
              foreach ($result1 as $data2) {
                $region = $data2['region'];
                $sales = R::getAll("SELECT SUM(pribl),COUNT(*),SUM(summaprihod) FROM sales WHERE regionlombard = '$region' AND fromtovar = '2' AND data BETWEEN '$data_begin' AND '$data_end'  AND statustovar IS NULL   ");
                $sale1 = $sales[0];

                $ras = R::getCol("SELECT SUM(tekrashod) FROM comisstest WHERE region=? AND data BETWEEN '$data_begin' AND '$data_end' ", [$data2['region']]);
                $ras = $ras[0];
              ?>
                <tr>
                  <td><a class="btn btn-block bg-olive"><?= $data2['region']; ?></a></td>
                  <td>
                    <?= number_format($data2['comis'] + $data2['proc'], 0, '.', ' ');
                    $dohod1 += $data2['comis'] + $data2['proc']; ?>
                  </td>

                  <td>
                    <?= $data2['sales'];
                    $count_sales += $data2['sales']; ?>
                  </td>
                  <td>
                    <?= number_format(($data2['cena_pr'] - $data2['sale']) + $data2['profit'], 0, '.', ' ');
                    $dohodm1 += ($data2['cena_pr'] - $data2['sale']) + $data2['profit'] + ($data2['price'] - $data2['purchaseamount']); ?>
                  </td>
                  <td>
                    <?= number_format($data2['price'] - $data2['purchaseamount'], 0, '.', ' ');
                    $accses_tbs += ($data2['price'] - $data2['purchaseamount']);  ?>
                  </td>

                  <td class="danger"><?= number_format($sale1['SUM(pribl)'], 0, '.', ' ');
                                      $dohodml_tbs += $sale1['SUM(pribl)']; ?></td>
                  <td class="danger"><?= $sale1['COUNT(*)'];
                                      $countml_tbs += $sale1['COUNT(*)']; ?></td>
                  <!-- Аксесуары -->
                  <? $chistaya1 = $data2['comis'] + $data2['proc'] + ($data2['cena_pr'] - $data2['sale']) + $data2['profit'] + ($data2['price'] - $data2['purchaseamount']) - $ras;
                  $tbs_chistaya = percent_comiss($chistaya1);
                  ?>

                  <th>
                    <?= number_format($chistaya1, 0, '.', ' '); ?></th>
                  <th>
                    <?= number_format($ras, 0, '.', ' ');
                    $ras_total += $ras; ?></th>


                  <th class="info"> <?= number_format($tbs_chistaya, 0, '.', ' ');
                                    $total_tbs_ch += $tbs_chistaya; ?> </th>
                  <td>
                    <?= number_format($data2['count'], 0, '.', ' ');
                    $count1 += $data2['count']; ?>
                  </td>
                  <td class="success">
                    <? echo number_format($data2['tehnica'], 0, '.', ' ');
                    $summa_vydachy1 += $data2['tehnica']; ?>
                  </td>
                  <td class="warning">
                    <? echo number_format($data2['shuby'], 0, '.', ' ');
                    $summa_vydachy21 += $data2['shuby']; ?>
                  </td>
                  <td title="<?= 'В магазине: ' . number_format($sale1['SUM(summaprihod)'], 0, '.', ' ') . '- По базе: ' . number_format($data2['sale'], 0, '.', ' ')  ?>"> <?= number_format($sale1['SUM(summaprihod)'] - $data2['sale'], 0, '.', ' ');
                                                                                                                                                                            $auct_tbs += $sale1['SUM(summaprihod)'] - $data2['sale']; ?></td>
                  <td class="danger">
                    <? echo number_format($data2['nal'], 0, '.', ' ');
                    $summa_vydachy31 += $data2['nal'];
                    ?>
                  </td>
                </tr>
              <? }; ?>
            </tbody>
            <tfoot>
              <tr style="background: #d3d7df; color: black;">
                <th>Итого (СУММА)</th>
                <th><?= number_format($dohod1, 0, '.', ' '); ?></th>
                <th><?= $count_sales; ?></th>
                <th><?= number_format($dohodm1, 0, '.', ' '); ?></th>

                <td>
                  <?= number_format($accses_tbs, 0, '.', ' '); ?>
                </td>
                <th class="bg-red"><?= number_format($dohodml_tbs, 0, '.', ' '); ?></th>
                <th class="bg-red"><?= number_format($countml_tbs, 0, '.', ' '); ?></th>
                <th><?= number_format($dohodm1 + $dohod1, 0, '.', ' '); ?></th>
                <th><?= number_format($ras_total, 0, '.', ' '); ?></th>
                <th class="bg-blue"><?= number_format($total_tbs_ch, 0, '.', ' '); ?></th>
                <th><?= number_format($count1, 0, '.', ' '); ?></th>
                <th><?= number_format($summa_vydachy1, 0, '.', ' '); ?></th>
                <th><?= number_format($summa_vydachy21, 0, '.', ' '); ?></th>
                <td><?= number_format($auct_tbs, 0, '.', ' '); ?> </td>
                <th><?= number_format($summa_vydachy31, 0, '.', ' '); ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
