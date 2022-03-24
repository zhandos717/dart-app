<? include_once '../../../../bd.php';

if(!empty($_POST['region']) AND empty($_POST['vid']) ){
    $sql ='region = :region AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';
    
    $array = [':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
}elseif(empty($_POST['region']) AND empty($_POST['vid']) ){
    $sql ='data BETWEEN :date1 AND :date2 ORDER BY id DESC';

    $array = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
}elseif(!empty($_POST['vid']) AND empty($_POST['region'])){
    $sql ='vid = :vid AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';

    $array = [':vid'=>$_POST['vid'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2']];
}elseif(!empty($_POST['vid']) AND !empty($_POST['region'])){
    $sql ='region = :region AND vid = :vid AND data BETWEEN :date1 AND :date2 ORDER BY id DESC';

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
                <?echo number_format($value['summaprihod']); $summaprihod += $value['summaprihod']; ?>
            </td>
            <td class="danger">
                <?echo number_format($value['summareal']); $summareal += $value['summareal'];?>
            </td>
            <td class="success">
                <?echo number_format($value['summareal'] - $value['summaprihod']); $total += $value['summareal'] - $value['summaprihod'];  ?>
            </td>
        </tr>
        <?}?>
    </tbody>
    <tfoot>
        <tr class="text-center danger">
            <th colspan="6"> ИТОГ</th>
            <th><?= $i - 1; ?> ед.</th>
            <th><?= number_format($summaprihod); ?> </th>
            <th><?= number_format($summareal); ?> </th>
            <th><?= number_format($total); ?> </th>
        </tr>
    </tfoot>
</table>
<script src="plugins/table/dataTables.buttons.min.js"></script>
<script src="plugins/table/jszip.min.js"></script>
<script src="plugins/table/buttons.html5.min.js"></script>
<script src="plugins/table/buttons.print.min.js"></script>
<script src="plugins/table/examples.datatables.tabletools.js"></script>