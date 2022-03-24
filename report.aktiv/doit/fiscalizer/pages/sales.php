<?
include "../layouts/header.php";
include __DIR__ . "/layouts/menu.php";
$reports = R::findAll('salecomision', 'ORDER BY id DESC LIMIT 10');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Отчеты по кассам </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php">Регионы</a></li>
            <li class="active">Филиалы</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!--<div class="box-header">
                  <h3 class="box-title">Проторгованные товары123</h3>
                </div> /.box-header -->
                    <div class="col-xs-12">
                    </div>
                    <div class="box-body">
                        <form action="functions/report_sales.php" id="report" method="POST">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date2">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-bank"></i>
                                        </span>
                                        <select class="form-control" id="get_region" name="region">
                                            <option value="">Выберите город</option>
                                            <?
                                            $reg = R::findAll('kassa', 'region <> "Тест" GROUP BY region');
                                            foreach ($reg as $region) { ?>
                                                <option><?= $region['region'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select class="form-control" id="adress" name="adress">
                                            <option>Выберите город</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn-success btn ">Подтвердить!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <!--<div class="box-header">
                  <h3 class="box-title">Проторгованные товары123</h3>
                </div> /.box-header -->
                    <div class="col-xs-12">
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr class="text-center table-success">
                                        <th>№</th>
                                        <th style="width:5rem;">ДАТА ПРОДАЖИ</th>
                                        <th>КОД ТОВАРА</th>
                                        <th>ТОВАР</th>
                                        <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                                        <th>ЗАДАТОК</th>
                                        <th>СУММА РЕАЛИЗАЦИИ</th>
                                        <th>ПРИБЫЛЬ</th>
                                        <th>ПРОДАВЕЦ</th>
                                        <th>Кассир</th>
                                        <th>ПОКУПАТЕЛЬ</th>
                                        <th>ИИН</th>
                                        <th>ТЕЛЕФОН</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $i = 1;
                                    foreach ($reports as $data3) { ?>
                                        <tr class="text-center">
                                            <td><?= $i++; ?>.</td>
                                            <td><?= date("d.m.Y", strtotime($data3['dataa'])); ?> </td>
                                            <td> <?= $data3['codetovar']; ?> </td>
                                            <td class="text-left">
                                                <?= $data3['tovarname']; ?>
                                            </td>
                                            <td><?= number_format($data3['summaprihod'], 0, '.', ' ');
                                                $summaprihod += $data3['summaprihod']; ?></td>
                                            <td><?= number_format($data3['zadatok'], 0, '.', ' ');
                                                $zadatok += $data3['zadatok']; ?></td>
                                            <td><?= number_format($data3['summareal'], 0, '.', ' ');
                                                $summareal += $data3['summareal']; ?></td>
                                            <td><?= number_format($data3['summareal'] - $data3['summaprihod'], 0, '.', ' '); ?></td>
                                            <td> <?= $data3['saler']; ?> </td>
                                            <td> <?= $data3['kassir']; ?> </td>
                                            <td> <?= $data3['pokupatel']; ?> </td>
                                            <td> <?= $data3['pokupateliin']; ?> </td>
                                            <td> <?= $data3['pokupateltel']; ?> </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.content-wrapper -->
    </section>
</div>
<script>
    $(function() {
        $('form#report').submit(function(e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function(data) {
                $('.answer').html(data);
            }).fail(function() {
                alert('Ошибка');
            });
            e.preventDefault(); //отмена действия по умолчанию для кнопки submit
        });
    });
</script>

<? include "../layouts/footer.php"; ?>