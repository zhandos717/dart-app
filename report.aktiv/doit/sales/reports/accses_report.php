<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span class="btn btn-large bg-olive"><?= $region; ?> </span> <?= $adress; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная <?= $date_10; ?> <?= $month_end ?> </a></li>
            <li><a href="index.php"><?= $region; ?></a></li>
            <li class="active"><?= $adress; ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 ">
                <div class="answer">
                </div>
                <div class="box">
                    <div class="box-header">
                        <span class="btn btn-success ml-5 edit" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-plus"> </i></span> &ensp;<h3 class="box-title"> Аксессуары</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="datatable-tabletools" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>КОД</th>
                                        <th>Регион</th>
                                        <th>Категория</th>
                                        <th>Наименование</th>
                                        <th>приход</th>
                                        <th>продажа</th>
                                        <th>прибыль</th>
                                        <th>кл. шт.</th>
                                        <th>примечание</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $result = R::find('product', ' status = ? AND region=?', [1, $region]);
                                    $i = 1;
                                    foreach ($result as $data) : ?>
                                        <tr class="">
                                            <td><?= $i++; ?>.</td>
                                            <td><a href="#" data-accses="<?= $data['id']; ?>" class="btn btn-danger edit" data-toggle="modal" data-target="#modal-default"> Z<?= $data['id']; ?></a></td>
                                            <td><?= $data['region']; ?></td>
                                            <td><?= $data['category']; ?></td>
                                            <td> <?= $data['name']; ?> </td>
                                            <td><?= $data['purchaseamount']; ?> тг.</td>
                                            <td><a target="_blank" href="barcode/accses_barcode.php?id=<?= $data['id'] ?>" class="btn btn-success"><?= $data['price']; ?>тг.</a></td>
                                            <td><?= $data['price'] - $data['purchaseamount']; ?> тг.</td>
                                            <td><?= $data['counttovar']; ?> шт.</td>
                                            <td><?= $data['message']; ?>
                                            </td>
                                            <td>
                                                <button type="button" data-id="<?= $data['id']; ?>" class="btn btn-danger delete"> <i class="fa fa-trash"> </i> </button>
                                            </td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


                <div class="box box-danger collapsed-box">
                    <div class="box-header">
                        <h4>Удаленные товары</h4>
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>КОД</th>
                                        <th>Регион</th>
                                        <th>Категория</th>
                                        <th>Наименование</th>
                                        <th>приход</th>
                                        <th>продажа</th>
                                        <th>прибыль</th>
                                        <th>кл. шт.</th>
                                        <th>примечание</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $result = R::find('product', ' status = ? AND region=?', [3, $region]);
                                    $i = 1;
                                    foreach ($result as $data) : ?>
                                        <tr class="">
                                            <td><?= $i++; ?>.</td>
                                            <td>Z<?= $data['id']; ?></td>
                                            <td><?= $data['region']; ?></td>
                                            <td><?= $data['category']; ?></td>
                                            <td> <?= $data['name']; ?> </td>
                                            <td><?= $data['purchaseamount']; ?> тг.</td>
                                            <td><?= $data['price']; ?></td>
                                            <td><?= $data['price'] - $data['purchaseamount']; ?> тг.</td>
                                            <td><?= $data['counttovar']; ?> шт.</td>
                                            <td><?= $data['message']; ?></td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
    </section>
</div><!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> <i class="fa fa-remove"></i> </span></button>
                <h4 class="modal-title">Изменение данных</h4>
            </div>
            <form action="./functions/report/func/accses.php" method="POST">
                <div class="modal-body">
                    <p>Подождите, идет загрузка данных . . . . </p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='close' class="btn btn-danger pull-left" data-dismiss="modal"> Закрыть </button>
                    <button type="submit" class="btn btn-success save">Сохранить</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(function() {
        $('.edit').click(function() {
            var id = $(this).data('accses');
            $.post('./functions/report/func/accses.php', {
                    id_prod: id
                })
                .done(function(data) {
                    $('.modal-body').html(data);
                });
        });
    });

    $(function() {
        $('.delete').click(function() {
            var id_delete = $(this).data('id');
            $.post('./functions/report/func/accses_delete.php', {
                    id_delete: id_delete
                })
                .done(function(data) {

                    console.log(id_delete);
                    //console.log(data);
                });
            $(this).parents('tr').addClass('danger');

        });
    });


    $('form').submit(function(e) {
        var $form = $(this);
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize()
        }).done(function(data) {
            console.log(data);
            $('#close').trigger('click');
            var out = '<div class = "callout callout-success" > ';
            out += '<h4> Данные успешно добавлены! </h4> ';
            out += '<p> Для того чтобы увидеть изменения обновите страницу. </p> ';
            out += '</div>';
            $('.answer').html(out);
        }).fail(function() {
            alert('Ошибка');
        });
        //console.log($form);
        //отмена действия по умолчанию для кнопки submit
        e.preventDefault();
    });
</script>