<?
if(!empty($_POST['region']) AND empty($_POST['vid']) ){
$sql ='regionlombard = :region AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';
$array = [':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
}elseif(empty($_POST['region']) AND empty($_POST['vid']) ){
$sql ='data BETWEEN :date1 AND :date2 ORDER BY id DESC';
$array = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
}elseif(!empty($_POST['vid']) AND empty($_POST['region'])){
$sql ='vid = :vid AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';
$array = [':vid'=>$_POST['vid'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
}elseif(!empty($_POST['vid']) AND !empty($_POST['region'])){
$sql ='regionlombard = :region AND vid = :vid AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';
$array = [':region'=>$_POST['region'],':vid'=>$_POST['vid'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
};
$search = R::findAll('sales',$sql,$array);
$i =1;
?>
<table id="datatable-tabletools" class="table table-hover table-bordered">
    <thead>
        <tr class="warning">
            <th>№ П/П</th>
            <th>Регион</th>
            <th>Филиал</th>
            <th>Дата продажи</th>
            <th>Код товара</th>
            <th>Описание</th>
            <th>Вид оплаты</th>
            <th>Сумма приемки</th>
            <th>Сумма продажи</th>
            <th>Прибыль</th>
        </tr>
    </thead>
    <tbody>
        <?foreach ($search as $value) {?>
        <tr>
            <td> <?= $i++; ?>. </td>
            <td> <?= $value['region']; ?> </td>
            <td> <?= $value['adress']; ?> </td>
            <td> <?= date('d.m.Y', strtotime($value['data'])); ?> </td>
            <td> <?= $value['codetovar']; ?> </td>
            <td> <?= $value['tovarname']; ?> </td>
            <td> <?= $value['vid']; ?> </td>
            <td class="info">
                <?= $value['summaprihod'];
                $summaprihod += $value['summaprihod']; ?>
            </td>
            <td class="danger">
                <?= $value['summareal'];
                $summareal += $value['summareal']; ?>
            </td>
            <td class="success">
                <?= $value['summareal'] - $value['summaprihod'];
                $total += $value['summareal'] - $value['summaprihod'];  ?>
            </td>
        </tr>
        <?}?>
    </tbody>
    <tfoot>
        <tr class="text-center danger">
            <th colspan="6"> ИТОГ</th>
            <th><?= $i - 1; ?> ед.</th>
            <th><?= $summaprihod; ?> </th>
            <th><?= $summareal; ?> </th>
            <th><?= $total; ?> </th>
        </tr>
    </tfoot>
</table>