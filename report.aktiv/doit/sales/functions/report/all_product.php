<?
include_once '../../../../bd.php';
$table = 'tickets';

if ($_POST['region'] == 'Все') {
    if ($_POST['status'] == 'Все') {
        $sql  = 'dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } else {
        $sql  = 'status = :status AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':status' => $_POST['status'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    }
} elseif ($_POST['adress'] == 'Все') {
    if ($_POST['status'] == 'Все') {
        $sql  = 'region =  :region  AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } else {
        $sql  = 'region =  :region  AND status = :status AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':region' => $_POST['region'], ':status' => $_POST['status'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    }
} elseif ($_POST['adress'] != 'Все') {
    if ($_POST['status'] == 'Все') {
        $sql  = 'region =  :region  AND adressfil =  :adress  AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } else {
        $sql  = 'region =  :region  AND adressfil =  :adress  AND status = :status AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region'], ':status' => $_POST['status'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    }
}
$result = R::findAll($table, $sql, $placeholder);
?>
<div class="table-responsive">
    <table id="datatable-tabletools" class="table table-hover table-bordered">
        <thead>
            <tr class="success">
                <th>№ЗБ</th>
                <th>Клиент</th>
                <th>Телефон</th>
                <th>Залог</th>
                <th>Сумма выдачи</th>
                <th>Цена</th>
                <th>Дата выдачи</th>
                <th>Дата выкупа</th>
                <th>Дата продажи</th>
                <th>Кто принял</th>
                <th>Статус</th>
                <!-- <th>Действие</th> -->
            </tr>
        </thead>
        <tbody>
            <?
            foreach ($result as $data_zb) {
                $statuszb = R::load('status_zb', $data_zb['status']);
            ?>
                <tr <? if ($data_zb['srok'] == 0) : ?> class="info" <? endif ?>>
                    <td><?= $data_zb['nomerzb']; ?></td>
                    <td><?= $data_zb['fio']; ?></td>
                    <td><?= $data_zb['phones']; ?></td>
                    <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                    </td>
                    <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                    <td>
                        <? if ($data_zb['dateshop']) {
                            echo date("d.m.Y", strtotime($data_zb['dateshop']));
                        } else {
                            echo '--';
                        } ?>
                    </td>
                    <td><?= $data_zb['eo']; ?></td>
                    <td><?= $statuszb['name']; ?></td>
                </tr>
            <? } ?>
        </tbody>
        <tfoot>
            <tr class="danger">
                <th colspan="3" class="text-center">Итого:</th>
                <th colspan="3" class="text-center">Сумма выдачи: <?= number_format($data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                <th colspan="3" class="text-center">Сумма продажи: <?= number_format($data22['SUM(cena_pr)'], 0, '.', ' '); ?> тг.</th>
                <th colspan="2" class="text-center">Доход: <?= number_format($data22['SUM(cena_pr)'] - $data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
            </tr>
        </tfoot>
    </table>
</div><!-- /.table-responsive -->
<script src="/assets/plugins/table/examples.datatables.tabletools.js"></script>