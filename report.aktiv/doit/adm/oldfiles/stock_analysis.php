<?
include("../../bd.php");
include "header.php";
include "menu.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php">Регионы</a></li>
            <li class="active">Филиалы</li>
        </ol>
        <br>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Выберите период</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="functions/report/stock_analysis.php" id="report" method="POST">
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" value="<?= date('2020-08-01') ?>" name="date1">
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
                                        <option value="">Все</option>
                                        <? $region = R::findAll('kassa', 'status = 1 GROUP BY region');
                                        foreach ($region as $value) { ?>
                                            <option>
                                                <?= $value['region'] ?>
                                            </option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select class="form-control" id="adress" name="adress">
                                        <option value="">Все</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <!-- <span class="input-group-btn">     </span> -->
                                <button type="submit" class="btn-success btn ">Подтвердить!</button>
                            </div>
                        </form>
                    </div>
                    <!--.box-body -->
                </div>
                <!--.box -->
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <!--<div class="box-header">
                <h3 class="box-title"><b></b></h3>
              </div> /.box-header -->
                    <div class="box-body">
                        <div class="answer">
                            <!--table-responsive-->

                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
                <!--------------------------------------------------------------------------->
            </div>
    </section>
</div><!-- /.content-wrapper -->
<script>
    $(function() {
        $('#get_region').change(function() {
            var region = $(this).val();
            console.log(region);
            $('#adress').load('../function/get_adress.php', {
                region: region
            });
        });
    });
</script>
<? include "footer.php"; ?>