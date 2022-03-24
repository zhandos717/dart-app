<?php
include("../../../bd.php");
if ($_SESSION['logged_user']->status == 10) :
    $today = date('Y-m-d');
    $region = $_POST['region'];
    $adress = $_POST['adress'];
    $kassa = $_POST['kassa'];
    $data1 = $_POST['date1'];

    $yesterday = strtotime($data1);
    $yesterday = strtotime("-1 day", $yesterday);
    $yesterday = date('Y-m-d', $yesterday);

    $result = R::findAll('tickets', " region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg = '$data1' AND NOT status = '11' AND NOT status = '1' AND comission IS NULL ");
    $tickets = R::findAll('tickets', "region = '$region' AND adressfil = '$adress' AND salerkassa= '$kassa' AND datavykup = '$data1' AND  status = '4' AND  comission IS NULL ");
    $comment = $region . ' / ' . $adress . ' за период с ' . date("d.m.Y", strtotime($data1));
    $data22 = R::findOne('repotscom', " region = '$region' AND adress = '$adress' AND kassa = '$kassa' AND datereport = '$data1'");
    $result96 = R::findAll('salecomision', "dataa = '$data1' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND zadatok IS NULL");
    $result966 = R::findAll('salecomision', "dataa = '$data1' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND zadatok IS NOT NULL");
    $productreport = R::find('productreport', 'region=? AND adress = ? AND datereg=?', [$region, $adress, $data1]);
    $endsumm = R::getCell("SELECT endsumm FROM repotscom  WHERE region = '$region' AND adress = '$adress' AND kassa = '$kassa' AND datereport = '$yesterday' ");
    // SUM(summa) 
    $replenishment = R::getCol("SELECT SUM(summa) FROM finance WHERE operationtype ='0' AND status = '2' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND dataa = '$data1' ")[0];
    $withdrawal = R::getCol("SELECT SUM(summa) FROM finance WHERE operationtype ='1' AND status = '2' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND dataa = '$data1'")[0];
?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><b> <?= $comment; ?> </b></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="tableas table table-hover table-bordered">
                                <tr class="text-center">
                                    <th rowspan="2">№ П/П</th>
                                    <th rowspan="2">Номер ЗБ</th>
                                    <th rowspan="2">Клиент</th>
                                    <th rowspan="2">Наименование залога</th>
                                    <th rowspan="2">Кол-во</th>
                                    <th rowspan="2">% по кредиту</th>
                                    <th colspan="3">Выдан кредит</th>
                                    <th rowspan="2">Вознаграждение</th>
                                    <th rowspan="2">Возврат кредита</th>
                                    <th rowspan="2">Неустойка при расторжении договора</th>
                                </tr>
                                <tr>
                                    <th style="width:5rem;"> Сумма </th>
                                    <th>Срок</th>
                                    <th>До</th>
                                </tr>
                                <tr>
                                    <th colspan="13" class="text-center"> <?= $kassa; ?></th>
                                </tr>
                                <tr>
                                    <th colspan="13" class="text-center"> Выдача</th>
                                </tr>
                                <? $i = 1;
                                foreach ($result as $data) { ?>
                                    <tr>
                                        <th><?= $i++; ?></th>
                                        <th><?= $data['nomerzb']; ?></th>
                                        <th><?= $data['fio']; ?></th>
                                        <th>
                                            <?= $data['category']; ?> <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['opisanie']; ?> <?= $data['upakovka']; ?> <?= $data['ekran']; ?> <?= $data['korpus']; ?>
                                            SN: <?= $data['sn']; ?> IMEI: <?= $data['imei']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['complect']; ?>
                                        </th>
                                        <th>1</th>
                                        <th>0,5</th>
                                        <th><?= number_format($data['summa_vydachy'], 0, '.', ' ');
                                            $summa_vydachy += $data['summa_vydachy']; ?></th>
                                        <th><?= $data['srok']; ?></th>
                                        <th><?= date("d.m.Y", strtotime($data['dv'])); ?></th>
                                        <th><?= number_format($data['p1'], 0, '.', ' ');
                                            $p1 += $data['p1']; ?></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                <? } ?>
                                <tr class="danger">
                                    <th colspan="6"> ИТОГО по выдаче</th>
                                    <th style="white-space: nowrap;"><?= number_format($summa_vydachy, 0, '.', ' '); ?></th>
                                    <th></th>
                                    <th></th>
                                    <th><?= number_format($p1, 0, '.', ' '); ?></th>
                                    <th> </th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="13" class="text-center"> Возврат</th>
                                </tr>
                                <? $i = 1;
                                foreach ($tickets as $ticket) { ?>
                                    <tr>
                                        <th><?= $i++; ?></th>
                                        <th><?= $ticket['nomerzb']; ?></th>
                                        <th><?= $ticket['fio']; ?></th>
                                        <th>
                                            <?= $ticket['category']; ?> <?= $ticket['tovarname']; ?> <?= $ticket['hdd']; ?> <?= $ticket['opisanie']; ?> <?= $ticket['upakovka']; ?> <?= $ticket['ekran']; ?> <?= $ticket['korpus']; ?>
                                            SN: <?= $ticket['sn']; ?> IMEI: <?= $ticket['imei']; ?> <?= $ticket['sostoyanie_bu']; ?> <?= $ticket['complect']; ?>
                                        </th>
                                        <th>1</th>
                                        <th>0,5</th>
                                        <th><?= number_format($ticket['summa_vydachy'], 0, '.', ' ');
                                            $summa_vydachy1 += $ticket['summa_vydachy']; ?></th>
                                        <th><?= $ticket['srok']; ?></th>
                                        <th><?= date("d.m.Y", strtotime($ticket['dv'])); ?></th>
                                        <th><?= number_format($ticket['p1'], 0, '.', ' ');
                                            $p11 += $ticket['p1']; ?></th>
                                        <th> <?= number_format($ticket['summa_vydachy'] + $ticket['proc'], 0, '.', ' ');
                                                $vozv += $ticket['summa_vydachy'] + $ticket['proc']; ?></th>
                                        <th><?= number_format($ticket['proc'], 0, '.', ' ');
                                            $proc += $ticket['proc']; ?></th>
                                    </tr>
                                <? } ?>
                                <tr class="danger">
                                    <th colspan="6"> ИТОГО по возврату</th>
                                    <th><?= number_format($summa_vydachy1, 0, '.', ' '); ?></th>
                                    <th></th>
                                    <th></th>
                                    <th><?= number_format($p11, 0, '.', ' '); ?></th>
                                    <th><?= number_format($vozv, 0, '.', ' '); ?> </th>
                                    <th><?= number_format($proc, 0, '.', ' '); ?></th>
                                </tr>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
            </div><!-- /.col-md-6 -->
            <div class="col-lg-4">
                <div class="box box-primary">
                    <section class="card">
                        <div class="card-body">
                            <table class="table table-responsive-md table-bordered mb-0">
                                <tr>
                                    <th colspan="2">ИНФОРМАЦИЯ ПО КАССАМ</th>
                                </tr>
                                <tr>
                                    <td>НА НАЧАЛО ДНЯ</td>
                                    <th><?= number_format($data22['summstart'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Пополнение касс(ы)</td>
                                    <th><?= number_format($data22['finhelp'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Изъятие из касс(ы)</td>
                                    <th><?= number_format($data22['withdrawal'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Выдано кредитов</td>
                                    <th> <?= number_format($data22['vydacha'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>% по кредиту</td>
                                    <th><?= number_format($data22['comis'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Неустойка при расторжении договора</td>
                                    <th><?= number_format($data22['proc'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Возврат кредитов</td>
                                    <th><?= number_format($data22['vozvrat'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Выручка от продаж</td>
                                    <th><?= number_format($data22['summsale'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Задаток</td>
                                    <th><?= number_format($data22['deposit'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Аксессуаров продано на сумму</td>
                                    <th><?= number_format($data22['product'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td>Прибыль от продаж</td>
                                    <th><?= number_format($data22['salesincome'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <tr>
                                    <td><strong>НА КОНЕЦ ДНЯ </strong></td>
                                    <th><?= number_format($data22['endsumm'], 0, '.', ' '); ?> тенге</th>
                                </tr>
                                <?
                                $summ_end = ($data22['summstart'] + $data22['finhelp']) - ($data22['withdrawal'] + $data22['vydacha']) + $data22['comis'] + $data22['vozvrat'] + $data22['summsale'] + $data22['deposit'] + $data22['product'];
                                if ($summ_end != $data22['endsumm']) : ?>
                                    <tr class="danger">
                                        <td><strong>Есть расхождение на </strong></td>
                                        <th><?= number_format($summ_end - $data22['endsumm'], 0, '.', ' '); ?> тенге</th>
                                    </tr>
                                    <tr class="danger">
                                        <td><strong>Сумма на конец дня</strong></td>
                                        <th><?= number_format($summ_end, 0, '.', ' '); ?> тенге</th>
                                    </tr>
                                <? endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div><!-- /.col-md-6 -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b> <?= $comment; ?> </b></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="example1" class="tableas table table-hover table-bordered">
                                <thead>
                                    <tr class="text-center table-success">
                                        <th>№</th>
                                        <th style="width:5rem;">ДАТА ПРОДАЖИ</th>
                                        <th>КОД ТОВАРА</th>
                                        <th>ТОВАР</th>
                                        <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                                        <th>ЗАДАТОК</th>
                                        <th>СУММА РЕАЛИЗАЦИИ</th>
                                        <th>ПРИБЫЛЬ</th>
                                        <th>ПРОДАВЕЦ</th>
                                        <th>Кассир</th>
                                        <th>ПОКУПАТЕЛЬ</th>
                                        <th>ИИН</th>
                                        <th>ТЕЛЕФОН</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($result96 as $data3) { ?>
                                        <tr class="text-center">
                                            <td><?= $i++; ?>.</td>
                                            <td><?= date("d.m.Y", strtotime($data3['dataa'])); ?> </td>
                                            <td> <?= $data3['codetovar']; ?> </td>
                                            <td class="text-left">
                                                <?
                                                $nomerzb = $data3['codetovar'];
                                                $data_zb = R::findOne('tickets', "nomerzb = '$nomerzb'"); ?>
                                                <?= $data_zb['category']; ?>, <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?>
                                                SN: <?= $data_zb['sn']; ?>, IMEI:<?= $data_zb['imei']; ?>,<?= $data_zb['opisanie']; ?>
                                            </td>
                                            <td><?= number_format($data3['summaprihod'], 0, '.', ' ');
                                                $summaprihod += $data3['summaprihod']; ?></td>
                                            <td><?= number_format($data3['zadatok'], 0, '.', ' ');
                                                $zadatok += $data3['zadatok']; ?></td>
                                            <td><?= number_format($data3['summareal'], 0, '.', ' ');
                                                $summareal += $data3['summareal']; ?></td>
                                            <td><?= number_format($data3['summareal'] - $data3['summaprihod'], 0, '.', ' '); ?></td>
                                            <td> <?= $data3['saler']; ?> </td>
                                            <td> <?= $data3['kassir']; ?> </td>
                                            <td> <?= $data3['pokupatel']; ?> </td>
                                            <td> <?= $data3['pokupateliin']; ?> </td>
                                            <td> <?= $data3['pokupateltel']; ?> </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center table-danger">
                                        <th></th>
                                        <th colspan="3">Итог</th>
                                        <th><?= number_format($summaprihod, 0, '.', ' '); ?></th>
                                        <th><?= number_format($zadatok, 0, '.', ' '); ?></th>
                                        <th><?= number_format($summareal, 0, '.', ' '); ?></th>
                                        <th><?= number_format($summareal - $summaprihod, 0, '.', ' '); ?></th>
                                        <th></th>
                                        <th colspan="3">Количество клиентов</th>
                                        <th><?= $data4['count']; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b> <?= $comment; ?> </b></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-hover table-bordered">
                                <thead>
                                    <tr class="text-center table-success">
                                        <th>№</th>
                                        <th style="width:5rem;">ДАТА ПРОДАЖИ</th>
                                        <th>КОД ТОВАРА</th>
                                        <th>ТОВАР</th>
                                        <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                                        <th>ЗАДАТОК</th>
                                        <th>СУММА РЕАЛИЗАЦИИ</th>
                                        <th>ПРИБЫЛЬ</th>
                                        <th>ПРОДАВЕЦ</th>
                                        <th>Кассир</th>
                                        <th>ПОКУПАТЕЛЬ</th>
                                        <th>ИИН</th>
                                        <th>ТЕЛЕФОН</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($result966 as $data3) { ?>
                                        <tr class="text-center">
                                            <td><?= $i++; ?>.</td>
                                            <td><?= date("d.m.Y", strtotime($data3['dataa'])); ?> </td>
                                            <td> <?= $data3['codetovar']; ?> </td>
                                            <td class="text-left">
                                                <? $data_zb = R::findOne('tickets', 'nomerzb = ?', [$data3['codetovar']]); ?>
                                                <?= $data_zb['category']; ?>, <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?>
                                                SN: <?= $data_zb['sn']; ?>, IMEI:<?= $data_zb['imei']; ?>,<?= $data_zb['opisanie']; ?>
                                            </td>
                                            <td><?= number_format($data3['summaprihod'], 0, '.', ' ');
                                                $summaprihod_z += $data3['summaprihod']; ?></td>
                                            <td><?= number_format($data3['zadatok'], 0, '.', ' ');
                                                $zadatok_z += $data3['zadatok']; ?></td>
                                            <td><?= number_format($data3['summareal'], 0, '.', ' ');
                                                $summareal_z += $data3['summareal']; ?></td>
                                            <td><?= number_format($data3['summareal'] - $data3['summaprihod'], 0, '.', ' '); ?></td>
                                            <td> <?= $data3['saler']; ?> </td>
                                            <td> <?= $data3['kassir']; ?> </td>
                                            <td> <?= $data3['pokupatel']; ?> </td>
                                            <td> <?= $data3['pokupateliin']; ?> </td>
                                            <td> <?= $data3['pokupateltel']; ?> </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center table-danger">
                                        <th></th>
                                        <th colspan="3">Итог</th>
                                        <th><?= number_format($summaprihod_z, 0, '.', ' '); ?></th>
                                        <th><?= number_format($zadatok_z, 0, '.', ' '); ?></th>
                                        <th><?= number_format($summareal_z, 0, '.', ' '); ?></th>
                                        <th><?= number_format($summareal_z - $summaprihod_z, 0, '.', ' '); ?></th>
                                        <th></th>
                                        <th colspan="3">Количество клиентов</th>
                                        <th><?= $data4['count']; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b> <?= $comment; ?> </b></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr class="info">
                                        <th>№</th>
                                        <th>Дата</th>
                                        <th>Регион</th>
                                        <th>Категория</th>
                                        <th>Наименование</th>
                                        <th>приход</th>
                                        <th>продажа</th>
                                        <th>прибыль</th>
                                        <th>Клиент</th>
                                        <th>Продавец</th>
                                        <th>Кассир</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? $i = 1;
                                    foreach ($productreport as $data) : ?>
                                        <tr>
                                            <td><?= $i++; ?>.</td>
                                            <td><?= date("d.m.Y", strtotime($data['datereport']));  ?></td>
                                            <td><?= $data['region']; ?></td>
                                            <td><?= $data['category']; ?></td>
                                            <td> <?= $data['name']; ?> </td>
                                            <td class="warning">
                                                <?= $data['purchaseamount'];
                                                $purchaseamount = $purchaseamount + $data['purchaseamount']; ?> тг.
                                            </td>
                                            <td class="danger">
                                                <?= $data['price'];
                                                $price = $price + $data['price'];
                                                ?>тг.
                                            </td>
                                            <td class="success">
                                                <?= $data['price'] - $data['purchaseamount'];
                                                $total = $total + ($data['price'] - $data['purchaseamount']); ?> тг.
                                            </td>
                                            <td> <?= $data['buyer']; ?> <br> <?= $data['buyeriin']; ?> </td>
                                            <td><?= $data['saler']; ?></td>
                                            <td><?= $data['user']; ?></td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="danger">
                                        <th colspan="5">ИТОГ</th>
                                        <th><?= $purchaseamount; ?>тг. </th>
                                        <th><?= $price; ?>тг. </th>
                                        <th><?= $total; ?>тг. </th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
            </div><!-- /.col-md-6 -->
            <div class="col-lg-4">
                <div class="box box-primary">
                    <section class="card">
                        <div class="card-body">

                            <table class="table table-responsive-md table-bordered mb-0">
                                <tr>
                                    <th colspan="2">Информация по кассе для сравнения </th>
                                </tr>
                                <input hidden id="id_report" value="<?= $data22['id'] ?>">
                                <tr>
                                    <td>На конец вчершенего дня <?= $yesterday; ?></td>
                                    <th id="startsumm"><?= $endsumm; ?></th>
                                </tr>
                                <tr>
                                    <td>Пополнение касс(ы)</td>
                                    <th id="replenishment"><?= $replenishment; ?></th>
                                </tr>
                                <tr>
                                    <td>Изъятие из касс(ы)</td>
                                    <th id="withdrawal"><?= $withdrawal; ?></th>
                                </tr>
                                <tr>
                                    <td>Выдано кредитов</td>
                                    <th id="summa_vydachy"><?= $summa_vydachy; ?></th>
                                </tr>
                                <tr>
                                    <td>% по кредиту</td>
                                    <th id="p1"><?= $p1; ?></th>
                                </tr>
                                <tr>
                                    <td>Неустойка при расторжении договора</td>
                                    <th id="proc"><?= $proc; ?></th>
                                </tr>
                                <tr>
                                    <td>Возврат кредитов</td>
                                    <th id="vozv"><?= $vozv; ?></th>
                                </tr>
                                <tr>
                                    <td>Выручка от продаж</td>
                                    <th id="summareal"><?= $summareal; ?></th>
                                </tr>
                                <tr>
                                    <td>Задаток</td>
                                    <th id="zadatok_z"><?= $zadatok_z; ?></th>
                                </tr>
                                <tr>
                                    <td>Аксессуаров продано на сумму</td>
                                    <th id="price"><?= $price; ?></th>
                                </tr>
                                <tr>
                                    <td>Прибыль от продаж</td>
                                    <th id="salesincome"><?= $summareal - $summaprihod; ?></th>
                                </tr>
                                <tr>
                                    <td><strong>НА КОНЕЦ ДНЯ </strong></td>
                                    <th><?= $data22['endsumm'] ?></th>
                                </tr>

                                <?php
                                $summ_end = ($endsumm + $replenishment) - ($withdrawal + $summa_vydachy) + $p1 + $vozv + $summareal + $zadatok_z + $price;
                                if ($summ_end != $data22['endsumm']) : ?>
                                    <tr class="danger">
                                        <td><strong>Есть расхождение на </strong></td>
                                        <th><?= number_format($summ_end - $data22['endsumm'], 0, '.', ' '); ?></th>
                                    </tr>
                                    <tr class="danger">
                                        <td><strong>Сумма на конец дня</strong></td>
                                        <th id="endsumm"><?= $summ_end; ?></th>
                                    </tr>
                                <? endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success col-lg-12" id="report_update">Исправить отчет</button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#report_update').click(function() {
                    let isBoss = confirm('Вы уверены?');
                    if (isBoss) {
                        let id_report = $('#id_report').val();
                        let startsumm = $('#startsumm').text();
                        let replenishment = $('#replenishment').text();
                        let withdrawal = $('#withdrawal').text();
                        let summa_vydachy = $('#summa_vydachy').text();
                        let p1 = $('#p1').text();
                        let proc = $('#proc').text();
                        let vozv = $('#vozv').text();
                        let summareal = $('#summareal').text();
                        let zadatok_z = $('#zadatok_z').text();
                        let price = $('#price').text();
                        let salesincome = $('#salesincome').text();
                        let endsumm = $('#endsumm').text();

                        $.post("functions/fix_report.php", {
                                id_report: id_report,
                                startsumm: startsumm,
                                replenishment: replenishment,
                                withdrawal: withdrawal,
                                summa_vydachy: summa_vydachy,
                                p1: p1,
                                proc: proc,
                                vozv: vozv,
                                summareal: summareal,
                                zadatok_z: zadatok_z,
                                price: price,
                                salesincome: salesincome,
                                endsumm: endsumm
                            })
                            .done(function(data) {
                                console.dir(data);
                                alert(data);
                            })
                            .fail(function(data) {
                                console.dir(data);
                                alert(data);
                            })
                    }
                });
            });
        </script>
    <?php
else :
    header('Location: /');
endif;
    ?>