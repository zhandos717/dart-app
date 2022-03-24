<?php
include '../../bd.php';
if (!$status) exit;

$table = 'tickets';
if (empty($_POST['region'])) {
    if (empty($_POST['region']) && empty($_POST['term'])) {
        $sql  = 'dataseg BETWEEN :date1 AND :date2 AND NOT status IN (1,11)';
        $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } else {
        $sql  = 'srok = :term AND dataseg BETWEEN :date1 AND :date2 AND NOT status IN (1,11)';
        $placeholder = [':term' => $_POST['term'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    }
} elseif (empty($_POST['adress'])) {

    if (empty($_POST['adress']) && empty($_POST['term'])) {
        $sql  = 'region =  :region  AND dataseg BETWEEN :date1 AND :date2 AND NOT status IN (1,11)';
        $placeholder = [':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } else {
        $sql  = 'region =  :region  AND srok = :term AND dataseg BETWEEN :date1 AND :date2 AND NOT status IN (1,11)';
        $placeholder = [':region' => $_POST['region'], ':term' => $_POST['term'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    }
} elseif ($_POST['adress'] != 'Все') {
    if ($_POST['srok'] == 'Все') {
        $sql  = 'region =  :region  AND adressfil =  :adress  AND dataseg BETWEEN :date1 AND :date2 AND NOT status IN (1,11)';
        $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    } else {
        $sql  = 'region =  :region  AND adressfil =  :adress  AND srok = :term AND dataseg BETWEEN :date1 AND :date2 AND NOT status IN (1,11)';
        $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region'], ':term' => $_POST['term'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    }
}
$result = R::findAll($table, $sql, $placeholder);
?>
<table id="example1" class="table table-bordered">
    <thead>
        <tr>
            <th>№</th>
            <th>Адрес</th>
            <th>Номер договора</th>
            <th>Данные клиента клиента</th>
            <th>Наименование</th>
            <th>Сумма выдачи</th>
            <th>Дата выдачи</th>
            <th>Срок</th>
            <th>Статус</th>
            <th>Дата выкупа</th>
            <th>Подробнее</th>
        </tr>
    </thead>
    <tbody>
        <? $i = 1;
        foreach ($result as $row) {
            $statuszb = R::getCell('SELECT name FROM status_zb WHERE id = ?', [$row['status']]);
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $row['region']; ?> / <?= $row['adressfil']; ?> </td>
                <td><?= $row['nomerzb']; ?></td>
                <td><?= $row['fio']; ?> <br>ИИН: <?= $row['iin']; ?> </td>
                <td><?= $row['type']; ?> <?= $row['category']; ?> <?= $row['tovarname']; ?> <?= $row['opisanie']; ?> </td>
                <td><?= $row['summa_vydachy']; ?></td>
                <td><?= date('d.m.Y', strtotime($row['dataseg'])); ?></td>
                <td><?= $row['srok']; ?></td>
                <td><?= $statuszb; ?></td>
                <td><?= date('d.m.Y', strtotime($row['dv'])); ?></td>
                <td> <a href="edit?id=<?= $row['id']; ?>" class="btn btn-success btn-block"> <i class="fa fa-file-text-o"></i> </a> </td>
            </tr>
        <? } ?>
    </tbody>
</table>

<script>
    $(function() {
        $("#example1").DataTable();
    });
</script>