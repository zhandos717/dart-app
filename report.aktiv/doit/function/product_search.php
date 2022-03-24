<? include_once "../../bd.php";
if ($_SESSION['logged_user']) :
    if ($_POST['delete_id']) {
        $sale = R::load($_POST['table'], $_POST['delete_id']);
        $sale->statustovar = 3;
        R::store($sale);
        exit;
    }
    $search = trim($_POST['search']);
    $result = R::findAll(
        'tickets',
        'iin LIKE :search OR fio LIKE :search OR nomerzb LIKE :search  OR phones LIKE :search  OR sn LIKE :search  OR imei LIKE :search OR iin  LIKE :search    LIMIT 20',
        [':search' => "%$search%"]
    );
?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="info">
                    <th>№</th>
                    <th>Дата приемки</th>
                    <th>Код товара</th>
                    <th>Клиент</th>
                    <th>Сотрудник</th>
                    <th>Адрес</th>
                    <th>Товар</th>
                    <th>Приход</th>
                    <th>Предоплата</th>
                    <th>Продажа</th>
                    <th>ПРИБЫЛЬ</th>
                </tr>
            </thead>
            <? $i = 1;
            foreach ($result as $data) { ?>
                <tr <? if ($data['statustovar'] == 3) {
                        echo 'class="danger"';
                    }; ?>>
                    <td><?= $i++; ?>.</td>
                    <td><?= date("d.m.Y H:i:s", strtotime($data['reg_data'])); ?></td>
                    <td> <?= $data['nomerzb']; ?></td>
                    <td><?= $data['eo']; ?></td>
                    <td><?= $data['fio']; ?></td>
                    <td>
                        <?= $data['region'] . '/' . $data['adress']; ?>
                    </td>
                    <td> <?= $data['type'] . '/' . $data['adress'] . '/' . $data['category'] . '/' . $data['tovarname'] . '/' . $data['hdd']; ?> </td>
                    <td><?= $data['summa_vydachy']; ?></td>
                    <td><?= $data['zadatok']; ?></td>
                    <td><?= $data['cena_pr']; ?></td>
                    <td><?= $data['saler']; ?></td>
                    </td>
                </tr>
            <? } ?>
        </table>
    </div>
    <script src="/assets/js/form.js"></script>
<? endif; ?>