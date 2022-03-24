<?
include_once '../../../bd.php';
$table =  'tickets';
if ($_POST['adress'] == 'Все') {
    $_POST['adress'] = '';
};

if (empty($_POST['region']) && empty($_POST['payment'])) :
    $sql = "status = 5 AND (region = 'Караганда' OR region = 'Кокшетау' OR region = 'Костанай' OR region = 'Павлодар' OR region = 'Нур-Султан') AND datesale BETWEEN :date1 AND :date2";
    $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
#
elseif (empty($_POST['region']) && !empty($_POST['payment'])) :
    $sql = "status = 5 AND salerstatus = :payment AND datesale BETWEEN :date1 AND :date2";
    $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2'], ':payment' => $_POST['payment']];
#
elseif ($_POST['region'] && empty($_POST['adress']) && empty($_POST['payment'])) :
    $sql = "status = 5 AND region = :region AND datesale BETWEEN :date1 AND :date2";
    $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2'], ':region' => $_POST['region']];
#
elseif (!empty($_POST['adress']) && empty($_POST['payment'])) :
    $sql = "status = 5 AND region = :region AND adressfil = :adress AND datesale BETWEEN :date1 AND :date2";
    $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2'], ':region' => $_POST['region'], ':adress' => $_POST['adress']];
#
elseif (empty($_POST['adress']) && !empty($_POST['payment'])) :
    $sql = "status = 5 AND region = :region AND salerstatus = :payment AND datesale BETWEEN :date1 AND :date2";
    $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2'], ':region' => $_POST['region'], ':payment' => $_POST['payment']];
#
elseif (!empty($_POST['adress']) && !empty($_POST['payment'])) :
    $sql = "status = 5 AND region = :region AND adressfil = :adress AND salerstatus = :payment AND datesale BETWEEN :date1 AND :date2";
    $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2'], ':region' => $_POST['region'], ':adress' => $_POST['adress'], ':payment' => $_POST['payment']];
endif;
$result = R::findAll($table, $sql, $placeholder);
// print_r($_POST);
?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title text-center">
                <b> <?= $comment; ?> </b>
            </h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="datatable-tabletools" class="table table-hover table-bordered">
                    <thead>
                        <tr class="info">
                            <th class="text-center">№</th>
                            <th class="text-center">Код товара</th>
                            <th class="text-center">Тип залогового имущества</th>
                            <th>Дата реализации</th>
                            <th class="text-center">Сумма кредита</th>
                            <th class="text-center">Сумма реализации</th>
                            <th class="text-center"> Доход от продажи</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $i = 1;
                        foreach ($result as $data12) {
                        ?>
                            <tr>
                                <td><?= $i++; ?>.</td>
                                <td><?= $data12['nomerzb']; ?></td>
                                <td class="text-left">
                                    <?= $data12['type']; ?>
                                    <?= $data12['category']; ?>
                                    <?= $data12['opisanie']; ?>
                                    <?= $data12['tovarname']; ?>
                                    <?= $data12['hdd']; ?>
                                </td>
                                <td><?= date("d.m.Y", strtotime($data12['datesale'])); ?></td>
                                <td class="warning"> <?= number_format($data12['summa_vydachy'], 0, '.', ' '); ?>
                                    <? $summa_vydachy += $data12['summa_vydachy']; ?>
                                </td>
                                <td class="success"> <?= number_format($data12['cena_pr'], 0, '.', ' '); ?>
                                    <? $cena_pr += $data12['cena_pr']; ?>
                                </td>
                                <td class="info"> <?= number_format($data12['cena_pr'] - $data12['summa_vydachy'], 0, '.', ' '); ?>
                                    <? $total += $data12['cena_pr'] - $data12['summa_vydachy']; ?>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                    <tfoot>
                        <tr class="info">
                            <th></th>
                            <th></th>
                            <th> ИТОГО:</th>
                            <th></th>
                            <td class="warning"> <?= number_format($summa_vydachy, 0, '.', ' '); ?></td>
                            <td class="success"> <?= number_format($cena_pr, 0, '.', ' '); ?></td>
                            <td class="info"> <?= number_format($total, 0, '.', ' '); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
    </div><!-- /.box box-primary -->
</div><!-- /.col-md-6 -->
<script src="plugins/table/examples.datatables.tabletools.js"></script>