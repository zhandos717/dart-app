<?php
include_once __DIR__ . '/../../bd.php';
if (!$_SESSION['logged_user']->status == 5) header('Location: /');
include_once __DIR__ . '/../layouts/header.php';
include_once __DIR__ . '/menu.php';
$blacklist = R::findAll('blacklist', 'deleted = 0 ORDER BY id DESC LIMIT 300');
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
                            <table class="table table-hover table-bordered" id="datatable-tabletools">
                                <thead>
                                    <tr class="bg-olive">
                                        <th>ID</th>
                                        <th>№</th>
                                        <!-- <th>Тип</th> -->
                                        <!-- <th>Производитель</th> -->
                                        <!-- <th>Категория</th> -->
                                        <!-- <th>Модель</th> -->
                                        <th>Описание</th>
                                        <th>IMEI /SN</th>
                                        <th>IMEI2</th>

                                        <!-- <th>Характеристики</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <? $i = 1;
                                    foreach ($blacklist as $key) { ?>
                                        <tr>
                                            <td><?= $key['id'] ?></td>
                                            <td><?= $i++ ?></td>
                                            <td><?= $key['description'] ?></td>
                                            <td><?= $key['imei'] ?></td>
                                            <td><?= $key['imei2'] ?></td>
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
            <?php
            // $id = '1G6QuYOPz4pZygTsASEgs6cWY4LYvty1Domi-KKpDTCo';

            // $gid = '0';
            // $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
            // $csv = explode("\r\n", $csv);
            // $array = array_map('str_getcsv', $csv);
            // echo '<pre>';
            // foreach ($array as $k => $v){
            //     if(!empty($v[1]) OR !empty($v[2]) ){
            //     $black_list = R::dispense('blacklist');

            //         $black_list->description = $v[0];
            //         $black_list->imei = $v[1];
            //         $black_list->imei2 = $v[2];

            //         $black_list->add_user    = $fio;
            //         $black_list->datareg     = date('Y-m-d H:i:s');
            //         $black_list->deleted = 0;
            //         R::store($black_list);
            //     }
            // }
            ?>
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
                        <div class="row">
                            <!-- input states -->
                            <div class="col-xs-6">
                                <input type="text" class="form-control" placeholder="IMEI/SN" name="imei">
                            </div>
                            <div class="col-xs-6">
                                <input type="text" name="imei2" class="form-control" placeholder="IMEI2">
                            </div>
                            <!-- input states -->
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label class="control-label" for="description">Описание</label>
                            <textarea type="text" class="form-control" id="description" placeholder="" name="description"></textarea>
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

    $('#datatable-tabletools').Tabledit({
        url: '../function/edit_black_list.php',
        editButton: true,
        deleteButton: true,
        eventType: 'dblclick',
        hideIdentifier: true,
        columns: {
            identifier: [0, 'id'],
            editable: [
                [2, 'description'],
                [3, 'imei'],
                [4, 'imei2'],
            ]
        },
        onDraw: function() {
            console.log('onDraw()');
        },
        onSuccess: function(data, textStatus, jqXHR) {
            console.log('onSuccess(data, textStatus, jqXHR)');
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
        },
        onFail: function(jqXHR, textStatus, errorThrown) {
            console.log('onFail(jqXHR, textStatus, errorThrown)');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        },
        onAlways: function() {
            console.log('onAlways()');
        },
        onAjax: function(action, serialize) {
            console.log('onAjax(action, serialize)');
            console.log(action);
            console.log(serialize);
        }
    });
</script>
<?php
include  __DIR__ . '/../layouts/footer.php'; ?>