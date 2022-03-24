<?
include("../../bd.php");
if ($_SESSION['logged_user']->status == 11) :
    $active1 = 'active';
    include "../layouts/header.php";
    include "menu.php";
    $result = R::findAll(
        'sales',
        "statustovar IS NULL ORDER BY id DESC LIMIT 20"
    );
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php"><?= $region; ?></a></li>
                <li class="active"><?= $shop; ?></li>
            </ol>
            <br>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12 out">

                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <form action="functions/get_report_sales.php" id="get_report" method="POST">
                  
                            <div class="row">
                                      <div class="col-md-6">
                                    <div class="form-group">
                                        <select id="get_regions" multiple="multiple" name="regions[]" class="form-control select2" required>
                                            <? $regions = R::getCol('SELECT region FROM diruser GROUP BY region');
                                            foreach ($regions as $city) { ?>
                                                <option><?= $city ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select id="adresses" multiple="multiple" name="adresses[]" class="form-control select2">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                      <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control" value="<?= date('Y-m-01') ?>" name="date1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date2">
                                    </div>
                                </div>
                                      <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn-success btn ">Подтвердить !</button>
                                    </div>
                                </div>
                            </div>
                          
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body answer">
                            <table class="table table-bordered table-hover" id='datatable-tabletools'>
                                <thead>
                                    <tr class="info">
                                        <th>№</th>
                                        <th>ДАТА</th>
                                        <th>КОД ТОВАРА</th>
                                        <th>Адрес филиала</th>
                                        <th>ТОВАР</th>
                                        <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                                        <th>СУММА РЕАЛИЗАЦИИ</th>
                                        <th>Итого к реализации -комиссия </th>
                                        <th>Вид оплаты</th>
                                        <th>Сумма оплаты</th>
                                        <th>Вид оплаты</th>
                                        <th>Сумма оплаты</th>
                                        <th>Вид оплаты</th>
                                        <th>Сумма оплаты</th>
                                        <th>Вид оплаты</th>
                                        <th>Сумма оплаты</th>
                                        <th>ПРИБЫЛЬ</th>
                                        <th>ПРИБЫЛЬ - %</th>
                                        <th>ПРОДАВЕЦ</th>
                                        <th>ПОКУПАТЕЛЬ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? $i = 1;
                                    foreach ($result as $data1) { ?>
                                        <tr>
                                            <td><?= $i++; ?>.</td>
                                            <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                                            <td> <button data-id="<?= $data1['id']; ?>" class="btn btn-success btn-block update" data-toggle="modal" data-target="#exampleModal"><?= $data1['codetovar']; ?> </button> </td>
                                            <td>
                                                <?= $data1['regionlombard'] . '/' . $data1['adresslombard']; ?>
                                            </td>
                                            <td><?= $data1['tovarname']; ?></td>
                                            <td class="warning"><?= number_format($data1['summaprihod'], 0, '.', ' ');
                                                                $summaprihod += $data1['summaprihod']; ?></td>
                                            <td class="danger"><?= number_format($data1['summareal'], 0, '.', ' ');
                                                                $summareal += $data1['summareal']; ?></td>
                                            <td class="bg-primary"><?= number_format($data1['remainder'], 0, '.', ' ');
                                                                    $remainder += $data1['remainder']; ?></td>
                                            <td class="warning"><?= $data1['vid1'] ?></td>
                                            <td class="danger"><?= number_format($data1['summareal1'], 0, '.', ' ');
                                                                $summareal1 += $data1['summareal1']; ?></td>
                                            <td class="warning"><?= $data1['vid2'] ?></td>
                                            <td class="danger"><?= number_format($data1['summareal2'], 0, '.', ' ');
                                                                $summareal2 += $data1['summareal2']; ?></td>
                                            <td class="warning"><?= $data1['vid3'] ?></td>
                                            <td class="danger"><?= number_format($data1['summareal3'], 0, '.', ' ');
                                                                $summareal3 += $data1['summareal3']; ?></td>
                                            <td class="warning"><?= $data1['vid4'] ?></td>
                                            <td class="danger"><?= number_format($data1['summareal4'], 0, '.', ' ');
                                                                $summareal4 += $data1['summareal4']; ?></td>
                                            <td class="success"><?= number_format($data1['pribl'], 0, '.', ' ');
                                                                $pribl += $data1['pribl']; ?></td>
                                            <td class="info"> <?
                                                                if ($data1['remainder']) {
                                                                    echo number_format($data1['remainder'] - $data1['summaprihod'], 0, '.', ' ');
                                                                    $remainder1 += $data1['remainder'] - $data1['summaprihod'];
                                                                } ?></td>
                                            <td><?= $data1['saler']; ?></td>
                                            <td><?= $data1['pokupatel']; ?></td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray">
                                        <th colspan="5" class="text-center">Итого</th>
                                        <th class="bg-yellow">
                                            <?= number_format($summaprihod, 0, '.', ' '); ?></th>
                                        <th class="bg-red">
                                            <?= number_format($summareal, 0, '.', ' '); ?></th>
                                        <th class="bg-primary"><?= number_format($remainder, 0, '.', ' '); ?> </th>
                                        <td></td>
                                        <th class="bg-red">
                                            <?= number_format($summareal1, 0, '.', ' '); ?></th>
                                        <th></th>
                                        <th class="bg-red">
                                            <?= number_format($summareal2, 0, '.', ' '); ?></th>
                                        <td></td>
                                        <th class="bg-red">
                                            <?= number_format($summareal3, 0, '.', ' '); ?></th>
                                        <td></td>
                                        <th class="bg-red">
                                            <?= number_format($summareal4, 0, '.', ' '); ?></th>


                                        <th class="bg-olive">
                                            <?= number_format($pribl, 0, '.', ' '); ?></th>

                                        <th><?= number_format($remainder1, 0, '.', ' '); ?> </th>
                                        <th colspan="2"> </th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Изменение данных</h4>
                </div>
                <form action="../function/upd_sales.php" id="edit_report" method="POST">
                    <div class="modal-body">
                        <p>Подождите идет загрузка данных......</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Cохранить</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $(function() {

             $('.select2').select2()
             
            $('.update').click(function(e) {
                var id = $(this).data('id');
                $.post('../function/upd_sales.php', {
                        id: id
                    })
                    .done(function(data) {
                        $('.modal-body').html(data);
                    });
            });


            
        $('#get_regions').change(function() {
          var regions = $(this).val();
          console.log(regions);
          $('#adresses').load('../function/get_adress.php', {
            regions_shop: regions
          });
        });

            $('form#edit_report').submit(function(e) {
                var $form = $(this);
                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize()
                }).done(function(data) {
                    var out = '<div class="alert alert-success alert-dismissable">';
                    out += ' <button type ="button" class ="close" data-dismiss="alert" aria-hidden="true" > &times; </button>';
                    out += '<h4 ><i class="icon fa fa-check"> </i> Данные добавлены!</h4>';
                    out += data + ' Для проверки обновите страницу';
                    out += '</div> ';
                    $('.out').html(out);
                }).fail(function() {
                    alert('Ошибка');
                });

                $('.close').trigger("click");
                e.preventDefault();
            });



            $('form#get_report').submit(function(e) {
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
                e.preventDefault();
            });
        });
    </script>
<? include "../layouts/footer.php";
else :
    header('Location: /');
endif; ?>