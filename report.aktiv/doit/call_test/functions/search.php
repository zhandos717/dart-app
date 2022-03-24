<?
include("../../../bd.php");
if (isset($_POST['search'])) {
    $sql = 'iin LIKE :search  OR phones LIKE :search OR category LIKE :search OR tovarname LIKE :search OR nomerzb LIKE :search LIMIT 50';
    $placeholder = [':search' => "%{$_POST['search']}%"];
    $search = R::findAll('tickets', $sql, $placeholder);
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
            foreach ($search as $row) {
                $statuszb = R::load('status_zb', $row['status']);
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
                    <td><?= $statuszb['name']; ?></td>
                    <td><?= date('d.m.Y', strtotime($row['dv'])); ?></td>
                    <td> <a href="index.php?id=2&did=<?= $row['id']; ?>" class="btn btn-success btn-block"> <i class="fa fa-file-text-o"></i> </a> </td>
                </tr>
            <? } ?>
        </tbody>
    </table>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
<? } else {
    header("Location: /");
}; ?>