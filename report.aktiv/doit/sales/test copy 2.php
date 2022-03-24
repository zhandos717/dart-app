<?php
include_once __DIR__ . '/../../bd.php';

if (!$_SESSION['logged_user']->status == 1) header('Location: /');

$blacklist = R::getAll('SELECT tickets.id ,tickets.status , tickets.nomerzb , tickets.fio ,  tickets.imei, tickets.reg_data, tickets.adressfil  FROM blacklist JOIN tickets ON blacklist.imei = tickets.imei WHERE tickets.reg_data > "2022-01-03" LIMIT 300');
?>

<table>
    <tr>
        <td>Адресс</td>
        <td>Номер билета</td>
        <td>Когда заложили</td>
        <td>Кто заложил</td>
        <td>IMEI</td>
        <td>Статус</td>
    </tr>
    <? foreach ($blacklist as $v) : ?>
        <tr>
            <td><?= $v['adressfil']; ?></td>
            <td><?= $v['nomerzb']; ?></td>
            <td><?= $v['reg_data']; ?></td>
            <td><?= $v['fio']; ?></td>
            <td><?= $v['imei']; ?></td>
            <td><?= $v['status']; ?></td>
        </tr>
    <? endforeach; ?>
</table>