<?  
    include("../../../bd.php");
    if($_SESSION['logged_user']) :
    
    $data_begin = $_REQUEST['date1']; //Дата начало
    $data_end   = $_REQUEST['date2']; //Дата конец
    
    function percent($number, $percent){
        return $number - ($number / 100 * $percent);
    }
    if ($data_begin) : ?>
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
                                    <th rowspan="2">ЧИСТАЯ</th>
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
                                                <?= $data1['region']; ?>
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
                                            $profit += $data1['SUM(profit)'] ?></th>
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
                                        <? echo number_format($cash_in_pledge_end, 0, '.', ' '); ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->


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
                                    <th rowspan="2">ЧИСТАЯ</th>
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
                                                <?= $data1['region']; ?>
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
                                            $profit1 += $data1['SUM(profit)'] ?></th>
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
                                        <? echo number_format($cash_in_pledge_end1, 0, '.', ' '); ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
<?
    endif;
endif;
?>