<?
include_once '../../../../bd.php';

if ($status == 12) :
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
    } elseif (!empty($_POST['search'])) {
        $search = trim($_POST['search']);
        $sql  = 'nomerzb = :search  OR iin = :search';
        $placeholder = [':search' => $search];
    } elseif ($_POST['adress'] != 'Все') {

        if ($_POST['status'] == 'Все') {
            $sql  = 'region =  :region  AND adressfil =  :adress  AND dataseg BETWEEN :date1 AND :date2';
            $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
        } else {
            $sql  = 'region =  :region  AND adressfil =  :adress  AND status = :status AND dataseg BETWEEN :date1 AND :date2';
            $placeholder = [':adress' => $_POST['adress'], ':region' => $_POST['region'], ':status' => $_POST['status'], ':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
        }
    }
    $result = R::findAll($table, $sql, $placeholder); ?>


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
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ($result as $ticket) {
                    $statuszb = R::load('status_zb', $ticket['status']);
                ?>
                    <tr>
                        <td><?= $ticket['nomerzb']; ?></td>
                        <td><?= $ticket['fio']; ?> <br>
                            <b> ИИН:</b> <?= $ticket['iin']; ?>
                            <button data-toggle="modal" data-id="<?= $ticket['id']; ?>" class="fa fa-newspaper-o btn btn-warning view" data-target="#modal-default"></button>
                        </td>
                        <td><?= $ticket['phones']; ?></td>
                        <td><?= $ticket['category']; ?> <?= $ticket['tovarname']; ?> <?= $ticket['hdd']; ?> <?= $ticket['upakovka']; ?> <?= $ticket['ekran']; ?> <?= $ticket['korpus']; ?> <?= $ticket['opisanie']; ?>
                            SN: <?= $ticket['sn']; ?> IMEI: <?= $ticket['imei']; ?> <?= $ticket['sostoyanie_bu']; ?> <?= $ticket['complect']; ?>
                        </td>
                        <td><?= number_format($ticket['summa_vydachy'], 0, '.', ' '); ?></td>
                        <td><?= number_format($ticket['cena_pr'], 0, '.', ' '); ?></td>
                        <td><?= date("d.m.Y H:i:s", strtotime($ticket['reg_data'])); ?></td>

                        <td><?= date("d.m.Y", strtotime($ticket['dv'])); ?></td>
                        <td class="danger" title="<?= date("d.m.Y", strtotime($ticket['dv'])); ?>">
                            <? if ($ticket['datavykup']) {
                                echo date("d.m.Y H:i:s", strtotime($ticket['dataatime']));
                            } else {
                                echo '--';
                            } ?>
                        </td>
                        <td>
                            <? if ($ticket['datesale']) {
                                echo date("d.m.Y H:i:s", strtotime($ticket['dataatime']));
                            } else {
                                echo '--';
                            } ?>
                        </td>
                        <td><?= $ticket['eo']; ?></td>
                        <td title="<?= $ticket['saler']; ?>"><?= $statuszb['name']; ?></td>
                        <td>
                            <? if ($ticket['status'] == 1) : ?>
                                <button value="<?= $ticket['id']; ?>" class="btn btn-success without_SMS">Принять без смс </button>
                            <? elseif ($ticket['status'] == 2) : ?>
                                <button value="<?= $ticket['id']; ?>" class="btn btn-danger without_SMS">Выкуп без смс </button>
                            <? endif; ?>
                        </td>
                    </tr>
                <? } ?>
            </tbody>
        </table>
    </div><!-- /.table-responsive -->
    <script>
        $(function() {
            $("#example1").DataTable();
        });
        $('.without_SMS').click(function() {
                    let isBoss = confirm('Вы уверены?');
                    if (isBoss) {

                        $(this).css('display', 'none')
                        $.post('./functions/without_SMS.php', {
                            id: $(this).val()
                        }).done(function(response) {
                                alert(JSON.parse(response));

                                });
                        }
                    }); $('button.view').click(function() {
                    let id = $(this).data('id');
                    $.post('functions/get_data.php', {
                            id: id
                        })
                        .done(function(data) {
                            $('.modal-body').html(data);
                        })
                })
    </script>
<? endif; ?>