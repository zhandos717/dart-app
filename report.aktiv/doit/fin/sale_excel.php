<?php

include("../../bd.php");
include __DIR__ . '/../../assets/libs/SimpleExcel.php';

$file = $_FILES;

function upload($file)
{
    $upload_dir = 'files/'; // Путь куда загружаем файл
    $files_name = '';
    $accepted_formate = ['xlsx'];

    for ($i = 0; $i < count($file['file']['name']); $i++) {
        $file_extension = pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION); // Достаем расширение файла
        if (in_array(pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION), $accepted_formate)) {
            $name =  '123.' . $file_extension;
            $file_name = $upload_dir . $name; //Создаем новое имя во избежание затирания файла
            move_uploaded_file($file['file']['tmp_name'][$i], $file_name); // Загружаем файл в нашу директорию
            $files_name .= $name . ' ';
        } else {
            $files_name .= NULL;
        }
    }
    return 'files/' . $files_name;
};
if ($file['file']['name']) {
    upload($file);
}
if ($_SESSION['logged_user']->status == 11) :
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
        </section>
        <br>
        <section class="content">

            <div class="row">

                <div class="col-xs-12">
                    <div class="hidden alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
                        <h4><i class="icon fa fa-check"> </i> Данные добавлены!</h4>
                        <span class="text-message"> </span>
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Поиск товара по базе данных </h3>

                        </div>
                        <div class="box-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="input-group input-group-sm">
                                    <div class="form-group">
                                        <input multiple="true" type="file" class="form-control" id="file" name="file[]">
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info " type="submit">Загрузить</button>
                                    </span>
                                </div><!-- /input-group -->
                            </form>
                            <br>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <?php
                                        if ($xlsx = SimpleXLSX::parse('./files/123.xlsx')) {
                                            $i = 0;
                                            foreach ($xlsx->rows() as $r) {
                                                $new_array = array_diff($r, ['']);

                                                if (!empty($new_array)) {
                                                    if ($i == 0) {
                                                        echo '<tr><td>' . implode('</td><td>', $r) . '</td> <td> </td>  </tr> </thead><tbody>';
                                                    } else {
                                                        $ticket = R::findOne('tickets', 'nomerzb = :nomerzb LIMIT 1', [':nomerzb' => trim($r[0])]);

                                                        if ($ticket) {
                                                            $sts = R::load('status_zb', $ticket['status']);

                                                            echo '<tr><td> ' . implode('</td><td>', $r) . '</td><td> 
                                                            '. $sts['name'] .'
                                                            <button type="button" class="btn btn-default update" data-nomerzb=' . $r[0] . '
                                                            data-price=' . $r[7] . ' 
                                                           data-toggle="modal" data-target="#exampleModal">
                                                        <i class="fa fa-cart-arrow-down"></i>
                                                        </button>
                                                        </td>
                                                        </tr>';
                                                        }else{
                                                            echo '<tr class="info"><td> ' . implode('</td><td>', $r) . '</td><td>
                                                         
                                                        </td>
                                                        </tr>';
                                                        }
                                                    }
                                                }

                                                $i++;
                                            }
                                        } else {
                                            echo SimpleXLSX::parseError();
                                        }
                                        ?>
                                        </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                        </div>
                    </div><!-- /.box -->
                </div> <!-- /.row -->
            </div>
        </section>
    </div> <!-- /.content-wrapper -->

    <div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Изменение данных</h4>
                </div>
                <form id="get_sale" action="functions/add_sale_test.php" method="POST">
                    <div class="modal-body">
                        <p>Подождите идет загрузка данных......</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close_model" data-dismiss="modal" class="btn btn-danger pull-left">Закрыть</button>
                        <button type="submit" class="btn btn-success">Cохранить</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        $(document).ready(function() {
            $('.update').click(function(e) {

                var nomerzb = $(this).data('nomerzb');
                var price = $(this).data('price');
                var tr = $(this).parents('tr');
                tr.addClass('danger');

                $.post('./functions/get_sale.php', {
                        nomerzb: nomerzb,
                        price: price
                    })
                    .done(function(data) {
                        $('.modal-body').html(data);
                    });
            });

            $('form#get_sale').submit(function(e) {

                // $('#close_model').trigger("click");

                var $form = $(this);
                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize()
                }).done(function(result) {
                    json = jQuery.parseJSON(result);
                    if (json.status == 'success') {
                        $('.alert').removeClass('hidden');
                        $('.text-message').text(json.message);
                    }



                }).fail(function(data) {
                    console.log(data);
                    alert('Ошибка:' + data);
                });

                $('.modal').each(function() {
                    $(this).modal('hide');
                    $('.modal-backdrop').remove();
                });



                e.preventDefault();
            });

        });
    </script>

<? include "footer.php";
endif; ?>