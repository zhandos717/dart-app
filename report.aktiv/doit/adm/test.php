<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
    include "header.php";
    include "menu.php";

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="datatable-tabletools" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="info">
                                        <th class="text-center" rowspan="2">МАГАЗИНЫ</th>
                                        <th class="text-center" rowspan="2">ВЫРУЧКА</th>
                                        <th class="text-center" rowspan="2">ВЫРУЧКА <br> (- % банка)</th>
                                        <th class="text-center" rowspan="2">Приход.Сумма</th>
                                        <th class="text-center" rowspan="2">ПРИБЫЛЬ</th>
                                        <th class="text-center" rowspan="2">ПРИБЫЛЬ <br> (- % банка)</th>
                                        <th class="text-center" rowspan="2">КЛ.</th>
                                        <th class="text-center" rowspan="2">ПРИБЫЛЬ %</th>
                                        <th class="text-center" colspan="3">ПЛАН</th>
                                    </tr>
                                    <tr class="info">
                                        <th class="text-center">За месяц</th>
                                        <th class="text-center">В день</th>
                                        <th class="text-center">%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><a class="btn bg-olive btn-block" href="view_shop.php?region=Актау&shop=11 мкрн дом3&from=1&month=01"><b>Актау 11 мкрн дом3</b></a></th>
                                        <td class="warning">24 969 200</td>
                                        <td class="danger"> 24 485 260</td>

                                        <td>15 571 439</td>
                                        <td class="success">9 714 343</td>

                                        <td class="danger"> 8 913 821 </td>
                                        <td>211</td>
                                        <td><em><b>39 %</b></em></td>

                                        <td class="text-center">
                                            0 </td>

                                        <td class="text-center">0</td>
                                        <td class="text-center">
                                            <a title="9 714 343-0=9 714 343" class="description-percentage text-green">
                                                <i class="fa fa-caret-up"></i> 100 %</a>
                                        </td>
                                    </tr>


                                </tbody>
                                <tfoot>
                                    <tr style="background: #d3d7df; color: black;">
                                        <th class="text-center">Итого (СУММА)</th>
                                        <th class="text-center">301 656 921</th>
                                        <th class="bg-red">294 264 320</th>
                                        <th class="text-center">203 820 674</th>
                                        <th class="text-center">99 303 581</th>

                                        <th class="bg-red">90 443 646</th>
                                        <th class="text-center">2712</th>
                                        <th>33 %</th>
                                        <th class="text-center">0 тг.</th>
                                        <th class="text-center">0</th>
                                        <th class="text-center">
                                            <a title="99 303 581-0=-99 303 581" class="description-percentage text-green">
                                                <i class="fa fa-caret-up"></i> 100 %</a>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>

                    <div class="box">
                        <div class="box-body">
                            <table id="tabletools2" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="info">
                                        <th class="text-center" rowspan="2">МАГАЗИНЫ</th>
                                        <th class="text-center" rowspan="2">ВЫРУЧКА</th>
                                        <th class="text-center" rowspan="2">ВЫРУЧКА <br> (- % банка)</th>
                                        <th class="text-center" rowspan="2">Приход.Сумма</th>
                                        <th class="text-center" rowspan="2">ПРИБЫЛЬ</th>
                                        <th class="text-center" rowspan="2">ПРИБЫЛЬ <br> (- % банка)</th>
                                        <th class="text-center" rowspan="2">КЛ.</th>
                                        <th class="text-center" rowspan="2">ПРИБЫЛЬ %</th>
                                        <th class="text-center" colspan="3">ПЛАН</th>
                                    </tr>
                                    <tr class="info">
                                        <th class="text-center">За месяц</th>
                                        <th class="text-center">В день</th>
                                        <th class="text-center">%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><a class="btn bg-olive btn-block" href="view_shop.php?region=Актау&shop=11 мкрн дом3&from=1&month=01"><b>Актау 11 мкрн дом3</b></a></th>
                                        <td class="warning">24 969 200</td>
                                        <td class="danger"> 24 485 260</td>

                                        <td>15 571 439</td>
                                        <td class="success">9 714 343</td>

                                        <td class="danger"> 8 913 821 </td>
                                        <td>211</td>
                                        <td><em><b>39 %</b></em></td>

                                        <td class="text-center">
                                            0 </td>

                                        <td class="text-center">0</td>
                                        <td class="text-center">
                                            <a title="9 714 343-0=9 714 343" class="description-percentage text-green">
                                                <i class="fa fa-caret-up"></i> 100 %</a>
                                        </td>
                                    </tr>


                                </tbody>
                                <tfoot>
                                    <tr style="background: #d3d7df; color: black;">
                                        <th class="text-center">Итого (СУММА)</th>
                                        <th class="text-center">301 656 921</th>
                                        <th class="bg-red">294 264 320</th>
                                        <th class="text-center">203 820 674</th>
                                        <th class="text-center">99 303 581</th>

                                        <th class="bg-red">90 443 646</th>
                                        <th class="text-center">2712</th>
                                        <th>33 %</th>
                                        <th class="text-center">0 тг.</th>
                                        <th class="text-center">0</th>
                                        <th class="text-center">
                                            <a title="99 303 581-0=-99 303 581" class="description-percentage text-green">
                                                <i class="fa fa-caret-up"></i> 100 %</a>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>

                </div>
            </div><!-- /.row -->
        </section>
    </div>


<?
    include "footer.php";
else :
    header('Location: ../../index.php');
endif; ?>