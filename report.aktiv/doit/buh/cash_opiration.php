<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 10) :
    include "header.php";
    include "menu.php";
    $region = R::findAll('kassa', 'region <> "Тест" GROUP BY region');
?>
    <!-- Content Wrapper. Contains page content -->
    <script src="linkedselect.js" charset="utf-8"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Финансовые передвижения
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php">Регионы</a></li>
                <li class="active">Филиалы</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <!--box -->
            <div class="box-body">

                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr class="info">
                                <th>№</th>
                                <th class="text-center">Откуда</th>
                                <th class="text-center">Куда</th>
                                <th>Дата </th>
                                <th>Cчет</th>
                                <th>Вид операции</th>
                                <th>Сумма</th>
                                <th>Касса</th>
                                <th>Статус</th>
                                <th>Примечание</th>
                            </tr>
                        </thead>
                        <tbody id="otvet">
                            <?
                            $result = R::findAll('finance', "ORDER BY id DESC "); //WHERE status = 1 OR status = 2
                            $i = 1;
                            foreach ($result as $data) {
                                $np = $data['np'];
                                $operation = $data['operationtype'];
                                $data1 = R::getRow(
                                    "SELECT 
                region,filial,kassa  
                FROM finance 
                WHERE np ='$np' 
                AND NOT operationtype = '$operation'  
                ORDER BY id DESC LIMIT 1"
                                );
                            ?>
                                <tr>
                                    <th><?= $i++; ?>.
                                    </th>

                                    <? if ($data['kassaoperation'] == '2') { ?>
                                        <td><?= $data['region']; ?>/<?= $data['filial']; ?>/<?= $data['kassa']; ?></td>
                                        <td><?= $data1['region']; ?>/<?= $data1['filial']; ?>/<?= $data1['kassa']; ?></td>
                                        <? } else {
                                        if ($data['operationtype'] === '0') { ?>
                                            <td class="success"> Пополнение кассы комиссионного магазина </td>
                                            <td><?= $data['region']; ?>/<?= $data['filial']; ?></td>
                                        <? } else if ($data['operationtype'] == 1) { ?>
                                            <td><?= $data['region']; ?>/<?= $data['filial']; ?></td>
                                            <td class="danger"> Изъятие из базы комиссионного магазина</td>
                                        <? } else { ?>
                                            <td class="danger text-center"> Ошибка</td>
                                            <td class="danger text-center"> Ошибка</td>
                                    <? }
                                    } ?>
                                    <td><?= date("d.m.Y H:i:s", strtotime($data['dataatime'])); ?></td>
                                    <td><?= $data['chet']; ?></td>
                                    <td>
                                        <?
                                        if ($data['operationtype'] === '0') {
                                            echo "<span class='label label-success'> Внесение </span>";
                                        } else if ($data['operationtype'] == 1) {
                                            echo "<span class='label label-danger'> Изъятие </span>";
                                        } else {
                                            echo "<span class='label label-danger'> Ошибка </span>";
                                        }
                                        ?>
                                        <br>

                                    </td>
                                    <td><?= number_format($data['summa'], 0, '.', ' '); ?></td>
                                    <td><?= $data['kassa']; ?></td>
                                    <td>
                                        <?
                                        if ($data['status'] == 1) { ?>
                                            <span class='label label-info'> Сформирован </span>
                                            <!-- <a href="#" title="редактировать" class="btn btn-warning"> <i class="fa fa-edit"></i> </a> -->
                                            <!-- <button title="удалить" id='remove' class="btn btn-danger"> <i class="fa fa-remove"></i> </button> -->
                                        <? } else {
                                            echo "<span class='label label-warning'> Выполнено </span>";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $data['coment']; ?> </td>
                                </tr>
                            <? } ?>
                        </tbody>
                        <tfoot>
                            <?
                            $result2 = R::getRow("SELECT SUM(summa) FROM finance WHERE kassaoperation = '1' AND operationtype = '0' ");
                            $result3 = R::getRow("SELECT SUM(summa) FROM finance WHERE kassaoperation = '1' AND operationtype = '1' ");
                            ?>
                            <tr>
                                <th colspan="2" class="text-center">ИТОГ:</th>
                                <th colspan="2" class="text-center">пополнение:</th>
                                <th colspan="2"><?= number_format($result2['SUM(summa)'], 0, '.', ' '); ?></th>
                                <th colspan="2" class="text-center">Изъятие:</th>
                                <th colspan="2"><?= number_format($result3['SUM(summa)'], 0, '.', ' '); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
        </div><!-- /.box -->

    </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function() {
        $('button#remove').click(function() {
            alert('Хотите удалить ?');
        });
    });

    $('#get_region').change(function() {
        var region = $(this).val();
        console.log(region);
        $('#adress').load('../function/get_adress.php', {
            region: region
        });
    });

    $('#region1').change(function() {
        var region = $(this).val();
        console.log(region);
        $('#adress1').load('../function/get_adress.php', {
            region: region
        });
    });

    $('#region2').change(function() {
        var region = $(this).val();
        console.log(region);
        $('#adress2').load('../function/get_adress.php', {
            region: region
        });
    });
</script>

<? include "footer.php";
else :
    header('Location: /');
endif; ?>