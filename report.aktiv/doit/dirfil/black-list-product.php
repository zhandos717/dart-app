<?php
include_once __DIR__ . '/../../bd.php';
if (!$_SESSION['logged_user']->status == 1) header('Location: /');
include_once __DIR__ . '/../layouts/header.php';
include_once __DIR__ . '/menu.php';
$blacklist = R::findAll('blacklist');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="app">
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
                            <table class="table table-hover table-bordered" id="example1">
                                <thead>
                                    <tr class="bg-olive">
                                        <th>ID</th>
                                        <th>№</th>
                                        <th>Тип</th>
                                        <th>Производитель</th>
                                        <th>Категория</th>
                                        <th>Модель</th>
                                        <th>IMEI</th>
                                        <th>SN</th>
                                        <th>Описание</th>
                                        <th>Характеристики</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? $i = 1;
                                    foreach ($blacklist as $key) { ?>
                                        <tr>
                                            <td><?= $key['id'] ?></td>
                                            <td><?= $i++ ?></td>
                                            <td><?= $key['type_product'] ?></td>
                                            <td><?= $key['manufacturer'] ?></td>
                                            <td><?= $key['category'] ?></td>
                                            <td><?= $key['model'] ?></td>
                                            <td><?= $key['imei'] ?></td>
                                            <td><?= $key['sn'] ?></td>
                                            <td><?= $key['description'] ?></td>
                                            <td><?= $key['characteristics'] ?></td>
                                        </tr>
                                    <? } ?>
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
            <form action="../function/add_black_list.php" method="POST">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group ">
                            <label class="control-label" for="type"><i class="fa fa-check"></i> Тип </label>
                            <input type="text" class="form-control" required id="type" placeholder="Техника" name="type">
                        </div>
                        <div class="form-group ">
                            <label class="control-label" for="manufacturer"><i class="fa fa-check"></i> Производитель</label>
                            <input type="text" class="form-control" required id="manufacturer" placeholder="Apple" name="manufacturer">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="category"><i class="fa fa-bell-o"></i> Категория </label>
                            <input type="text" class="form-control" required id="category" placeholder="Носимое устройство" name="category">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="model"><i class="fa fa-times-circle-o"></i> Модель</label>
                            <input type="text" class="form-control" required id="model" placeholder="Air Pods 2 Gen." name="model">
                        </div>
                        <!-- input states -->
                        <div class="row">
                            <!-- input states -->
                            <div class="col-xs-6">
                                <input type="number" class="form-control" placeholder="IMEI" name="imei">
                            </div>
                            <div class="col-xs-6">
                                <input type="text" name="sn" class="form-control" placeholder="SN">
                            </div>
                            <!-- input states -->
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label class="control-label" for="description">Описание</label>
                            <textarea type="text" class="form-control" id="description" placeholder="" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="characteristics">Дополнительные характеристики</label>
                            <textarea class="form-control" rows="3" placeholder="" id="characteristics" name="characteristics"></textarea>
                        </div>
                        <!-- textarea -->
                    </div>
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
<script src="/assets/plugins/editable/jquery.tabledit.js"></script>
<script>
    // $('tr:not(.topRowTable').each(function(i) {
    //     var number = i++;
    //     jQuery(this).find('td:first').text(number + ".");
    // });
    $(function() {
        $('form').submit(function(e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function(data) {
                $('.answer').html(data);
                location.reload();
            }).fail(function() {
                alert('Ошибка');
            });
            e.preventDefault();
            $('.close').trigger('click');
        });
    });

    $('#example1').Tabledit({
        url: '../function/edit_black_list.php',
        editButton: false,
        deleteButton: false,
        eventType: 'dblclick',
        hideIdentifier: true,
        columns: {
            identifier: [0, 'id'],
            editable: [
                [2, 'type_product'],
                [3, 'manufacturer'],
                [4, 'category'],
                [5, 'model'],
                [6, 'imei'],
                [7, 'sn'],
                [8, 'description'],
                [9, 'characteristics'],
            ]
        }
    });
</script>
<?php
include  __DIR__ . '/../layouts/footer.php'; ?>