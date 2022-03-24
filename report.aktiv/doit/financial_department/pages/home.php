<?
include __DIR__ . '/../../layouts/header.php';
include __DIR__ . '/../../layouts/menu/financial_department.php';
$region = R::findAll('kassa', 'region <> "Тест" AND status = 1 GROUP BY region');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Все проданные товары
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
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-tag"></i> Реализованный товары</h3>
                    </div>
                    <div class="box-body">
                        <form action="../function/report_sales.php" method="POST">
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" value="<?= date('Y-m-01') ?>" name="date1">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date2">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-bank"></i>
                                    </span>
                                    <select class="form-control" id="get_region" name="region">
                                        <option value="">Выберите город</option>
                                        <? foreach ($region as $reg) { ?>
                                            <option><?= $reg['region'] ?></option>

                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fax"></i>
                                    </span>
                                    <select class="form-control" name="kassa">
                                        <? if ($kassa) { ?>
                                            <option value="<?= $kassa; ?>"> <?= $kassa; ?> </option>
                                        <? }; ?>
                                        <option value="Касса 1"> Касса 1 </option>
                                        <option value="Касса 2"> Касса 2 </option>
                                        <option value="Касса 3"> Касса 3 </option>
                                        <option value="Касса 4"> Касса 4 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info">Подтвердить!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!--.box-body -->
                </div>
            </div>
        </div>
        <div id="answer">

        </div>
    </section>
</div>

<script src="/assets/js/form_get_html.js"></script>

<? include __DIR__ . '/../../layouts/footer.php'; ?>