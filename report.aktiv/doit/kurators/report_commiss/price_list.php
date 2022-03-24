<?
$price=R::findAll('pricelist','ORDER BY id DESC');
?>
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
                <div class="answer">

                </div>
            </div>
            <!--------------------------------------------------------------------------->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <button class="fa fa-plus btn btn-success edit" data-toggle="modal" data-target="#modal-default"> </button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="">
                            <!--table-responsive-->
                            <table class="table table-hover table-bordered" id="datatable-tabletools">
                                <thead>
                                    <tr>
                                        <th class="bg-olive">№</th>
                                        <th class="bg-olive">Тип</th>
                                        <th class="bg-olive">Производитель</th>
                                        <th class="bg-olive">Категория</th>
                                        <th class="bg-olive">Модель</th>
                                        <th class="bg-olive">Описание</th>
                                        <th class="bg-olive">Характеристики</th>
                                        <th class="bg-green">А</th>
                                        <th class="bg-blue">B</th>
                                        <th class="bg-yellow">C</th>
                                        <th class="bg-red">D</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?foreach ($price as $key) {?>
                                    <tr>
                                        <td>1</td>
                                        <td><?= $key['type'] ?></td>
                                        <td><?= $key['manufacturer'] ?></td>
                                        <td><?= $key['category'] ?></td>
                                        <td><?= $key['model'] ?></td>
                                        <td><?= $key['description'] ?></td>
                                        <td><?= $key['characteristics'] ?></td>
                                        <td><?= $key['price_a'] ?></td>
                                        <td><?= $key['price_b'] ?></td>
                                        <td><?= $key['price_c'] ?></td>
                                        <td><?= $key['price_d'] ?></td>
                                    </tr>
                                    <?}?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
                <!--------------------------------------------------------------------------->
            </div>
    </section>
</div><!-- /.content-wrapper -->

<div class="modal  fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-olive">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> <i class="fa fa-remove"></i> </span></button>
                <h4 class="modal-title">Добавление данных</h4>
            </div>
            <form action="./functions/price/price_list.php" id="price" method="POST">
                <div class="modal-body">
                    <p>Подождите, идет загрузка данных . . . . </p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='close' class="btn btn-danger pull-left" data-dismiss="modal"> Закрыть</i> </button>
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
            $.post('./functions/price/price_list.php', {
                    id_prod: id
                })
                .done(function(data) {
                    $('.modal-body').html(data);
                });
        });
        $('form#price').submit(function(e) {
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
            $('.close').trigger('click');
        });
    });


    var t = $('tbody').children('td').first();


    console.log(t);
</script>