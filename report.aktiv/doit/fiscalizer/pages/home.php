<?
include "../layouts/header.php";
include __DIR__ . "/layouts/menu.php";
$reports = R::findAll('repotscom', 'ORDER BY id DESC LIMIT 10');
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
                                    <tr>
                                        <th>Регион</th>
                                        <th>Адресс</th>
                                        <th>Касса</th>
                                        <th>Дата</th>
                                        <th>Начало дня</th>
                                        <th>Выдача</th>
                                        <th>Комисся</th>
                                        <th>Возврата</th>
                                        <th>Пеня</th>
                                        <th>Пополнение</th>
                                        <th>Изятие</th>
                                        <th>Выручка </th>
                                        <th>Прибыль от продаж</th>
                                        <th>Задатки</th>
                                        <th>Конец дня</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($reports as $key) { ?>
                                        <tr style="white-space:nowrap;">
                                            <td><?= $key['region']; ?> </td>
                                            <td><?= $key['adress']; ?></td>
                                            <td><?= $key['kassa']; ?></td>
                                            <td><?= $key['datereport']; ?></td>
                                            <td><?= $key['summstart']; ?></td>
                                            <td><?= $key['vydacha']; ?></td>
                                            <td><?= $key['comis']; ?></td>
                                            <td><?= $key['vozvrat']; ?></td>
                                            <td><?= $key['proc']; ?></td>
                                            <td><?= $key['finhelp']; ?></td>
                                            <td><?= $key['withdrawal']; ?></td>
                                            <td><?= $key['summsale']; ?></td>
                                            <td><?= $key['salesincome']; ?></td>
                                            <td><?= $key['deposit']; ?></td>
                                            <td><?= $key['endsumm']; ?></td>
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