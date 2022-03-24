<?
include __DIR__ . '/../../layouts/header.php';
include __DIR__ . '/../../layouts/menu/financial_department.php';

$today = date('Y-m-d', strtotime($thisDate . " - 1 day"));

$region = $_POST['region'];
$adress = $_POST['adress'];
if ($_POST['date1'] and $_POST['date2']) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
} else {
    $date1 = '2020-08-19';
    $date2 = $today;
};
if ($date1 and $date2) {
    if ($region and ($adress != 'Все')) {
        $rows = R::find('tickets', "(status = 7 OR status = 10 OR status = 14 OR status = 15) AND region =:region AND adressfil = :adress AND dv BETWEEN :date AND :date1", [':region' => $region, ':adress' => $adress, ':date' => $date1, ':date1' => $date2]);
    } elseif ($region and ($adress == 'Все')) {
        $rows = R::find('tickets', "(status = 7 OR status = 10 OR status = 14 OR status = 15) AND region =:region AND dv BETWEEN :date AND :date1", [':region' => $region, ':date' => $date1, ':date1' => $date2]);
    } else {
        $rows = R::find('tickets', "status = 7 OR status = 10 OR status = 14 OR status = 15 AND dv BETWEEN :date AND :date1", [':date' => $date1, ':date1' => $date2]);
    }
} else {
    if ($region and ($adress != 'Все')) {
        $rows = R::find('tickets', '(status = 7 OR status = 10 OR status = 14 OR status = 15) AND region =:region AND adressfil = :adress', [':region' => $region, ':adress' => $adress]);
    } elseif ($region and ($adress == 'Все')) {
        $rows = R::find('tickets', '(status = 7 OR status = 10 OR status = 14 OR status = 15) AND region =:region', [':region' => $region]);
    } else {
        $rows = R::find('tickets', 'status = 7 OR status = 10 OR status = 14 OR status = 15');
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php">Регионы</a></li>
            <li class="active">Филиалы</li>
        </ol>
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Выберите филиал </h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="" method="POST">
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="date1" value="<?= $date1; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="date2" value="<?= $date2; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-bank"></i>
                                    </span>
                                    <select class="form-control" id="get_region" name="region">
                                        <? if ($region) : ?>
                                            <option value="<?= $region ?>"><?= $region ?></option>
                                        <? endif; ?>
                                        <option value="">Выберите город</option>
                                        <? $reg = R::findAll('kassa', 'statuskassa IS NOT NULL GROUP BY region');
                                        foreach ($reg as $key) { ?>
                                            <option><?= $key['region'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-4 -->
                            <div class=" col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select class="form-control" id="adress" name="adress">
                                        <option><?= $adress ?></option>
                                    </select>
                                </div>
                                <!-- /input-group -->
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-block btn-primary">Подтвердить</button>
                                </div>
                                <!-- /input-group -->
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Товары на исполнении <?= $adress; ?></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="datatable-tabletools" class="table table-bordered table-striped">
                            <thead>
                                <tr class="info">
                                    <th>ID</th>
                                    <th style="width:5rem;">№ЗБ</th>
                                    <th style="width:10rem;">Клиент</th>
                                    <th>Залог</th>
                                    <th style="width:5rem;">Дата выдачи</th>
                                    <th style="width:15rem;">Сумма выдачи</th>
                                    <th style="width:10rem;">Сумма продажи</th>
                                    <th style="width:8rem;">Дата выхода на реализацию</th>
                                    <th style="width:8rem;">Статус</th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($rows as $row) {
                                    $st = R::load('status_zb', $row['status']);
                                ?>
                                    <tr id='<?= $row['id']; ?>'>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['nomerzb']; ?></td>
                                        <td><?= $row['fio']; ?> <br> Тел:<?= $row['phones']; ?> </td>
                                        <td> <?= $row['category']; ?> <?= $row['tovarname']; ?> <?= $row['opisanie']; ?> <?= $row['hdd']; ?> <?= $row['sostoyanie_bu']; ?> <?= $row['upakovka']; ?> <?= $row['ekran']; ?> <?= $row['korpus']; ?>
                                            SN: <?= $row['sn']; ?>, IMEI:<?= $row['imei']; ?>, <?= $row['complect']; ?>
                                        </td>
                                        <td> <?= date("d.m.Y", strtotime($row['reg_data'])); ?></td>
                                        <td> <?= number_format($row['summa_vydachy'], 0, '.', ' ');
                                                $summa_vydachy +=   $row['summa_vydachy'] ?></td>
                                        <td><?= $row['cena_pr']; ?></td>
                                        <td> <?= date("d.m.Y", strtotime($row['dv'])); ?></td>
                                        <td> <?= $st['name']; ?></td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
</div><!-- /.row -->
</section>

<script src="/assets/plugins/editable/jquery.tabledit.js"></script>
<script>
    $('#datatable-tabletools').Tabledit({
                url: 'ajax/example.php',
                editButton: false,
                deleteButton: false,
                hideIdentifier: true,
                eventType: 'dblclick',
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [6, 'cena_pr'],
                        [8, 'status', '{"14":"На ветрине","15":"На Ремонте"}']
                    ]
                },
                onDraw: function() {
                    console.log('onDraw()');
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    console.log('onSuccess(data, textStatus, jqXHR)');
                    console.log(data);
                    console.log(textStatus);
                    console.log(jqXHR);
                },
                onFail: function(jqXHR, textStatus, errorThrown) {
                    console.log('onFail(jqXHR, textStatus, errorThrown)');
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                onAlways: function() {
                    console.log('onAlways()');
                },
                onAjax: function(action, serialize) {
                    console.log('onAjax(action, serialize)');
                    console.log(action);

                }});
</script>

<? include __DIR__ . '/../../layouts/footer.php'; ?>