<?
include("../../../../bd.php");
$table = 'tickets';

if (!empty($_POST['date1'])) {
    if ($_POST['region'] == '') {
        $sql  = 'status IN(7,10,14,15) AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } elseif ($_POST['adress'] == '') {
        $sql  = 'status IN(7,10,14,15) AND  region =  :region  AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } elseif ($_POST['adress'] != '') {
        $sql  = 'status IN(7,10,14,15) AND  region =  :region  AND adressfil =  :adress  AND dataseg BETWEEN :date1 AND :date2';
        $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    }
} else {
    if ($_POST['region'] == '') {
        $sql  = 'status IN(7,10,14,15)';
        $placeholder = [];
    } elseif ($_POST['adress'] == '') {
        $sql  = 'status IN(7,10,14,15) AND  region =  :region ';
        $placeholder = [':region' => $_POST['region']];
    } elseif ($_POST['adress'] != '') {
        $sql  = 'status IN(7,10,14,15) AND  region =  :region  AND adressfil =  :adress';
        $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region']];
    }
}
$data = R::findAll($table, $sql, $placeholder);
?>
<table class="table table-hover table-bordered" id="datatable-tabletools">
    <thead>
        <tr class="bg-olive">
            <th>№</th>
            <th>Код товара</th>
            <th>Адрес</th>
            <th>Описание</th>
            <th>Дата поступлния в магазин</th>
            <th>Сумма прихода</th>
            <th>Сумма продажи</th>
            <th>Срок на продаже</th>
        </tr>
    </thead>
    <tbody>
        <?
        $i = 1;
        foreach ($data as $param) {
            $day = (int) round((strtotime(date('Y-m-d')) - strtotime($param['dv'])) / (60 * 60 * 24));
            if ($day >= 30) {
                $color = 'danger';
                $color1 = 'red';
                $count += 1;
            }
        ?>
            <tr class="<?= $color; ?>">
                <td> <?= $i++; ?>.</td>
                <td> <?= $param['nomerzb']; ?></td>
                <td> <?= $param['region']; ?>-<?= $param['adressfil']; ?></td>
                <td>
                    <? echo $param['type'] . '  ' . $param['category'] . '  ' . $param['tovarname'] . '  ' . $param['opisanie'] . '  ' . $param['hdd']; ?>
                </td>
                <td> <?= date('d.m.Y', strtotime($param['dv'])); ?></td>
                <td> <?= $param['summa_vydachy']; ?></td>
                <td> <?= $param['cena_pr']; ?></td>
                <td>
                    <span class="badge bg-<?= $color1; ?>">
                        <? echo $day;
                        unset($color, $color1); ?>
                    </span>
                </td>
            </tr>
        <? } ?>
    </tbody>
    </tfoot>
</table>
<script>
    (function($) {
        'use strict';
        var datatableInit = function() {
            var $table = $('#datatable-tabletools');

            var table = $table.dataTable({
                sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
                buttons: ["copy", "excel", "csv", "pdf", "print"]
            });

            $('<div />').addClass('dt-buttons mb-2 pb-1 text-right').prependTo('#datatable-tabletools_wrapper');
            $table.DataTable().buttons().container().prependTo('#datatable-tabletools_wrapper .dt-buttons');
            $('#datatable-tabletools_wrapper').find('.btn-secondary').removeClass('btn-secondary').addClass('btn-default');
        };
        $(function() {
            datatableInit();
        });
    }).apply(this, [jQuery]);
</script>