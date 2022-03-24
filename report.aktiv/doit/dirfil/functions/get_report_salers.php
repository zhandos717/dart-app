<?
include("../../../bd.php");
if ($status) :
    $sql = "data between :date1 AND :date2 AND regionlombard ='$region' AND adresslombard ='$adress' AND statustovar IS NULL";
    $placeholder = [':date1' => $_POST['date1'], ':date2' => $_POST['date2']];
    $table = R::findAll('sales', $sql, $placeholder)
?>
    <div class="table-responsive">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr class="info">
                    <th>№</th>
                    <th> Дата реализации</th>
                    <th> №ЗБ</th>
                    <th> ТОВАР</th>
                    <th>Вид оплаты</th>
                    <th>Сумма кредита</th>
                    <th>Сумма реализации</th>
                    <th>Доход от продажи</th>
                    <th>Прибыль (-% банка)</th>
                </tr>
            </thead>
            <tbody>
                <?
                $i = 1;
                foreach ($table as $data) {
                ?>
                    <tr>
                        <td style="width:5rem;"><?= $i++; ?>.</td>
                        <td style="width:10rem;"><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                        <td><?= $data['codetovar']; ?></td>
                        <td><?= $data['tovarname']; ?></td>
                        <td><?= $data['vid']; ?></td>
                        <td class="danger"><?= number_format($data['summaprihod'], 0, '.', ' ');
                                            $summaprihod += $data['summaprihod'] ?></td>
                        <td class="warning"><?= number_format($data['summareal'], 0, '.', ' ');
                                            $summareal += $data['summareal']  ?></td>
                        <td class="success"><?= number_format($data['summareal'] - $data['summaprihod'], 0, '.', ' '); ?></td>
                        <td class="success"><?= number_format($data['remainder'] - $data['summaprihod'], 0, '.', ' ');
                                            $remainder += $data['remainder'] - $data['summaprihod'] ?></td>
                    </tr>
                <? } ?>
            </tbody>
            <tfoot>
                <tr class="bg-olive text-center">
                    <td colspan="5">
                        ИТОГ:
                    </td>

                    <td><?= number_format($summaprihod, 0, '.', ' '); ?></td>
                    <td><?= number_format($summareal, 0, '.', ' '); ?></td>
                    <td><?= number_format($summareal - $summaprihod, 0, '.', ' '); ?></td>
                    <td><?= number_format($remainder, 0, '.', ' '); ?></td>

                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(function() {
            $('example2').DataTable();
        });
    </script>
<?
else :
    header('Location: /');
endif;
?>