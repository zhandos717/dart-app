<? include("../../bd.php");
    if ($_SESSION['logged_user']->status == 3) :
    $data_a = $_GET['start_month'];
    $data_z = $_GET['end_month'];
    $saler = $_GET['saler'];

    include "header.php"; 
    include "menu.php"; 
    $result = R::findAll('sales',"saler = :saler AND data BETWEEN  :data AND :data_end",
    [':saler'=> $saler,':data'=>$data_a,':data_end'=>$data_z]);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за <?= date('d.m.Y'); ?>
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
            <div class="col-xs-12">
                <div class="answer">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
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
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?  $i = 1;
                  foreach ($result as $data1) { ?>
                                    <tr <?if($data1['statustovar']==3){echo'class="danger"';}; ?>>
                                        <td><?= $i++; ?>.</td>
                                        <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                                        <td> <button data-id="<?= $data1['id']; ?>" class="btn btn-default btn-block update" data-toggle="modal" data-target="#exampleModal"><?= $data1['codetovar']; ?></button> </td>
                                        <td>
                                            <? echo  $data1['regionlombard'].'/'.$data1['adresslombard']; ?>
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
                                    </tr>
                                    <?}?>
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


<div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Изменение данных</h4>
            </div>
            <form action="./functions/upd_sales.php" method="POST">
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
        $('.update').click(function(e) {
            var id = $(this).data('id');
            $.post('./functions/upd_sales.php', {
                    id: id
                })
                .done(function(data) {
                    $('.modal-body').html(data);
                });
        });

        $('form').submit(function(e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function(data) {
                var out = '<div class="alert alert-success alert-dismissable">';
                out += ' <button type ="button" class ="close" data-dismiss="alert" aria-hidden="true" > &times; </button>';
                out += '<h4 ><i class="icon fa fa-check"> </i> Данные добавлены!</h4>';
                out += 'Для проверки обновите страницу';
                out += '</div> ';
                console.log(data);
                $('.answer').html(out);
            }).fail(function(data) {
                console.log(data);
                alert('Ошибка:' + data);
            });
            $('.close').trigger("click");
            //отмена действия по умолчанию для кнопки submit
            e.preventDefault();
        });

    });
</script>

<? include "footer.php"; 
else :
header('Location: /');
endif; ?>