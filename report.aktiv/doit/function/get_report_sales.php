<?php
include '../../bd.php';

if (!empty($_POST['region']) && empty($_POST['adress'])) {
    $sql = ' region= :region AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';
    $array = [':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
} else if (!empty($_POST['region']) && !empty($_POST['adress'])) {
    $sql = 'region = :region AND adress = :adress AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';
    $array = [':region' => $_POST['region'], ':adress' => $_POST['adress'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
}
$search = R::findAll('sales', $sql, $array);
?>


<table class="table table-bordered table-hover" id='datatable-tabletools'>
    <thead>
        <tr class="info">
            <th>№</th>
            <th>ДАТА</th>
            <th>КОД ТОВАРА</th>
            <th>Адрес филиала</th>
            <th>ТОВАР</th>
            <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
            <th>СУММА РЕАЛИЗАЦИИ</th>
            <th>Итого к реализации -комиссия </th>
            <th>Вид оплаты</th>
            <th>Сумма оплаты</th>
            <th>Вид оплаты</th>
            <th>Сумма оплаты</th>
            <th>Вид оплаты</th>
            <th>Сумма оплаты</th>
            <th>Вид оплаты</th>
            <th>Сумма оплаты</th>
            <th>ПРИБЫЛЬ</th>
            <th>ПРИБЫЛЬ - %</th>
            <th>ПРОДАВЕЦ</th>
            <th>ПОКУПАТЕЛЬ</th>
        </tr>
    </thead>
    <tbody>
        <? $i = 1;
        foreach ($search as $data1) { ?>
            <tr>
                <td><?= $i++; ?>.</td>
                <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                <td> <button data-id="<?= $data1['id']; ?>" class="btn btn-success btn-block update" data-toggle="modal" data-target="#exampleModal"><?= $data1['codetovar']; ?> </button> </td>
                <td>
                    <?= $data1['regionlombard'] . '/' . $data1['adresslombard']; ?>
                </td>
                <td><?= $data1['tovarname']; ?></td>
                <td class="warning"><?= number_format($data1['summaprihod'], 0, '.', ' ');
                                    $summaprihod += $data1['summaprihod']; ?></td>
                <td class="danger"><?= number_format($data1['summareal'], 0, '.', ' ');
                                    $summareal += $data1['summareal']; ?></td>
                <td class="bg-primary"><?= number_format($data1['remainder'], 0, '.', ' ');
                                        $remainder += $data1['remainder']; ?></td>
                <td class="warning"><?= $data1['vid1'] ?></td>
                <td class="danger"><?= number_format($data1['summareal1'], 0, '.', ' ');
                                    $summareal1 += $data1['summareal1']; ?></td>
                <td class="warning"><?= $data1['vid2'] ?></td>
                <td class="danger"><?= number_format($data1['summareal2'], 0, '.', ' ');
                                    $summareal2 += $data1['summareal2']; ?></td>
                <td class="warning"><?= $data1['vid3'] ?></td>
                <td class="danger"><?= number_format($data1['summareal3'], 0, '.', ' ');
                                    $summareal3 += $data1['summareal3']; ?></td>
                <td class="warning"><?= $data1['vid4'] ?></td>
                <td class="danger"><?= number_format($data1['summareal4'], 0, '.', ' ');
                                    $summareal4 += $data1['summareal4']; ?></td>
                <td class="success"><?= number_format($data1['pribl'], 0, '.', ' ');
                                    $pribl += $data1['pribl']; ?></td>
                <td class="info"> <?
                                    if ($data1['remainder']) {
                                        echo number_format($data1['remainder'] - $data1['summaprihod'], 0, '.', ' ');
                                        $remainder1 += $data1['remainder'] - $data1['summaprihod'];
                                    } ?></td>
                <td><?= $data1['saler']; ?></td>
                <td><?= $data1['pokupatel']; ?></td>
            </tr>
        <? } ?>
    </tbody>
    <tfoot>
        <tr class="bg-gray">
            <th colspan="5" class="text-center">Итого</th>
            <th class="bg-yellow">
                <?= number_format($summaprihod, 0, '.', ' '); ?></th>
            <th class="bg-red">
                <?= number_format($summareal, 0, '.', ' '); ?></th>
            <th class="bg-primary"><?= number_format($remainder, 0, '.', ' '); ?> </th>
            <td></td>
            <th class="bg-red">
                <?= number_format($summareal1, 0, '.', ' '); ?></th>
            <th></th>
            <th class="bg-red">
                <?= number_format($summareal2, 0, '.', ' '); ?></th>
            <td></td>
            <th class="bg-red">
                <?= number_format($summareal3, 0, '.', ' '); ?></th>
            <td></td>
            <th class="bg-red">
                <?= number_format($summareal4, 0, '.', ' '); ?></th>


            <th class="bg-olive">
                <?= number_format($pribl, 0, '.', ' '); ?></th>

            <th><?= number_format($remainder1, 0, '.', ' '); ?> </th>
            <th colspan="2"> </th>
        </tr>
    </tfoot>
</table>
<script>
    $(function() {
        $('.update').click(function(e) {
            var id = $(this).data('id');
            $.post('../function/upd_sales.php', {
                    id: id
                })
                .done(function(data) {
                    $('.modal-body').html(data);
                });
        });
        $('#get_region').change(function() {
            var region = $(this).val();
            $('#adress').load('../function/get_adress.php', {
                shop: region
            });
        });
        $('form').submit(function(e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function(data) {
                $('.answer').html(data);
            }).fail(function() {
                alert('Ошибка');
            });
            e.preventDefault();
        });
    });
</script>
<script src="/assets/plugins/table/examples.datatables.tabletools.js"></script>