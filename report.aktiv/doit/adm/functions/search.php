<? include_once "../../../bd.php";
if ($_SESSION['logged_user']) :
    if ($_POST['delete_id']) {
        $sale = R::load($_POST['table'], $_POST['delete_id']);
        $sale->statustovar = 3;
        R::store($sale);
        exit;
    }
    $search = trim($_POST['search']);
    $result = R::findAll(
        'sales',
        'codetovar LIKE :search OR pokupatel LIKE :search  OR tovarname LIKE :search LIMIT 20',
        [':search' => "%$search%"]
    );
?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="info">
                    <th>№</th>
                    <th>ДАТА</th>
                    <th>Код товара</th>
                    <th>На каком филиале заполнили</th>
                    <th>Откуда товар</th>
                    <th>ТОВАР</th>
                    <th>Приход</th>
                    <th>Предоплата</th>
                    <th>Продажа</th>
                    <th>ПРИБЫЛЬ</th>
                    <th>Вид</th>
                    <th>Продавец</th>
                    <th>Покупатель</th>
                    <th></th>
                </tr>
            </thead>
            <? $i = 1;
            foreach ($result as $data) { ?>
                <tr <? if ($data['statustovar'] == 3) {
                        echo 'class="danger"';
                    }; ?>>
                    <td><?= $i++; ?>.</td>
                    <td><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                    <td> <?= $data['codetovar']; ?></td>
                    <td>
                        <?= $data['region'] . '/' . $data['adress']; ?>
                    </td>
                    <td>
                        <?= $data['regionlombard'] . '/' . $data['adresslombard']; ?>
                    </td>
                    <td><?= $data['tovarname']; ?></td>
                    <td class="warning"><?= number_format($data['summaprihod'], 0, '.', ' ');
                                        $summaprihod += $data['summaprihod']; ?></td>
                    <td><?= number_format($data['predoplata'], 0, '.', ' ');
                        $predoplata += $data['predoplata']; ?></td>
                    <td class="danger"><?= number_format($data['summareal'], 0, '.', ' ');
                                        $summareal += $data['summareal']; ?></td>
                    <td class="success"><?= number_format($data['pribl'], 0, '.', ' ');
                                        $pribl += $data['pribl']; ?></td>
                    <td><?= $data['vid']; ?></td>
                    <td><?= $data['saler']; ?></td>
                    <td><?= $data['pokupatel']; ?></td>
                    <td> <button class="btn btn-danger delete" data-table="sales" data-id="<?= $data['id']; ?>" title="удалить"> <i class="fa fa-times" aria-hidden="true"></i> </button> </td>
                </tr>
            <? } ?>
        </table>
    </div>


    <script src="/assets/js/form.js"></script>
<? endif; ?>