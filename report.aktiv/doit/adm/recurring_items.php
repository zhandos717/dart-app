<? include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
    $data_start = $_GET['data_start'] ?? date('Y-m-01');
    $data_end = $_GET['data_end'] ?? date('Y-m-d');

    $region = $_GET['region'];
    $shop = $_GET['shop'];
    $fromtovar = $_GET['from'] ?? 1;

    //data BETWEEN '$start_month' AND '$end_month'
    include "header.php";
    include "menu.php";

    $sql = ' data BETWEEN  :data_start AND  :data_end AND statustovar IS NULL  ';

    $placeholder = [':data_start' => $data_start, ':data_end' => $data_end];

    if ($fromtovar != '') {
        $sql .= ' AND fromtovar = :fromtovar';
        $placeholder[':fromtovar'] = $fromtovar;
    }

    $result = R::getCol('SELECT codetovar FROM sales WHERE ' . $sql . ' GROUP BY codetovar HAVING COUNT(codetovar) > 1 ', $placeholder);

    $arr = [
        1 => 'Ломбард',
        2 => 'Комиссоный магазин',
    ];

    $result = R::findLike('sales', [
        'codetovar' => $result
    ], 'data BETWEEN  :data_start AND  :data_end AND statustovar IS NULL   ORDER BY codetovar ASC ', [':data_start' => $data_start, ':data_end' => $data_end]);
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Магазин ОТЧЕТ c <?= $data_start; ?> по <?= $data_end; ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php"><?= $region; ?></a></li>
                <li class="active"><?= $shop; ?></li>
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
                            <form action="" method="GET">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <div class="input-group">
                                        <input type="date" class="form-control" min="2020-08-19" value="<?= $data_start ?>" name="data_start">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <div class="input-group">
                                        <input type="date" class="form-control" min="2020-08-19" value="<?= $data_end ?>" name="data_end">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="input-group">
                                        <select class="form-control" name='from'>
                                            <option value="">Все</option>
                                            <?
                                            foreach ($arr as $k => $v) { ?>
                                                <option <? if ($k == $_GET['from']) echo 'selected'; ?> value="<?= $k ?>"><?= $v ?></option>
                                            <? }
                                            ?>
                                        </select>
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
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="">
                                <!-- table-responsive -->
                                <table id="datatable-tabletools" class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th>№</th>
                                            <th>ДАТА</th>
                                            <th>КОД ТОВАРА</th>
                                            <th>Адрес филиала</th>
                                            <th>ТОВАР</th>
                                            <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                                            <th>ПРЕДОПЛАТА</th>
                                            <th>СУММА РЕАЛИЗАЦИИ</th>
                                            <th>ПРИБЫЛЬ</th>
                                            <th>ВИД</th>
                                            <th>ПРОДАВЕЦ</th>
                                            <th>ПОКУПАТЕЛЬ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? $i = 1;
                                        foreach ($result as $data) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?>.</td>
                                                <td><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                                                <td> <?= $data['codetovar']; ?></td>
                                                <td>
                                                    <? echo  $data['regionlombard'] . '/' . $data['adresslombard']; ?>
                                                </td>
                                                <td><?= $data['tovarname']; ?></td>
                                                <td class="warning"><?= number_format($data['summaprihod'], 0, '.', ' ');
                                                                    $summaprihod += $data['summaprihod']; ?></td>
                                                <td><?= number_format($data['predoplata'], 0, '.', ' ');
                                                    $predoplata += $data['predoplata']; ?></td>
                                                <td class="danger"><?= number_format($data['summareal'], 0, '.', ' ');
                                                                    $summareal += $data['summareal']; ?></td>
                                                <td class="success"><?= number_format($data['pribl'], 0, '.', ' ');
                                                                    $pribl += $data1['pribl']; ?></td>
                                                <td><?= $data['vid']; ?></td>
                                                <td><?= $data['saler']; ?></td>
                                                <td><?= $data['pokupatel']; ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray">
                                            <th colspan="5" class="text-center">Итого</th>
                                            <th class="bg-yellow">
                                                <?= number_format($summaprihod, 0, '.', ' '); ?></th>
                                            <th class="bg-blue">
                                                <?= number_format($predoplata, 0, '.', ' '); ?></th>
                                            <th class="bg-red">
                                                <?= number_format($summareal, 0, '.', ' '); ?></th>
                                            <th class="bg-olive">
                                                <?= number_format($pribl, 0, '.', ' '); ?></th>
                                            <th colspan="3"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->




<? include "footer.php";
else :
    header('Location: /');
endif; ?>