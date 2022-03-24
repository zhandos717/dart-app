<?
$sql = "region = '$region' AND status = '$status' AND adressfil = '$adress'  AND dataseg BETWEEN '$data1' AND '$data2'";
$result = R::findAll('tickets', $sql)
?>


<div class="table-responsive">
    <table id="datatable-tabletools" class="tableas table table-hover table-bordered">
        <thead>
            <tr class="success">
                <th>№</th>
                <th style="width:5vh;">№ЗБ</th>
                <th>Клиент</th>
                <th>Телефон</th>
                <th style="width:45vh;">Залог</th>
                <th>Сумма выдачи</th>
                <th style="width:8vh;">Цена</th>
                <th>Дата выдачи</th>
                <th>Дата выкупа</th>
                <th>Дата возврата</th>
                <th>Кто принял</th>
                <th>Статус</th>
                <!-- <th>Действие</th> -->
            </tr>
        </thead>
        <tbody>
            <?
            $i = 1;
            foreach ($result as $data_zb) {
                $data_st = R::load('status_zb', $data_zb['status']);
                $statuszb = $data_st['name'];
            ?>
                <tr>
                    <td><?= $i++; ?>.</td>
                    <td><?= $data_zb['nomerzb']; ?></td>
                    <td><?= $data_zb['fio']; ?></td>
                    <td><?= $data_zb['phones']; ?></td>
                    <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                        SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                    </td>
                    <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['datavykup'])); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                    <td><?= $data_zb['eo']; ?></td>
                    <td><?= $statuszb; ?></td>
                </tr>
            <? } ?>
        </tbody>
        <tfoot>
            <tr class="danger">
                <th colspan="3" class="text-center">Итого:</th>
                <th colspan="3" class="text-center">Сумма выдачи: <?= number_format($data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                <th colspan="3" class="text-center">Сумма продажи: <?= number_format($data22['SUM(cena_pr)'], 0, '.', ' '); ?> тг.</th>
                <th colspan="3" class="text-center">Доход: <?= number_format($data22['SUM(cena_pr)'] - $data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
            </tr>
        </tfoot>
    </table>
</div><!-- /.table-responsive -->
<script src="/assets/plugins/table/examples.datatables.tabletools.js"></script>