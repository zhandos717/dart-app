<? include ("../../../bd.php");
if ($_SESSION['logged_user']) :
    $data_begin = $_REQUEST['date1']; //Дата начало
    $data_end   = $_REQUEST['date2']; //Дата конец
    //$day =  $data_end;
    //$month =  date('m');

    function percent($number, $percent){
        return $number-($number/100*$percent);
    }

    //if($_POST['view_report'] == 1){
    $sql = "SELECT region,
    SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),
    SUM(stabrashod),SUM(tekrashod),SUM(allclients),
    SUM(newclients),SUM(vzs),SUM(vozvrat),
    SUM(nakladnoy),SUM(chv)
    FROM reports
    WHERE data BETWEEN '$data_begin'
    AND '$data_end'
    GROUP  BY region";
   /* }else{
    $sql = "SELECT region, adress
    SUM(dl),SUM(dm),SUM(dop), SUM(dk), SUM(dohod),
    SUM(stabrashod),SUM(tekrashod),SUM(allclients),
    SUM(newclients),SUM(vzs),SUM(vozvrat),
    SUM(nakladnoy),SUM(chv)
    FROM reports
    WHERE data BETWEEN '$data_begin'
    AND '$data_end'
    GROUP BY adress";
    };*/

    $result = R::getAll($sql); //ORDER BY SUM(dl) ASC

    if ($data_begin) : ?>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">

        <table class="table table-bordered table-hover" style="white-space:nowrap;" id="datatable-tabletools">
            <!-- datatable-tabletools  -->
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
                <? foreach ($result as $data) {
                    $region =  $data['region'];

                    $sales = R::getCol("SELECT SUM(pribl) FROM sales WHERE regionlombard = '$region' AND fromtovar = '1'  AND data BETWEEN '$data_begin' AND '$data_end' AND statustovar IS NULL  ");
                    $sales = $sales[0];
                    unset($auktech, $aukshubs, $nalvzaloge, $obs, $tbs, $accsess);

                    $get_comission = R::getCol("SELECT SUM(net_profit) FROM reportstotal WHERE region='$region' AND date_report = '$data_end'   GROUP BY region ");
                    $comission = $get_comission[0];
                    $all_filial = R::getCol("SELECT adress FROM reports WHERE region='$region' GROUP BY adress ");


                    foreach ($all_filial as $filial) {
                        $total = R::getAll(" SELECT auktech,aukshubs,nalvzaloge FROM reports WHERE data BETWEEN '$data_begin' AND '$data_end' AND adress = '$filial' ORDER BY segdata DESC  ");
                        $total = $total[0];
                        $auktech += $total['auktech'];
                        $aukshubs += $total['aukshubs'];
                        $nalvzaloge += $total['nalvzaloge'];
                    }



                    $auktech_total +=  $auktech;
                    $aukshubs_total += $aukshubs;
                    $nalvzaloge_total += $nalvzaloge;
                    $number =  $data['SUM(dohod)'] - ($data['SUM(stabrashod)'] + $data['SUM(tekrashod)']);
                    $chistaya = percent($number, 20); // чистая прибыль  = за минусом 20 процентов
                ?>
                    <tr>
                        <td>
                          <a href="filtrFiliall.php?data_begin=<?=$data_begin;?>&data_end=<?=$data_end;?>&region=<?=$region;?>" >
                            <?= $region ?>
                          </a>
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
        <script src="/assets/plugins/table/examples.datatables.tabletools.js"></script>
						</div>
						</div>
					</div>
<!--
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
                      <th colspan="3" class="text-center">МАГАЗИН доход</th>
                      <th rowspan="2">ПРИБЫЛЬ</th>
                      <th rowspan="2">РАСХОД</th>
                      <th rowspan="2">ВСЕ <br> КЛИЕНТЫ</th>
                      <th rowspan="2">АУКЦИОНИСТ <br> ТЕХНИКА</th>
                      <th rowspan="2">АУКЦИОНИСТ <br> ШУБА</th>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $result = R::getAll("SELECT
						SUM(income),
						region,
						SUM(auctioneer_teh),
						SUM(number_of_sales),
						SUM(number_of_clients),
						SUM(auctioneer_fur),
						SUM(cash_in_pledge_end),
						SUM(store_income),
						SUM(accses_obs),
						SUM(profit),
						SUM(net_profit)
						FROM reportstotal
						WHERE date_report = '$data_end' AND too = 'OBS'
						GROUP BY region");
                    foreach ($result as $data1) {
                    ?>
                      <tr>
                        <td><a class="btn btn-block bg-olive" href="viewreportregion.php?region=<?= $data1['region']; ?>">
							<?= $data1['region'];?>
							</a>
						 </td>
                        <td>
                          <? echo number_format($data1['SUM(income)'], 0, '.', ' ');
                          $income += $data1['SUM(income)']; ?>
                        </td>
                        <td><?= $data1['SUM(number_of_sales)'];
                            $number_of_sales += $data1['SUM(number_of_sales)']; ?></td>
                        <td>
                          <?= number_format($data1['SUM(store_income)'], 0, '.', ' ');
                          $store_income += $data1['SUM(store_income)']; ?>
                        </td>
                        <th>
                          <?= number_format($data1['SUM(accses_obs)'], 0, '.', ' ');
                          $accses_obs += $data1['SUM(accses_obs)'];  ?>
                        </th>
                        <th><?= number_format($data1['SUM(profit)'], 0, '.', ' ');
							$profit += $data1['SUM(profit)']?></th>
                        <td class="info">
                          <?= number_format($data1['SUM(net_profit)'], 0, '.', ' ');
                          $net_profit += $data1['SUM(net_profit)']; ?>
                        </td>

                        <td>
                          <?= number_format($data1['SUM(number_of_clients)'], 0, '.', ' ');
                          $number_of_clients += $data1['SUM(number_of_clients)']; ?>
                        </td>
                        <td class="success">
                          <?= number_format($data1['SUM(auctioneer_teh)'], 0, '.', ' ');
                          $auctioneer_teh += $data1['SUM(auctioneer_teh)']; ?>
                        </td>
                        <td class="warning">
                          <?= number_format($data1['SUM(auctioneer_fur)'], 0, '.', ' ');
                          $auctioneer_fur += $data1['SUM(auctioneer_fur)']; ?>
                        </td>
                        <td class="danger">
                          <?= number_format($data1['SUM(cash_in_pledge_end)'], 0, '.', ' ');
                          $cash_in_pledge_end += $data1['SUM(cash_in_pledge_end)'];
                          ?>
                        </td>
                      </tr>
                    <? }; ?>
                  </tbody>
                  <tfoot>
                    <tr class="bg-gray">
                      <th>Итого (СУММА)</th>
                      <th><?= number_format($income, 0, '.', ' '); ?></th>
                      <td> <?= $number_of_sales; ?></td>
                      <th><?= number_format($store_income, 0, '.', ' '); ?></th>
                      <th><?= number_format($accses_obs, 0, '.', ' '); ?></th>
                      <th><?= number_format($profit, 0, '.', ' '); ?></th>

                      <th><?= number_format($net_profit, 0, '.', ' '); ?></th>
                      <th><?= number_format($number_of_clients, 0, '.', ' '); ?></th>
                      <th><?= number_format($auctioneer_teh, 0, '.', ' '); ?></th>
                      <td><?= number_format($auctioneer_fur, 0, '.', ' '); ?> </td>
                      <th>
                        <? echo number_format($cash_in_pledge_end, 0, '.', ' ');?>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
</div>

<div class="col-xs-12">
          <div class="box box-info">
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
                <table class="table table-bordered table-hover" id="example1">
                  <thead style="white-space:nowrap;">
                    <tr class="bg-blue">
                      <th rowspan="2">РЕГИОНЫ</th>
                      <th rowspan="2">КОМИССИОНКА</th>
                      <th colspan="3" class="text-center">МАГАЗИН доход</th>
                      <th rowspan="2">ПРИБЫЛЬ</th>
                      <th rowspan="2">РАСХОД</th>
                      <th rowspan="2">ВСЕ <br> КЛИЕНТЫ</th>
                      <th rowspan="2">АУКЦИОНИСТ <br> ТЕХНИКА</th>
                      <th rowspan="2">АУКЦИОНИСТ <br> ШУБА</th>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $result = R::getAll("SELECT
						SUM(income),
						region,
						SUM(auctioneer_teh),
						SUM(number_of_sales),
						SUM(number_of_clients),
						SUM(auctioneer_fur),
						SUM(cash_in_pledge_end),
						SUM(store_income),
						SUM(accses_obs),
						SUM(profit),
						SUM(net_profit)
						FROM reportstotal
						WHERE date_report = '$data_end' AND too = 'TBS'
						GROUP BY region");
                    foreach ($result as $data1) {
                    ?>
                      <tr>
                        <td><a class="btn btn-block bg-olive" href="viewreportregion.php?region=<?= $data1['region']; ?>">
							<?= $data1['region'];?>
							</a>
						 </td>
                        <td>
                          <?= number_format($data1['SUM(income)'], 0, '.', ' ');
                          $income1 += $data1['SUM(income)']; ?>
                        </td>
                        <td><?= $data1['SUM(number_of_sales)'];
                            $number_of_sales1 += $data1['SUM(number_of_sales)']; ?></td>
                        <td>
                          <?= number_format($data1['SUM(store_income)'], 0, '.', ' ');
                          $store_income1 += $data1['SUM(store_income)']; ?>
                        </td>
                        <th>
                          <?= number_format($data1['SUM(accses_obs)'], 0, '.', ' ');
                          $accses_obs1 += $data1['SUM(accses_obs)'];  ?>
                        </th>
                        <th><?= number_format($data1['SUM(profit)'], 0, '.', ' ');
							$profit1 += $data1['SUM(profit)']?></th>
                        <td class="info">
                          <?= number_format($data1['SUM(net_profit)'], 0, '.', ' ');
                          $net_profit1 += $data1['SUM(net_profit)']; ?>
                        </td>

                        <td>
                          <?= number_format($data1['SUM(number_of_clients)'], 0, '.', ' ');
                          $number_of_clients1 += $data1['SUM(number_of_clients)']; ?>
                        </td>
                        <td class="success">
                          <?= number_format($data1['SUM(auctioneer_teh)'], 0, '.', ' ');
                          $auctioneer_teh1 += $data1['SUM(auctioneer_teh)']; ?>
                        </td>
                        <td class="warning">
                          <?= number_format($data1['SUM(auctioneer_fur)'], 0, '.', ' ');
                          $auctioneer_fur1 += $data1['SUM(auctioneer_fur)']; ?>
                        </td>
                        <td class="danger">
                          <?= number_format($data1['SUM(cash_in_pledge_end)'], 0, '.', ' ');
                          $cash_in_pledge_end1 += $data1['SUM(cash_in_pledge_end)'];
                          ?>
                        </td>
                      </tr>
                    <? }; ?>
                  </tbody>
                  <tfoot>
                    <tr class="bg-gray">
                      <th>Итого (СУММА)</th>
                      <th><?= number_format($income1, 0, '.', ' '); ?></th>
                      <td> <?= $number_of_sales1; ?></td>
                      <th><?= number_format($store_income1, 0, '.', ' '); ?></th>
                      <th><?= number_format($accses_obs1, 0, '.', ' '); ?></th>
                      <th><?= number_format($profit1, 0, '.', ' '); ?></th>

                      <th><?= number_format($net_profit1, 0, '.', ' '); ?></th>
                      <th><?= number_format($number_of_clients1, 0, '.', ' '); ?></th>
                      <th><?= number_format($auctioneer_teh1, 0, '.', ' '); ?></th>
                      <td><?= number_format($auctioneer_fur1, 0, '.', ' '); ?> </td>
                      <th>
                        <? echo number_format($cash_in_pledge_end1, 0, '.', ' ');?>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>

         -->
<?
endif;
endif;
?>
