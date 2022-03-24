<?
include_once '../../../../bd.php';

$table =  'productreport';

if ($_POST['adress'] == 'Все') {
$_POST['adress'] = '';
};

if(empty($_POST['region']) && empty($_POST['payment'])):
$sql ="datereg BETWEEN :date1 AND :date2";
$placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
#
elseif($_POST['region'] &&  empty($_POST['payment'])):
$sql =" region = :region AND datereg BETWEEN :date1 AND :date2";
$placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'],':region'=>$_POST['region']];
#
elseif(empty($_POST['region']) && $_POST['payment']==1):
$sql ="salerstatus IS NULL  AND datereg BETWEEN :date1 AND :date2";
$placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
#
elseif(empty($_POST['region']) && $_POST['payment']==2):
$sql =" salerstatus = :payment AND datereg BETWEEN :date1 AND :date2";
$placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'],':payment'=>$_POST['payment']];
#
elseif(!empty($_POST['region']) && $_POST['payment'] == 1):
$sql =" region = :region AND salerstatus IS NULL AND datereg BETWEEN :date1 AND :date2";
$placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'],':region'=>$_POST['region']];
#
elseif(!empty($_POST['region']) && $_POST['payment'] == 2):
$sql =" region = :region AND salerstatus = :payment AND datereg BETWEEN :date1 AND :date2";
$placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'],':region'=>$_POST['region'],':payment'=>$_POST['payment']];
endif;
#
$result = R::findAll($table,$sql,$placeholder);
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
                <table id="example0" class="tableas table table-hover table-bordered">
                    <thead>
                        <tr class="info">
                            <th class="text-center">№</th>
                            <th class="text-center">Код товара</th>
                            <th class="text-center">Регион</th>
                            <th class="text-center">Тип залогового имущества</th>
                            <th>Дата реализации</th>
                            <th class="text-center">Сумма закупа</th>
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
                            <td>Z<?= $data12['id_product']; ?></td>
                            <td><?= $data12['region']; ?></td>
                            <td class="text-left">
                                <?= $data12['category']; ?>
                                <?= $data12['name']; ?>
                            </td>
                            <td><?= date("d.m.Y", strtotime($data12['datereg'])); ?></td>
                            <td class="warning"> <?= number_format($data12['purchaseamount'], 0, '.', ' '); ?>
                                <?  $purchaseamount += $data12['purchaseamount']; ?>
                            </td>
                            <td class="success"> <?= number_format($data12['price'], 0, '.', ' '); ?>
                                <?  $price += $data12['price']; ?>
                            </td>
                            <td class="info"> <?= number_format($data12['price'] - $data12['purchaseamount'], 0, '.', ' '); ?>
                                <?  $total += $data12['price'] - $data12['purchaseamount']; ?>
                            </td>
                        </tr>
                        <?}?>
                    </tbody>
                    <tr class="info">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th> ИТОГО:</th>
                        <th></th>
                        <td class="warning"> <?= number_format($purchaseamount, 0, '.', ' '); ?></td>
                        <td class="success"> <?= number_format($price, 0, '.', ' '); ?></td>
                        <td class="info"> <?= number_format($total, 0, '.', ' '); ?></td>
                    </tr>
                    <tfoot>
                    </tfoot>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
    </div><!-- /.box box-primary -->
</div><!-- /.col-md-6 -->