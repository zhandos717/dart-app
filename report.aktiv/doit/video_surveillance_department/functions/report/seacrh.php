<?
include_once '../../../../bd.php';
    $table = 'tickets';
   //if($status == 12){

    $search = R::findAll($table, 'nomerzb = :search AND iin = :search ',[':search'=>$_POST['search']]);


    var_dump($_POST);
    var_dump($search);

?>


<div class="table-responsive">
    <table id="example1" class="table table-hover table-bordered">
        <thead>
            <tr class="success">
                <th>№ЗБ</th>
                <th>Клиент</th>
                <th>Телефон</th>
                <th>Залог</th>
                <th>Сумма выдачи</th>
                <th>Цена</th>
                <th>Выдано</th>
                <th>До</th>
                <th class="danger">Выкуплено</th>
                <th>Дата продажи</th>
                <th>Кто принял</th>
                <th>Статус</th>
                <!-- <th>Действие</th> -->
            </tr>
        </thead>
        <tbody>
            <?
            foreach ($search as $data_zb) {
            $statuszb =R::load('status_zb', $data_zb['status']);
            ?>
            <tr>
                <td><?= $data_zb['nomerzb']; ?></td>
                <td><?= $data_zb['fio']; ?> <br>
                    <b> ИИН:</b> <?= $data_zb['iin']; ?>
                </td>
                <td><?= $data_zb['phones']; ?></td>
                <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                    SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                </td>
                <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                <td><?= date("d.m.Y H:i:s", strtotime($data_zb['reg_data'])); ?></td>

                <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                <td class="danger" title="<?= date("d.m.Y", strtotime($data_zb['dv'])); ?>">
                    <? if($data_zb['datavykup']){echo date("d.m.Y H:i:s", strtotime($data_zb['dataatime']));}else { echo '--'; } ?>
                </td>
                <td>
                    <? if($data_zb['datesale']){echo date("d.m.Y H:i:s", strtotime($data_zb['dataatime']));}else { echo '--'; } ?>
                </td>
                <td><?= $data_zb['eo']; ?></td>
                <td title="<?= $data_zb['saler']; ?>"><?= $statuszb['name']; ?></td>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div><!-- /.table-responsive -->

<script>
    $(function() {
        $("#example1").DataTable();
    });
</script>