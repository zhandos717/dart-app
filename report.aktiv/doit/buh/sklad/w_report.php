<?
        $data1 = $_POST['date1'];
        $data2 = $_POST['date2']; 

        if(empty($data1)){
            $data1 = date('Y-m-d');
            $data2 = $data1;
        }
    $find = R::findAll('salecomision',"zadatok IS NOT NULL AND dataa BETWEEN :data1 AND :data2",[':data1'=>$data1,':data2'=>$data2 ]);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Задатки
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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Выберите период</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="a_report.php?id=6" method="POST">
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                <div class="input-group">
                                    <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?= $today; ?>" value="<?= $data1; ?>" name="date1">
                                </div>
                                <!-- /input-group -->
                            </div>

                            <div class="	col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                <div class="input-group">
                                    <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?= $today; ?>" value="<?= $data2; ?>" name="date2">
                                </div>
                                <!-- /input-group -->
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
            <!--------------------------------------------------------------------------->
            <!--  -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="">
                            <!-- table-responsive -->
                            <table id="datatable-tabletools" class="tableas table table-hover table-bordered text-center">
                                <thead>
                                    <tr class="text-center table-success">
                                        <th>№</th>
                                        <th>ДАТА ПРОДАЖИ</th>
                                        <th>Касса</th>
                                        <th>К-Т</th>
                                        <th>ТОВАР</th>
                                        <th>ПРИХОД</th>
                                        <th>ЗАДАТОК</th>
                                        <th>РЕАЛИЗАЦИИ</th>
                                        <th>ПРОДАВЕЦ</th>
                                        <th>Кассир</th>
                                        <th>ПОКУПАТЕЛЬ</th>
                                        <th>ТЕЛЕФОН</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? 
                                    $i = 1;
                                    foreach ($find as $date) {?>
                                    <tr class="text-center">
                                        <td><?= $i++; ?>.</td>
                                        <td><?= date("d.m.Y", strtotime($date['dataa'])); ?> </td>
                                        <td><?= $date['region']; ?>/<?= $date['filial']; ?>/<?= $date['kassa']; ?> </td>
                                        <td> <?= $date['codetovar']; ?> </td>
                                        <td class="text-left">
                                            <?= $date['category']; ?>,
                                            <?= $date['tovarname']; ?>
                                            <?= $date['hdd']; ?>
                                            SN: <?= $date['sn']; ?>,
                                            IMEI:<?= $date['imei']; ?>,
                                            <?= $date['opisanie']; ?>
                                        </td>
                                        <td><?= number_format($date['summaprihod'], 0, '.', ' ');
                                            $summaprihod += $date['summaprihod']; ?></td>
                                        <td><?= number_format($date['zadatok'], 0, '.', ' ');
                                            $zadatok += $date['zadatok']; ?></td>
                                        <td><?= number_format($date['summareal'], 0, '.', ' ');
                                            $summareal += $date['summareal']; ?></td>
                                        <td> <?= $date['saler']; ?> </td>
                                        <td> <?= $date['kassir']; ?> </td>
                                        <td> <?= $date['pokupatel']; ?> <br> ИИН:<?= $date['pokupateliin']; ?> </td>
                                        <td> <?= $date['pokupateltel']; ?> </td>
                                    </tr>
                                    <?}?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center table-danger">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Итог</th>
                                        <th><?= number_format($summaprihod, 0, '.', ' '); ?></th>
                                        <th><?= number_format($zadatok, 0, '.', ' '); ?></th>
                                        <th><?= number_format($summareal, 0, '.', ' '); ?></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
            </div><!-- /.col-md-6 -->
            <!--------------------------------------------------------------------------->
        </div><!-- /.content-wrapper -->
    </section>
</div>