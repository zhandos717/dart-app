<? include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
    include "header.php";
    include "menu.php";
    $data_start = $_GET['data_start'] ?? date('2021-12-31');
    $data_end = $_GET['data_end'] ?? date('2021-12-31');
    $region = $_GET['region'];
    $shop = $_GET['shop'];

    $reg = R::getCol('SELECT region FROM kassa WHERE status = 1 GROUP BY region');

    $placeholder = [':data_start' => $data_start, ':data_end' => $data_end];
    // if ($_GET['city'] != '') {
    //     $where .= 'AND regionlombard = ' . $_GET['city'];
    //     $placeholder[':fromtovar'] = $fromtovar;
    // }

    if ($_GET['company'] == 2) {
        $where = 'SELECT sales.data, sales.codetovar, sales.regionlombard,sales.adresslombard ,sales.tovarname  ,sales.summaprihod ,sales.predoplata,sales.summareal 
        ,sales.pribl ,sales.vid ,sales.saler ,sales.pokupatel FROM sales  WHERE sales.data BETWEEN  :data_start AND  :data_end   AND sales.statustovar IS NULL AND sales.fromtovar = 2  AND  sales.regionlombard NOT IN ("' . implode('","', $reg) . '") ';
    } else {

        $where = 'SELECT sales.data, sales.codetovar, status_zb.name, sales.regionlombard,sales.adresslombard ,sales.tovarname  ,sales.summaprihod ,sales.predoplata,sales.summareal 
        ,sales.pribl ,sales.vid ,sales.saler ,sales.pokupatel FROM (( sales INNER JOIN tickets ON
        sales.codetovar = tickets.nomerzb) INNER JOIN status_zb ON status_zb.id = tickets.status)  WHERE sales.data BETWEEN  :data_start AND  :data_end AND sales.statustovar IS NULL AND sales.fromtovar = 2  AND tickets.status IN (7,10,14,15) AND sales.regionlombard IN ("' . implode('","', $reg) . '") ';
    }


    $result = R::getAll($where, $placeholder);

    function get_status(string $nomerzb)
    {

        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'https://report.commission2.kz/doit/api/get_sales.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'nomerzb' => $nomerzb,
                'token' => 'fjw@JKEhdqw'
            ])
        ));
        $response = json_decode(curl_exec($myCurl), true);
        curl_close($myCurl);
        return $response;
    }
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

                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <div class="input-group">
                                        <select name="company" class="form-control">
                                            <option value="1">ОБС</option>
                                            <option value="2">ТБС</option>
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
                                            <th>Статус в базе</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? $i = 1;
                                        foreach ($result as $data1) {
                                           $st =  get_status($data1['codetovar']);

                                          
                                           if($_GET['company'] && $st != '0'):

                                            ?>
                                            <tr>
                                                <td><?= $i++; ?>.</td>
                                                <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                                                <td> <?= $data1['codetovar']; ?></td>
                                                <td>
                                                    <?= $data1['regionlombard'] . '/' . $data1['adresslombard']; ?>
                                                </td>
                                                <td><?= $data1['tovarname']; ?></td>
                                                <td class="warning"><?= number_format($data1['summaprihod'], 0, '.', ' ');
                                                                    $summaprihod += $data1['summaprihod']; ?></td>
                                                <td><?= number_format($data1['predoplata'], 0, '.', ' ');
                                                    $predoplata += $data1['predoplata']; ?></td>
                                                <td class="danger"><?= number_format($data1['summareal'], 0, '.', ' ');
                                                                    $summareal += $data1['summareal']; ?></td>
                                                <td class="success"><?= number_format($data1['pribl'], 0, '.', ' ');
                                                                    $pribl += $data1['pribl']; ?></td>
                                                <td><?= $data1['vid']; ?></td>
                                                <td><?= $data1['saler']; ?></td>
                                                <td><?= $data1['pokupatel']; ?></td>
                                                <td><?= $data1['name'] ?? $st['status'] ?> </td>

                                            </tr>
                                        <? endif;    }?>
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
                                            <th colspan="4"></th>
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