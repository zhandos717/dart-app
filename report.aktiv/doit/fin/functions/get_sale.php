<? include("../../../bd.php");

if (!empty($_POST['fiosaler'])) {
    exit;
    $ticket = R::findOne('tickets', 'nomerzb=?', [$_REQUEST['nomerzb']]);
}
$today = date('Y-m-d');
$ticket = R::findOne('tickets', 'nomerzb=?', [$_REQUEST['nomerzb']]);
$data_st = R::findOne('status_zb', 'id=?', [$ticket['status']]);
?>

<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Информация о товаре</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">№</th>
                        <th colspan="2" class="text-center">Общие сведения</th>
                    </tr>
                </thead>
                <tr class="success">
                    <td></td>
                    <td style="width:20rem;">Код товара</td>
                    <td>
                        <?= $ticket['nomerzb']; ?>
                    </td>
                </tr>
                <tr class="danger">
                    <td></td>
                    <td>Дата выдачи</td>
                    <td>
                        <?= $ticket['dataseg']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td> Наименование товара</td>
                    <td>
                        <?= $ticket['category']; ?>, <?= $ticket['tovarname']; ?> <?= $ticket['hdd']; ?> <?= $ticket['sostoyanie_bu']; ?> <?= $ticket['upakovka']; ?> <?= $ticket['ekran']; ?> <?= $ticket['korpus']; ?>
                        SN: <?= $ticket['sn']; ?>, IMEI:<?= $ticket['imei']; ?>, <?= $ticket['complect']; ?> <?= $ticket['opisanie']; ?>
                    </td>
                </tr>
                <tr class="danger">
                    <td></td>
                    <td> Сумма выдачи</td>
                    <td>
                        <?= number_format($ticket['summa_vydachy'], 0, '.', ' '); ?> тг.
                    </td>
                </tr>
                <? if ($ticket['zadatok']) : ?>
                    <tr>
                        <td></td>
                        <td> Сумма задатка</td>
                        <td>
                            <?= number_format($ticket['zadatok'], 0, '.', ' '); ?> тг.
                        </td>
                    </tr>
                <? endif; ?>
                <? if ($ticket['cena_pr']) : ?>
                    <tr>
                        <td></td>
                        <td> Сумма продажи</td>
                        <td>
                            <?= number_format($ticket['cena_pr'], 0, '.', ' '); ?> тг.
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> Прибыль</td>
                        <td>
                            <?= number_format($ticket['cena_pr'] - $ticket['summa_vydachy'], 0, '.', ' '); ?> тг.
                        </td>
                    </tr>
                <? endif; ?>
                <tr class="info">
                    <td></td>
                    <td> Статус товара</td>
                    <td>
                        <h4><span class="label label-danger"><?= $data_st['name']; ?></span></h4>
                    </td>
                </tr>
                <? if ($ticket['data_pos']) : ?>
                    <tr>
                        <td></td>
                        <td> Дата поступления на склад магазина</td>
                        <td>
                            <?= $ticket['data_pos']; ?>
                        </td>
                    </tr>   
                    <? endif;  
                    if($ticket['dateshop']): ?>
                    <tr>
                        <td></td>
                        <td> Дата выставления на ветрину</td>
                        <td>
                            <?= $ticket['dateshop']; ?>
                        </td>
                    </tr>
                <? endif; ?>

                <? if (($ticket['datesale']) or ($ticket['saler'])) : ?>
                    <tr>
                        <td></td>
                        <td> Дата продажи</td>
                        <td>
                            <?= $ticket['datesale']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> Кто продал</td>
                        <td>
                            <?= $ticket['saler']; ?>
                        </td>
                    </tr>

                <? endif; ?>
            </table>
            <br>
            <? if (($ticket['status'] == 7) or ($ticket['status'] == 10) or ($ticket['status'] == 14) or ($ticket['status'] == 15) or ($ticket['status'] == 5)) : ?>

                <div class="col-lg-6 col-xs-6">
                    <div class="input-group input-group-sm">
                        <input type="date" class="form-control" value="<?= $today; ?>" name="datesale">
                    </div>
                </div>

                <div class="col-lg-6 col-xs-6 ">
                    <div class=" input-group input-group-sm">
                        <input type="text" name="id" hidden value="<?= $ticket['id']; ?>">
                        <input type="number" class="form-control" value="<?= round($_REQUEST['price']); ?>" name="cena_pr" placeholder="Введите сумму реализации">
                    </div><!-- /input-group -->
                </div>

            <? endif; ?>
        </div>
    </div>
</div>