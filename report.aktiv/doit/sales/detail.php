<? //проверка существовании сессии
include("../../bd.php");
if ($status == 5) :
    $id = $_GET['id'];
    $data = $_GET['data'];
    $active_report = 'active';
    include "header.php";
    include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Магазин <?= $region; ?>/<?= $adress; ?> 2021
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
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="bg-blue">
                                            <th>город</th>
                                            <th>адрес ломбарда</th>
                                            <th>Дата</th>
                                            <th>Код товара</th>
                                            <th>Наименование</th>
                                            <th>Приходная сумма</th>
                                            <!--  <th>Сумма кредита</th> -->
                                            <th>Предоплата</th>
                                            <th>Сумма реализации </th>
                                            <th>Прибыль</th>
                                            <th> Прибыль <br> (-% банка)</th>
                                            <th>Вид</th>
                                            <th>Продавец</th>
                                            <th>Ф.И.О. покупателя</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $result = R::findAll('sales', "region ='$region' AND statustovar  IS NULL  AND adress ='$adress' AND data = '$data' ORDER BY data ");
                                        foreach ($result as $data1) { ?>
                                            <tr>
                                                <td><?= $data1['regionlombard']; ?></td>
                                                <td><?= $data1['adresslombard']; ?></td>
                                                <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                                                <td><?= $data1['codetovar']; ?></td>
                                                <td><?= $data1['tovarname']; ?></td>
                                                <td class="warning"><?= number_format($data1['summaprihod'], 0, '.', ' ');
                                                                    $summaprihod += $data1['summaprihod']; ?></td>
                                                <td><?= number_format($data1['predoplata'], 0, '.', ' ');
                                                    $predoplata += $data1['predoplata']; ?></td>
                                                <td class="danger"><?= number_format($data1['summareal'], 0, '.', ' ');
                                                                    $summareal += $data1['summareal']; ?></td>
                                                <td class="success"><?= number_format($data1['pribl'], 0, '.', ' ');
                                                                    $pribl += $data1['pribl']; ?></td>

                                                <td class="bg-red"> <?= number_format($data1['remainder'] - $data1['summaprihod'], 0, '.', ' ');
                                                                    $remainder += $data1['remainder'] - $data1['summaprihod']; ?> </td>
                                                <td><?= $data1['vid']; ?></td>
                                                <td><?= $data1['saler']; ?></td>
                                                <td><?= $data1['pokupatel']; ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <!-- SUM(remainder), -->
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" class="text-center">Итого</th>
                                            <th class="bg-yellow">
                                                <?= number_format($summaprihod, 0, '.', ' '); ?></th>
                                            <th class="bg-blue">
                                                <?= number_format($predoplata, 0, '.', ' '); ?></th>
                                            <th class="danger">
                                                <?= number_format($summareal, 0, '.', ' '); ?></th>
                                            <th class="bg-olive">
                                                <?= number_format($pribl, 0, '.', ' '); ?></th>
                                            <th class="bg-red">
                                                <?= number_format($remainder, 0, '.', ' '); ?></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<? include "footer.php";
else :
    header('Location: /');
endif; ?>